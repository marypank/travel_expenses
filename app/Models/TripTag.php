<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripTag extends Model
{
    use HasFactory;

    /** @var string $table */
    protected $table = 'trip_tags';

    public $timestamps = false;

    /** @var array $fillable */
    protected $fillable = [
        'title',
        'can_choose',
        'for_expense_only',
    ];

    /** @var array $casts */
    protected $casts = [
        'for_expense_only' => 'boolean',
        'can_choose' => 'boolean',
    ];

    // todo: one to many through trips, trip_details, trip_expenses
}
