<?php

namespace App\Models;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'status' => TripStatusEnum::class,
    ];

    public function expenses(): HasManyThrough
    {
        return $this->hasManyThrough(TripExpense::class, TripDetail::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(TripDetail::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_trips', 'trip_id', 'tag_id');
    }
}
