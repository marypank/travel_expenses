<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\SourceExpenseEnumService;

class SourceExpenseController extends Controller
{
    public function __construct(private readonly SourceExpenseEnumService $sourceExpenseEnumService)
    {}

    public function index()
    {
        return response()->json([
            'data' => $this->sourceExpenseEnumService->all(true),
            'message' => '',
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'data' => $this->sourceExpenseEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }
}
