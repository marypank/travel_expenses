<?php

namespace App\Models;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Database\Eloquent\Model;

class TripExpense extends Model
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
        'description',
        'parent_id',
        'pay_date',
    ];

    /** @var array $casts */
    protected $casts = [
        'current_currency_exchange' => 'decimal:2', // todo: is that right?
        'source' => SourceExpenseEnum::class,
        'date_to' => 'date',
        'date_from' => 'date',
        'pay_date' => 'date',
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
