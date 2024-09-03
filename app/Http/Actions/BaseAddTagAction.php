<?php

namespace App\Http\Actions;

use App\Repositories\BaseRepository;
use App\Repositories\TripExpenseRepository;

abstract class BaseAddTagAction
{
    public const MAX_RECORDS_FOR_EXPENSES = 2;

    public const MAX_RECORDS_FOR_OTHERS = 3;

    private const ERROR_MESSAGE = 'max tags already added';

    abstract protected function getRepository(): BaseRepository;

    public function handle(int $id, int $tagId)
    {
        $repo = $this->getRepository();
        $data = $repo->getById($id);

        if ($repo instanceof TripExpenseRepository) {
            if ($this->isRecordExpensesLimit($data->tags()->count())) {
                throw new \Exception(self::ERROR_MESSAGE); // todo: custom
            }
        } else {
            if ($this->isRecordLimit($data->tags()->count())) {
                throw new \Exception(self::ERROR_MESSAGE); // todo: custom
            }
        }

        $data->tags()->attach($tagId);
    }

    public function isRecordExpensesLimit(int $tagCount): bool
    {
        return $tagCount >= self::MAX_RECORDS_FOR_OTHERS;
    }
    
    public function isRecordLimit(int $tagCount): bool
    {
        return $tagCount >= self::MAX_RECORDS_FOR_OTHERS;
    }
}