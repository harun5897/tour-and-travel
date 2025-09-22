<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCriteria;
use App\Models\Criteria;

class SubCriteriaController extends Controller
{
    public function getDataSubCriteria() {
        $subCriterias = SubCriteria::with('criteria')
            ->select('id', 'id_criteria', 'sub_criteria', 'value', 'created_at')
            ->orderBy('id_criteria')
            ->orderBy('id')
            ->get();

        $subCriterias->each(function ($subCriteria) {
            $subCriteria->criteria_name = $subCriteria->criteria->criteria ?? '-';
        });

        return view('sub-criterias', [
            'subCriterias' => $subCriterias,
        ]);
    }
    public function showFormCreateSubCriteria() {
        $criterias = Criteria::select('id', 'criteria')->get();

        return view('form.create-subCriteria', [
            'criterias' => $criterias,
        ]);
    }
    public function getDetailSubCriteria($id) {
        $subCriteria = SubCriteria::with('criteria')
            ->select('id', 'id_criteria', 'sub_criteria', 'value', 'created_at', 'updated_at')
            ->findOrFail($id);

        $criterias = Criteria::select('id', 'criteria')->get();

        return view('form.update-subCriteria', [
            'subCriteria' => $subCriteria,
            'criterias' => $criterias,
        ]);
    }
    public function createSubCriteria(Request $request) {
        $request->validate([
            'id_criteria'  => 'required|exists:criterias,id',
            'sub_criteria' => 'required|string|max:255',
            'value'        => 'required|numeric',
        ]);
        SubCriteria::create([
            'id_criteria'  => $request->id_criteria,
            'sub_criteria' => $request->sub_criteria,
            'value'        => $request->value,
        ]);
        return redirect('/sub-criterias')->with('success', 'Sub Criteria created successfully.');
    }
    public function updateSubCriteria(Request $request, $id) {
        $request->validate([
            'id_criteria'  => 'required|exists:criterias,id',
            'sub_criteria' => 'required|string|max:255',
            'value'        => 'required|numeric',
        ]);
        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->update([
            'id_criteria'  => $request->id_criteria,
            'sub_criteria' => $request->sub_criteria,
            'value'        => $request->value,
        ]);
        return redirect('/sub-criterias')->with('success', 'Sub Criteria updated successfully.');
    }
    public function deleteSubCriteria($id) {
        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->delete();

        return redirect('/sub-criterias')->with('success', 'Sub Criteria deleted successfully.');
    }
}
