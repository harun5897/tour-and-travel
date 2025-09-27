<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoring extends Model
{
    use HasFactory;
    protected $table = 'scorings';

    protected $fillable = [
        'id_package',
        'id_criteria',
        'id_sub_criteria',
    ];

    public $timestamps = true;

    // Relation to model package
    public function package()
    {
        return $this->belongsTo(Package::class, 'id_package');
    }

    // Relation to model criteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria');
    }

    // Relation to model subCriteria
    public function subCriteria()
    {
        return $this->belongsTo(SubCriteria::class, 'id_sub_criteria');
    }
}
