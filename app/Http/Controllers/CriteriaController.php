<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function getDataCriteria() {
        $criterias = Criteria::select('id', 'criteria', 'value', 'created_at', 'updated_at')->get();

        return view('criterias', [
            'criterias' => $criterias ?? collect([])
        ]);
    }
    public function getDetailDataCriteria($id) {
        $criteria = Criteria::findOrFail($id);
        return view('form.update-criteria', compact('criteria'));
    }
    public function createCriteria(Request $request) {
        $request->validate([
            'criteria' => 'required|string|max:255',
            'value'    => 'required|numeric',
        ]);

        Criteria::create([
            'criteria' => $request->criteria,
            'value'    => $request->value,
        ]);

        return redirect('/criterias')->with('success', 'Criteria created successfully.');
    }
    public function updateCriteria(Request $request, $id) {
        $request->validate([
            'criteria' => 'required|string|max:255',
            'value'    => 'required|numeric',
        ]);

        $criteria = Criteria::findOrFail($id);
        $criteria->criteria = $request->criteria;
        $criteria->value    = $request->value;

        $criteria->save();

        return redirect('/criterias')->with('success', 'Criteria updated successfully.');
    }
    public function deleteCriteria($id) {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        return redirect('/criterias')->with('success', 'Criteria deleted successfully.');
    }
}
