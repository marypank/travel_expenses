<?php

namespace App\Models\Dto\Tag;

use App\Models\Dto\BaseDto;

class TagDtoBase extends BaseDto
{
    protected const TITLE = 'title';

    protected ?string $title;


    private function __construct(
        string $title)
    {
        $this->title = $title;
    }

    public static function create(array $data): TagDtoBase
    {
        return new TagDtoBase($data['title']);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    protected function defineFields(): array
    {
        return [
            self::TITLE => $this->title,
        ];
    }
}