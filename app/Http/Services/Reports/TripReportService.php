<?php

namespace App\Http\Services\Reports;

use App\Models\Enum\TripStatusEnum;
use App\Repositories\TripRepository;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TripReportService
{
    public function __construct(private TripRepository $tripRepository)
    {
        //
    }
    // todo: rename
    public function getSpreadsheet(int $tripId)
    {
        // todo: можно сделать как модель
        $mainData = [];

        // 1. достать трип и его relations
        $trip = $this->tripRepository->getById($tripId);
        $mainData[] = [
            'title' => $trip->title,
            'dateFrom' => $trip->date_from->format('Y-m-d'),
            'dateTo' => $trip->date_to->format('Y-m-d'),
            'daysCount' => (int)$trip->date_from->diffInDays($trip->date_to),
            'price' => 0,
            'status' => TripStatusEnum::RUS_NAMES[$trip->status->value], // todo: replace for users language
        ];
        
        foreach($trip->details as $key => $details) {
            /** TripDetails $details */
            $mainData[$key]['title'] = $details->title;

            foreach ($details->expenses as $expenses) {
                //
            }
        }

        // test add aditional sheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('main');

        $workSheet = new Worksheet($spreadsheet, 'second');
        $spreadsheet->addSheet($workSheet, 1);


        // todo: после УСПЕШНОГО скачивания отправлять запрос на удаление файла или сделать крон, который удалял каждый день файлы через какой-то период
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('reports')->put('CreateExcelTable.xlsx', $content); 

        $url = Storage::url('CreateExcelTable.xlsx');

        // todo: разделить все на блоки, позволить скачать, т.е возмонжо выставить ссылку на скачивание
    }
}