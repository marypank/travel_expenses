<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\SourceExpenseEnumService;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        return response()->json([
            'data' => $this->sourceExpenseEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
