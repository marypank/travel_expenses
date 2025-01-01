<?php

namespace App\Http\Services\Reports;

use App\Http\Services\Api\CurrencyService;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\Trip\TripReportDto;
use App\Models\Enum\SourceExpenseEnum;
use App\Repositories\TripRepository;
use Carbon\Carbon;
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
        private CurrencyService $currencyService,
        private TripExpenseService $tripExpenseService,
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

        $tripTitle = $this->getTransliterateTitle($trip->title);

        $mainCollection = new Collection();
        // todo: как по ключу посчитать и засунуть конечную сумму путешествия
        $mainCollection->put($tripTitle, new TripReportDto(
            $trip->title,
            $trip->date_from,
            $trip->date_to,
            $trip->status,
            $this->currencyService->getById($trip->currency_id)->getName()
        ));
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($tripTitle);

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

            $newSheet = $this->addWorksheet($spreadsheet, 1, $this->getTransliterateTitle($details->title));

            $detailsExpenses = $details->expenses->filter(function ($item) {
                if (!is_null($item->parent_id)) {
                    return false;
                }

                $this->tripExpenseService->modfifyForShow($item, true);
                return true;
            })->sortBy(function ($expense) {
                return $expense->pay_date;
            });

            $key = 1;
            $newSheet->setCellValue('A' . $key, 'title');
            $newSheet->setCellValue('B' . $key, 'description');
            $newSheet->setCellValue('C' . $key, 'source');
            $newSheet->setCellValue('D' . $key, 'payDate');
            $newSheet->setCellValue('E' . $key, 'price');
            $newSheet->setCellValue('F' . $key, 'currency');
            $newSheet->setCellValue('G' . $key, 'currency rate');
            $newSheet->setCellValue('H' . $key, 'main currency sum');
            $newSheet->setCellValue('I' . $key, 'main currency');
            $key++;
            $detailsExpenses->each(function ($item) use (&$key, $newSheet, $trip, $tripMainRepo) {
                $expenseCurrency = $this->currencyService->getById($item->currency_id); // todo: заменить
                $currencyRate = $item->current_currency_exchange ?: $expenseCurrency->getValue();
                $sum = $currencyRate * $item->price;

                $tripMainRepo->addSum($sum);

                $newSheet->setCellValue('A' . $key, $item->title);
                $newSheet->setCellValue('B' . $key, $item->description);
                $newSheet->setCellValue('C' . $key, $item->sourceType);
                $newSheet->setCellValue('D' . $key, $item->pay_date);
                $newSheet->setCellValue('E' . $key, $item->price);
                $newSheet->setCellValue('F' . $key, $expenseCurrency->getName());
                $newSheet->setCellValue('G' . $key, $currencyRate);
                $newSheet->setCellValue('H' . $key, $sum);
                $newSheet->setCellValue('I' . $key, $this->currencyService->getById($trip->currency_id)->getName()); // todo: вынести и заменить общей

                // todo: здесь надо children, потом разделить через mergeCells
                $key++;
                $newSheet->mergeCells('A' . $key . ':I' . $key);
                $key++;
            });

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

        $path = $tripTitle . Carbon::now()->format('d-m-Y') . '.xlsx';
        // todo: после УСПЕШНОГО скачивания отправлять запрос на удаление файла или сделать крон, который удалял каждый день файлы через какой-то период
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $content = ob_get_contents();
        ob_end_clean();

        Storage::disk('reports')->put($path, $content); 

        $url = Storage::url($path);

        // todo: выставить ссылку на скачивание
    }


    private function addWorksheet(Spreadsheet $spreadsheet, int $index, string $title)
    {
        // todo: check
        $workSheet = new Worksheet($spreadsheet, $title);
        return $spreadsheet->addSheet($workSheet, $index);
    }

    private function getTransliterateTitle(string $title): string
    {
        return Str::transliterate($title);
    }
}