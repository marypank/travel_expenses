<?php

namespace App\Http\Controllers;

use App\Http\Services\SourceExpenseService;

class SourceExpenseController extends Controller
{
    /** @var SourceExpenseService $sourceExpenseService */
    private SourceExpenseService $sourceExpenseService;

    public function __construct(SourceExpenseService $sourceExpenseService)
    {
        $this->sourceExpenseService = $sourceExpenseService;
    }

    public function index()
    {
        return $this->sourceExpenseService->all();
    }

    public function show(int $id)
    {
        return $this->sourceExpenseService->getById($id);
    }
}
