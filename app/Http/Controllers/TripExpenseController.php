<?php

namespace App\Http\Controllers;

use App\Models\TripExpense;
use Illuminate\Http\Request;

class TripExpenseController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        // 1. показать все траты по tripId (и внутри траты по parent_id)
        // 2. показать траты внутри трат (по parent_id)
        // 3. Обновление
        // 4. Сохранение
        // 5. Удаление родительского вместе с дочерними
        // 6. Удаление дочернего
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(TripExpense $tripExpense)
    {
        //
    }
}
