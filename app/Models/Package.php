<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'cost',
    ];

    protected $casts = [
        'cost' => 'float',
    ];

    // Relation to model category
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Relation to model scoring
    public function scorings()
    {
        return $this->hasMany(Scoring::class, 'id_package');
    }
}
