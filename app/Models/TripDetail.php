<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripDetail extends Model
{
    /** @var string $table */
    protected $table = 'trip_details';

    /** @var array $fillable */
    protected $fillable = [
        'trip_id',
        'title',
        'slug',
        'description',
        'date_to',
        'date_from',
        'country_id',
        'city_id',
        'status',
    ];

    /** @var array $casts */
    protected $casts = [
        'date_to' => 'date',
        'date_from' => 'date',
    ];
}
