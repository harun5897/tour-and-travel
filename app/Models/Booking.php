<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'booking_code',
        'guest_name',
        'total_adult',
        'total_child',
        'package_id',
        'booking_date',
        'arrival_date',
        'departure_date',
        'price',
        'platform',
        'sales_id',
        'status',
    ];

    protected $casts = [
        'booking_date'   => 'date',
        'arrival_date'   => 'date',
        'departure_date' => 'date',
        'price'          => 'float',
        'platform'       => 'string',
        'status'         => 'string',
    ];

    // Relation to model package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Relation to model sales
    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
