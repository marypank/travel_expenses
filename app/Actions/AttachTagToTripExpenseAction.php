<?php

namespace App\Actions;

use App\Models\Tag;
use App\Models\TripExpense;

class AttachTagToTripExpenseAction
{
    public const MAX_TAGS_FOR_EXPENSES = 2;

    private const ERROR_MESSAGE_MAX = 'max tags already added';
    private const ERROR_MESSAGE_EXISTS = 'trip expense tag already exists';

    // todo: custom exception
    public function handle(TripExpense $tripExpense, Tag $tag)
    {
        if ($tripExpense->tags()->count() >= self::MAX_TAGS_FOR_EXPENSES) {
            throw new \Exception(self::ERROR_MESSAGE_MAX);
        }

        if ($tripExpense->tags()->find($tag->id)) {
            throw new \Exception(self::ERROR_MESSAGE_EXISTS);
        }
        
        $tripExpense->tags()->attach($tag->id);
    }
}