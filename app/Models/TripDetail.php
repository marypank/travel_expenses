<?php

namespace App\Models;

class TripDetail extends BaseModel
{
    /** @var string $table */
    protected $table = 'trip_details';

    /** @var array $fillable */
    protected $fillable = [
        'trip_id',
        'date_to',
        'date_from',
        'country_id',
        'city_id'
    ];

    /** @var array $casts */
    protected $casts = [
        'date_to' => 'date',
        'date_from' => 'date',
    ];
}
