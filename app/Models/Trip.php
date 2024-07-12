<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Trip extends Model
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
        'status',
    ];

    /** @var array $casts */
    protected $casts = [
        'date_to' => 'date',
        'date_from' => 'date',
    ];

    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(TripExpense::class, TripDetail::class);
    }
}
