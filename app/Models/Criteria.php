<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    protected $table = 'criterias';

    protected $fillable = [
        'criteria',
        'value',
    ];

    protected $casts = [
        'criteria'   => 'string',
        'value'      => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
