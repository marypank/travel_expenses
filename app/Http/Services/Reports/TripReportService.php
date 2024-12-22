<?php

namespace App\Http\Services\Reports;

use App\Repositories\TripRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class TripReportService
{
    public function __construct(private TripRepository $tripRepository)
    {
        //
    }
    // todo: rename
    public function getSpreadsheet(int $tripId)
    {
        // 1. достать трип и его relations
        $trip = $this->tripRepository->getById($tripId);

        // 2. инициализировать спредшит
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. записать все в спредшит
        // 4. выдать, что формирование окончено
        // 5. позволить скачать
    }
}