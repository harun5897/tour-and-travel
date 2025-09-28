<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Package;
use Illuminate\Http\Request;

class DecissionController extends Controller
{
    public function calculateSMART()
    {
        // 1. Get Data
        $criterias = Criteria::all();
        $packages = Package::with('scorings.subCriteria.criteria')->get();

        // Get total number of criteria
        $totalCriteriaCount = $criterias->count();

        // Filter packages that have complete scorings
        $scorablePackages = $packages->filter(function ($package) use ($totalCriteriaCount) {
            return $package->scorings->count() >= $totalCriteriaCount;
        });

        if ($scorablePackages->isEmpty()) {
            return view('decission-support')->with('error', 'No packages with complete scoring data found.');
        }

        // 2. Normalize Weights
        $totalWeight = $criterias->sum('value');
        $normalizedWeights = $criterias->mapWithKeys(function ($criteria) use ($totalWeight) {
            return [$criteria->id => [
                'name' => $criteria->criteria,
                'weight' => $criteria->value,
                'normalized' => $totalWeight > 0 ? $criteria->value / $totalWeight : 0,
            ]];
        });

        // 3. Calculate Utility, Weighted Scores, and Final Scores
        $results = [];
        foreach ($scorablePackages as $package) {
            $finalScore = 0;
            $utilityScores = [];
            $weightedScores = [];

            foreach ($normalizedWeights as $criteriaId => $weightData) {
                $scoring = $package->scorings->where('id_criteria', $criteriaId)->first();

                if ($scoring && $scoring->subCriteria) {
                    $utility = (float) $scoring->subCriteria->value;
                    $normalizedWeight = $weightData['normalized'];
                    $weighted = $utility * $normalizedWeight;

                    $utilityScores[$criteriaId] = $utility;
                    $weightedScores[$criteriaId] = $weighted;
                    $finalScore += $weighted;
                } else {
                    // Handle case where a scoring might be missing for a criteria
                    $utilityScores[$criteriaId] = 0;
                    $weightedScores[$criteriaId] = 0;
                }
            }

            $results[] = [
                'package_name' => $package->name,
                'utility_scores' => $utilityScores,
                'weighted_scores' => $weightedScores,
                'final_score' => $finalScore,
            ];
        }

        // 4. Sort results by final score
        usort($results, function ($a, $b) {
            return $b['final_score'] <=> $a['final_score'];
        });

        return view('decission-support', [
            'normalizedWeights' => $normalizedWeights,
            'results' => $results,
            'criterias' => $criterias, // Pass criterias for table headers
        ]);
    }
}
