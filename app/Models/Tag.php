<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /** @var string $table */
    protected $table = 'tags';

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

    /* public function trips(): BelongsToMany
    {
        return $this->belongsToMany(Trip::class, 'tags_trips', 'tag_id', 'trip_id');
    }

    public function details(): BelongsToMany
    {
        return $this->belongsToMany(TripDetail::class, 'tags_trips', 'tag_id', 'trip_detail_id');
    }

    public function expenses(): BelongsToMany
    {
        return $this->belongsToMany(TripExpense::class, 'tags_trips', 'tag_id', 'trip_expense_id');
    } */
}
