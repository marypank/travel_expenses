<?php

namespace App\Models;

use App\Models\Enum\TripStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'status' => TripStatusEnum::class,
    ];

    public function expenses(): HasMany
    {
        return $this->hasMany(TripExpense::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_details', 'trip_detail_id', 'tag_id');
    }
}
