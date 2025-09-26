<?php

namespace App\Actions;

use App\Models\Tag;
use App\Models\TripExpense;

class DetachTagFromTripExpenseAction
{
    public function handle(TripExpense $tripExpense, Tag $tag)
    {
        $tripExpense->tags()->detach($tag->id);
    }
}