<?php

namespace App\Http\Services\Reports;

use App\Http\Services\Api\CurrencyService;
use App\Models\Dto\Trip\TripReportDto;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
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

        $trip = $this->tripRepository->getById($tripId);
        if ($trip) {
            // todo: check after policy
        }

        $mainCollection = new Collection();
        // todo: как по ключу посчитать и засунуть конечную сумму путешествия
        $mainCollection->put($this->getTransliterateTitle($trip->title), new TripReportDto(
            $trip->title,
            $trip->date_from,
            $trip->date_to,
            $trip->status,
            $this->currencyService->getById($trip->currency_id)->getName()
        ));
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($this->getTransliterateTitle($trip->title));

        $tripDetails = $trip->details->sortBy(function ($detail) {
            return $detail->date_to;
        });
        foreach($tripDetails as $key => $details) {
            $tripMainRepo = new TripReportDto(
                $details->title,
                $details->date_from,
                $details->date_to,
                $details->status,
                // todo: add country and city later
            );

            $workSheet = new Worksheet($spreadsheet, $this->getTransliterateTitle($details->title));
            $newSheet = $spreadsheet->addSheet($workSheet, 1);

            foreach ($details->expenses as $expenses) {
                // $tripMainRepo->addSum();
            }

            $mainCollection->put($this->getTransliterateTitle($details->title), $tripMainRepo);
        }

        // todo: вынести
        $key = 1;
        $sheet->setCellValue('A' . $key, 'title');
        $sheet->setCellValue('B' . $key, 'date from');
        $sheet->setCellValue('C' . $key, 'date to');
        $sheet->setCellValue('D' . $key, 'days count');
        $sheet->setCellValue('E' . $key, 'total sum');
        $sheet->setCellValue('F' . $key, 'status');
        $sheet->setCellValue('G' . $key, 'currency');
        $sheet->setCellValue('H' . $key, 'country');
        $sheet->setCellValue('I' . $key, 'city');
        $key++;

        $mainCollection->each(function (TripReportDto $item, string $title) use (&$key, $sheet) {
            $sheet->fromArray($item->toArray(true), null, 'A' . $key);
            $key++;
        });

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