<?php

namespace App\Models;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'description',
    ];

    /** @var array $casts */
    protected $casts = [
        'date_to' => 'date',
        'date_from' => 'date',
        'status' => TripStatusEnum::class,
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(TripExpense::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
