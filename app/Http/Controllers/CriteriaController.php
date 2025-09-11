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
}
