<?php

namespace App\Models\Dto;

abstract class BaseDto
{
    public abstract function toArray(): array;
}