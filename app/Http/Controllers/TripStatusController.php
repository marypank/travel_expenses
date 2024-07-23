<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\TripStatusService;

class TripStatusController extends Controller
{

    public function __construct(private TripStatusService $tripStatusService)
    {}

    public function index()
    {
        return $this->tripStatusService->all();
    }

    public function show(int $id)
    {
        return $this->tripStatusService->getById($id);
    }
}
