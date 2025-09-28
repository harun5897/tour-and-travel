<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criteria;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DecissionController extends Controller
{
    public function calculateSMART(Request $request)
    {
        // 1. Always fetch data for filters
        $criteriaForFilter = Criteria::with('subCriterias')->get();
        $categoryOptions = Category::all();

        // Initialize variables
        $scorablePackages = null;
        $results = [];
        $normalizedWeights = [];

        // 2. Check if any filters are applied to fetch packages
        if ($request->has('category_filter') || $request->has('filter_criteria_id')) {
            $allPackages = Package::with('scorings.subCriteria.criteria', 'category')->get();
            $totalCriteriaCount = $criteriaForFilter->count();
            
            // Filter packages that have complete scoring
            $scorablePackages = $allPackages->filter(function ($package) use ($totalCriteriaCount) {
                return $package->scorings->count() >= $totalCriteriaCount;
            });

            // Apply category filter if present
            if ($request->filled('category_filter')) {
                $scorablePackages = $scorablePackages->filter(function ($package) use ($request) {
                    return $package->category_id == $request->input('category_filter');
                });
            }
            
            // Apply dynamic criteria filter if present
            $filterCriteriaId = $request->input('filter_criteria_id');
            $filterSubCriteriaId = $request->input('filter_sub_criteria_id');
            if ($filterCriteriaId && $filterSubCriteriaId) {
                $scorablePackages = $scorablePackages->filter(function ($package) use ($filterCriteriaId, $filterSubCriteriaId) {
                    return $package->scorings->contains(function ($scoring) use ($filterCriteriaId, $filterSubCriteriaId) {
                        return $scoring->id_criteria == $filterCriteriaId && $scoring->id_sub_criteria == $filterSubCriteriaId;
                    });
                });
            }
        }

        // 3. Check if the calculation should be run
        if ($request->input('run_calculation') === 'true' && $scorablePackages !== null && $scorablePackages->isNotEmpty()) {
            $normalizedWeights = $this->normalizeWeights($criteriaForFilter);
            $utilityParams = $this->calculateUtilityParams($criteriaForFilter, $scorablePackages);
            $results = $this->calculateAllPackageScores($scorablePackages, $normalizedWeights, $utilityParams);
            $this->sortResults($results);
        }

        // 4. Return the view with the gathered data
        return view('decission-support', [
            'scorablePackages' => $scorablePackages,
            'results' => $results,
            'normalizedWeights' => $normalizedWeights,
            'criteriaForFilter' => $criteriaForFilter,
            'categoryOptions' => $categoryOptions,
            'criterias' => $criteriaForFilter,
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

    private function calculateUtilityParams(Collection $criterias, Collection $scorablePackages): array
    {
        $utilityParams = [];
        foreach ($criterias as $criteria) {
            $scoresForCriterion = $scorablePackages->map(function ($package) use ($criteria) {
                $scoring = $package->scorings->where('id_criteria', $criteria->id)->first();
                return $scoring && $scoring->subCriteria ? (float) $scoring->subCriteria->value : null;
            })->filter();

            if ($scoresForCriterion->isNotEmpty()) {
                $utilityParams[$criteria->id] = [
                    'cmin' => $scoresForCriterion->min(),
                    'cmax' => $scoresForCriterion->max(),
                ];
            } else {
                $utilityParams[$criteria->id] = [
                    'cmin' => 0,
                    'cmax' => 0,
                ];
            }
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
