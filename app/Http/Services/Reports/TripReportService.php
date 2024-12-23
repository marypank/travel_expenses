<?php

namespace App\Http\Services\Reports;

use App\Http\Services\Api\CurrencyService;
use App\Models\Enum\TripStatusEnum;
use App\Repositories\TripRepository;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Str;

class TripReportService
{
    public function __construct(
        private TripRepository $tripRepository,
        private CurrencyService $currencyService
    )
    {
        //
    }
    
    // todo: rename generateSpreadsheet, loadSpreadsheetToFolder, getSpreadsheetLinkToUser
    public function getSpreadsheet(int $tripId)
    {
        // todo: сделать отчет в зависимости от языка пользователя, не забыть про TripStatusEnum
        
        // todo: сделать как модель
        $mainData = [];

        // todo: $mainCollection = new Collection();
        // $mainCollection->put('info', []);
        $trip = $this->tripRepository->getById($tripId);
        $mainData[$this->getTransliterateTitle($trip->title)] = [
            'title' => $trip->title,
            'dateFrom' => $trip->date_from->format('Y-m-d'),
            'dateTo' => $trip->date_to->format('Y-m-d'),
            'daysCount' => (int)$trip->date_from->diffInDays($trip->date_to),
            'totalSum' => 0,
            'status' => TripStatusEnum::RUS_NAMES[$trip->status->value],
            'currency' => $this->currencyService->getById($trip->currency_id)->getName(),
        ];
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Info');


        foreach($trip->details as $key => $details) {
            /** TripDetails $details */
            $mainData[$this->getTransliterateTitle($details->title)] = [
                'title' => $details->title,
                'dateFrom' => $details->date_from->format('Y-m-d'),
                'dateTo' => $details->date_to->format('Y-m-d'),
                'daysCount' => (int)$details->date_from->diffInDays($details->date_to),
                'totalSum' => 0,
                'status' => TripStatusEnum::RUS_NAMES[$details->status->value],
                'country' => '', // todo: later
                'city' => '', // todo: later
            ];

            $workSheet = new Worksheet($spreadsheet, $this->getTransliterateTitle($details->title));
            $newSheet = $spreadsheet->addSheet($workSheet, 1);

            foreach ($details->expenses as $expenses) {
                // $mainData[$this->getTransliterateTitle($details->title)]['totalSum'] = 1;
            }
        }

        $key = 1;
        $sheet->setCellValue('A' . $key, 'title');
        $sheet->setCellValue('B' . $key, 'date from');
        $sheet->setCellValue('C' . $key, 'date to');
        $sheet->setCellValue('D' . $key, 'days count');
        $sheet->setCellValue('E' . $key, 'status');
        $sheet->setCellValue('F' . $key, 'currency');
        $sheet->setCellValue('G' . $key, 'total sum');
        $sheet->setCellValue('H' . $key, 'country');
        $sheet->setCellValue('I' . $key, 'city');
        $key++;

        // дни пофиксить. не включает 1 день как полный день, получается 0 (разница между датами)
        // расширить ячейки
        foreach ($mainData as $item) {
            $sheet->setCellValue('A' . $key, $item['title']);
            $sheet->setCellValue('B' . $key, $item['dateFrom']);
            $sheet->setCellValue('C' . $key, $item['dateTo']);
            $sheet->setCellValue('D' . $key, $item['daysCount']);
            $sheet->setCellValue('E' . $key, $item['status']);
            $sheet->setCellValue('F' . $key, $item['currency'] ?? '');
            $sheet->setCellValue('G' . $key, $item['totalSum']);
            $sheet->setCellValue('H' . $key, $item['country'] ?? '');
            $sheet->setCellValue('I' . $key, $item['city'] ?? '');

            $key++;
        }

        // todo: после УСПЕШНОГО скачивания отправлять запрос на удаление файла или сделать крон, который удалял каждый день файлы через какой-то период
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('reports')->put('CreateExcelTable.xlsx', $content); 

        $url = Storage::url('CreateExcelTable.xlsx');

        // todo: выставить ссылку на скачивание
    }


    private function addWorksheet(Spreadsheet $spreadsheet, int $index)
    {
        // todo: check
        $workSheet = new Worksheet($spreadsheet, 'second');
        $spreadsheet->addSheet($workSheet, $index);
    }

    private function getTransliterateTitle(string $title): string
    {
        return Str::transliterate($title);
    }
}