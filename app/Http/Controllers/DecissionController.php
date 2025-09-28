<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criteria;
use App\Models\Package;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DecissionController extends Controller
{
    public function calculateSMART(Request $request)
    {
        // 1. Initial Data Fetching
        $allPackages = Package::with('scorings.subCriteria.criteria', 'category')->get();
        $criteriaForFilter = Criteria::with('subCriterias')->get();
        $categoryOptions = Category::all(); // Re-add category options for the filter

        // 2. Core Logic
        $normalizedWeights = $this->normalizeWeights($criteriaForFilter);
        $scorablePackages = $this->getFilteredPackages($request, $allPackages, $criteriaForFilter->count());

        // 3. Handle Empty Results
        if ($scorablePackages->isEmpty()) {
            return $this->handleEmptyResults($request, $criteriaForFilter, $categoryOptions, $normalizedWeights);
        }

        // 4. Perform SMART Calculation
        $utilityParams = $this->calculateUtilityParams($criteriaForFilter);
        $results = $this->calculateAllPackageScores($scorablePackages, $normalizedWeights, $utilityParams);
        $this->sortResults($results);

        // 5. Return View
        return view('decission-support', [
            'normalizedWeights' => $normalizedWeights,
            'results' => $results,
            'criterias' => $criteriaForFilter,
            'criteriaForFilter' => $criteriaForFilter,
            'categoryOptions' => $categoryOptions, // Pass categories to the view
        ]);
    }

    private function normalizeWeights(Collection $criterias): Collection
    {
        $totalWeight = $criterias->sum('value');
        return $criterias->mapWithKeys(function ($criteria) use ($totalWeight) {
            return [$criteria->id => [
                'name' => $criteria->criteria,
                'weight' => $criteria->value,
                'normalized' => $totalWeight > 0 ? $criteria->value / $totalWeight : 0,
            ]];
        });
    }

    private function getFilteredPackages(Request $request, Collection $packages, int $totalCriteriaCount): Collection
    {
        $scorablePackages = $packages->filter(fn($package) => $package->scorings->count() >= $totalCriteriaCount);

        // Dynamic criteria filter
        $filterCriteriaId = $request->input('filter_criteria_id');
        $filterSubCriteriaId = $request->input('filter_sub_criteria_id');
        if ($filterCriteriaId && $filterSubCriteriaId) {
            $scorablePackages = $scorablePackages->filter(function ($package) use ($filterCriteriaId, $filterSubCriteriaId) {
                return $package->scorings->contains(fn($scoring) =>
                    $scoring->id_criteria == $filterCriteriaId && $scoring->id_sub_criteria == $filterSubCriteriaId
                );
            });
        }

        // Static category filter
        $categoryFilter = $request->input('category_filter');
        if ($categoryFilter) {
            $scorablePackages = $scorablePackages->filter(fn($package) => $package->category_id == $categoryFilter);
        }

        return $scorablePackages;
    }

    private function handleEmptyResults(Request $request, Collection $criteriaForFilter, Collection $categoryOptions, Collection $normalizedWeights)
    {
        $hasFilters = $request->filled('filter_criteria_id') || $request->filled('category_filter');
        $errorMessage = $hasFilters
            ? 'No packages found matching the selected filters.'
            : 'No packages with complete scoring data found.';

        return view('decission-support', [
            'error' => $errorMessage,
            'criteriaForFilter' => $criteriaForFilter,
            'categoryOptions' => $categoryOptions,
            'results' => [],
            'criterias' => $criteriaForFilter,
            'normalizedWeights' => $normalizedWeights,
        ]);
    }

    private function calculateUtilityParams(Collection $criterias): array
    {
        $utilityParams = [];
        foreach ($criterias as $criteria) {
            $utilityParams[$criteria->id] = [
                'cmin' => (float) $criteria->subCriterias->min('value'),
                'cmax' => (float) $criteria->subCriterias->max('value'),
            ];
        }
        return $utilityParams;
    }

    private function calculateAllPackageScores(Collection $scorablePackages, Collection $normalizedWeights, array $utilityParams): array
    {
        return $scorablePackages->map(function ($package) use ($normalizedWeights, $utilityParams) {
            return $this->calculateSinglePackageScore($package, $normalizedWeights, $utilityParams);
        })->values()->all();
    }

    private function calculateSinglePackageScore(Package $package, Collection $normalizedWeights, array $utilityParams): array
    {
        $finalScore = 0;
        $utilityScores = [];
        $weightedScores = [];

        foreach ($normalizedWeights as $criteriaId => $weightData) {
            $scoring = $package->scorings->where('id_criteria', $criteriaId)->first();
            $utility = 0;

            if ($scoring && $scoring->subCriteria) {
                $cmin = $utilityParams[$criteriaId]['cmin'];
                $cmax = $utilityParams[$criteriaId]['cmax'];
                $range = $cmax - $cmin;
                $cout = (float) $scoring->subCriteria->value;

                $utility = ($range > 0) ? (($cout - $cmin) / $range) : 1;
            }

            $weighted = $utility * $weightData['normalized'];
            $finalScore += $weighted;
            $utilityScores[$criteriaId] = $utility;
            $weightedScores[$criteriaId] = $weighted;
        }

        return [
            'package_name' => $package->name,
            'utility_scores' => $utilityScores,
            'weighted_scores' => $weightedScores,
            'final_score' => $finalScore,
        ];
    }

    private function sortResults(array &$results): void
    {
        usort($results, fn($a, $b) => $b['final_score'] <=> $a['final_score']);
    }
}