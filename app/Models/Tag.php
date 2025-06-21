<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @var string $table */
    protected $table = 'tags';

    public $timestamps = false;

    /** @var array $fillable */
    protected $fillable = [
        'title',
    ];

    public function expenses(): BelongsToMany
    {
        return $this->belongsToMany(TripExpense::class, 'tags_trip_expenses', 'tag_id', 'trip_expense_id');
    }
}
