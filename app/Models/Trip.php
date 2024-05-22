<?php

namespace App\Models;

class Trip extends BaseModel
{
    /** @var string $table */
    protected $table = 'trips';

    /** @var array $fillable */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'date_to',
        'date_from',
    ];

    /** @var array $casts */
    protected $casts = [
        'date_to' => 'date',
        'date_from' => 'date',
    ];
}
