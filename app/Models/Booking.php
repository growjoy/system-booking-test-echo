<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'booking_date',
        'booking_time',
        'service',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];
}