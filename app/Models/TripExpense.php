<?php

namespace App\Models;

use App\Models\Enum\SourceExpenseEnum;

class TripExpense extends BaseModel
{
    /** @var string $table */
    protected $table = 'trip_expenses';

    /** @var array $fillable */
    protected $fillable = [
        'trip_detail_id',
        'currency_id',
        'current_currency_exchange',
        'source',
        'title',
        'slug',
        'description',
        'parent_id',
    ];

    /** @var array $casts */
    protected $casts = [
        'current_currency_exchange' => 'decimal:2', // todo: is that right?
        'source' => SourceExpenseEnum::class,
        'date_to' => 'date',
        'date_from' => 'date',
    ];

    // todo: check if its correct later
    public function parent()
    {
        return $this->hasOne(TripExpense::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(TripExpense::class, 'parent_id', 'id');
    }
}
