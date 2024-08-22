<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\TripStatusService;

class TripStatusController extends Controller
{

    public function __construct(private TripStatusService $tripStatusService)
    {}

    public function index()
    {
        return $this->tripStatusService->all(true);
    }

    public function show(int $id)
    {
        return $this->tripStatusService->getByValue($id, true);
    }
}
