<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_criterias';

    protected $fillable = [
        'id_criteria',
        'sub_criteria',
        'value',
    ];

    protected $casts = [
        'sub_criteria' => 'string',
        'value'        => 'float',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    // Relation to model criteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'id_criteria');
    }
}
