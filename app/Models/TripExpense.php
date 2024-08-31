<?php

namespace App\Models;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'price',
        'image'
    ];

    // todo: fix, вместо 9.99 пишет в базу 9.00
    /** @var array $casts */
    protected $casts = [
        'current_currency_exchange' => 'decimal:2', // todo: is that right?
        'source' => SourceExpenseEnum::class,
        'date_to' => 'date',
        'date_from' => 'date',
        'pay_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function parent(): HasOne
    {
        return $this->hasOne(TripExpense::class, 'id', 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(TripExpense::class, 'parent_id', 'id');
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(TripDetail::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_expenses', 'trip_expense_id', 'tag_id');
    }
}
