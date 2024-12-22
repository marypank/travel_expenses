<?php

namespace App\Http\Controllers;

use App\Http\Services\Reports\TripReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private TripReportService $tripReportService)
    {
        //
    }

    // todo: вместо id можно загрузить Trip $trip
    public function trip(int $id)
    {
        $result = $this->tripReportService->getSpreadsheet($id);
        // expenses by trip by trip id (POLICY)
        // todo: check if THIS tripId BELONGS to THIS user
        // xlsx|xls report
    }
}
