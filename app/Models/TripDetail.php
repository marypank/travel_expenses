<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function expenses(): HasMany
    {
        return $this->hasMany(TripExpense::class);
    }
}
