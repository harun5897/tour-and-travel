<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCriteria;

class SubCriteriaController extends Controller
{
    public function getDataSubCriteria() {
        $subCriterias = SubCriteria::with('criteria')
            ->select('id', 'id_criteria', 'sub_criteria', 'value', 'created_at', 'updated_at')
            ->get();

        $subCriterias->each(function ($subCriteria) {
            $subCriteria->criteria_name = $subCriteria->criteria->criteria ?? '-';
        });

        return view('sub-criterias', [
            'subCriterias' => $subCriterias,
        ]);
    }
}
