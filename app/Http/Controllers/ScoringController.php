<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scoring;
use App\Models\Package;
use App\Models\Criteria;
use App\Models\SubCriteria;

class ScoringController extends Controller
{
    public function getDataScoring() {
        $criterias = Criteria::select('id', 'criteria')->get();
        $packages = Package::with('scorings.subCriteria')->get();

        return view('scorings', [
            'criterias' => $criterias,
            'packages' => $packages,
        ]);
    }
    public function showFormCreateScoring() {
        $packages = Package::with('category')
            ->select('id', 'category_id', 'name', 'description', 'cost', 'created_at', 'updated_at')
            ->get();

        $packages->each(function ($package) {
            $package->category_name = $package->category->name ?? '-';
        });
        $criterias = Criteria::select('id', 'criteria')->get();
        $subCriterias = SubCriteria::with('criteria')
            ->select('id', 'id_criteria', 'sub_criteria', 'value', 'created_at')
            ->orderBy('id_criteria')
            ->orderBy('id')
            ->get()
            ->groupBy('id_criteria');

        return view('form.create-scoring', [
            'packages' => $packages,
            'criterias' => $criterias,
            'subCriterias' => $subCriterias
        ]);
    }
    public function createScoring(Request $request) {
        $totalCriteria = Criteria::count();

        $validationRules = [
            'id_package' => [
                'required',
                'exists:packages,id',
                function ($value, $fail) use ($totalCriteria) {
                    $scoringCount = Scoring::where('id_package', $value)->count();
                    if ($scoringCount >= $totalCriteria) {
                        $fail('The selected package has already been fully scored.');
                    }
                },
            ],
            'criterias' => "required|array|size:$totalCriteria",
            'criterias.*.id_criteria' => 'required|exists:criterias,id',
            'criterias.*.id_sub_criteria' => 'required|exists:sub_criterias,id',
        ];

        $customAttributes = [
            'id_package' => 'package',
        ];
        if ($request->has('criterias')) {
            foreach ($request->input('criterias') as $index => $criteriaData) {
                if (isset($criteriaData['id_criteria'])) {
                    $criteria = Criteria::find($criteriaData['id_criteria']);
                    if ($criteria) {
                        $customAttributes["criterias.$index.id_sub_criteria"] = strtolower($criteria->criteria);
                    }
                }
            }
        }

        $request->validate($validationRules, [], $customAttributes);

        $id_package = $request->input('id_package');
        $criterias = $request->input('criterias');

        foreach ($criterias as $criteria) {
            if (isset($criteria['id_sub_criteria'])) {
                Scoring::updateOrCreate(
                    [
                        'id_package' => $id_package,
                        'id_criteria' => $criteria['id_criteria'],
                    ],
                    [
                        'id_sub_criteria' => $criteria['id_sub_criteria'],
                    ]
                );
            }
        }

        return redirect('/scorings')->with('success', 'Scoring created successfully');
    }
    public function deleteScoring($id) {
        Scoring::where('id_package', $id)->delete();

        return redirect('/scorings')->with('success', 'Scoring data deleted successfully.');
    }

    public function updateScoring(Request $request, $id)
    {
        $totalCriteria = Criteria::count();

        $validationRules = [
            'criterias' => "required|array|size:$totalCriteria",
            'criterias.*.id_criteria' => 'required|exists:criterias,id',
            'criterias.*.id_sub_criteria' => 'required|exists:sub_criterias,id',
        ];

        $customAttributes = [];
        if ($request->has('criterias')) {
            foreach ($request->input('criterias') as $index => $criteriaData) {
                if (isset($criteriaData['id_criteria'])) {
                    $criteria = Criteria::find($criteriaData['id_criteria']);
                    if ($criteria) {
                        $customAttributes["criterias.$index.id_sub_criteria"] = strtolower($criteria->criteria);
                    }
                }
            }
        }

        $request->validate($validationRules, [], $customAttributes);

        $criterias = $request->input('criterias');

        foreach ($criterias as $criteria) {
            if (isset($criteria['id_sub_criteria'])) {
                Scoring::updateOrCreate(
                    [
                        'id_package' => $id, // Use $id from route
                        'id_criteria' => $criteria['id_criteria'],
                    ],
                    [
                        'id_sub_criteria' => $criteria['id_sub_criteria'],
                    ]
                );
            }
        }

        return redirect('/scorings')->with('success', 'Scoring updated successfully.');
    }
    public function getDetailDataScoring($id)
    {
        $package = Package::with(['category', 'scorings'])->findOrFail($id);
        $criterias = Criteria::all();
        $subCriterias = SubCriteria::all()->groupBy('id_criteria');

        // Create a map of criteria_id => sub_criteria_id for the package's existing scores
        $packageScorings = $package->scorings->pluck('id_sub_criteria', 'id_criteria');

        return view('form.update-scoring', compact('package', 'criterias', 'subCriterias', 'packageScorings'));
    }
}
