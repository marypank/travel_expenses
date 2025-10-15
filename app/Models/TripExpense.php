<?php

namespace App\Models;

use App\Models\Enum\SourceExpenseEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TripExpense extends Model
{
    /** @var string $table */
    protected $table = 'trip_expenses';

    /** @var array $fillable */
    protected $fillable = [
        'trip_id',
        'title',
        'description',
        'price',
        'currency_id',
        'currency_exchange_rate',
        'source',
        'pay_date',
        'image_url',
    ];

    /** @var array $casts */
    protected $casts = [
        'currency_exchange_rate' => 'decimal:2',
        'source' => SourceExpenseEnum::class,
        'pay_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_trip_expenses', 'trip_expense_id', 'tag_id');
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
