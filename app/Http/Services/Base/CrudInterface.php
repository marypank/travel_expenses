<?php

namespace App\Http\Services\Base;

interface CrudInterface
{
    public function create();

    public function update();

    public function delete();
}