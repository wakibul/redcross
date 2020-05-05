<?php

namespace App\Exports;

use App\Models\Help;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class HelpExport implements FromView, ShouldAutoSize, WithEvents
{
    private $helps    = null;
    public function __construct($helps)
    {
        $this->helps    = $helps;
    }

    public function view(): View
    {
        $helps  = $this->helps;
        return view('admin.export.open-help', compact('helps'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:Z1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
                $event->sheet->autoSize();
                $event->sheet->getDelegate()->getStyle($event->sheet->calculateWorksheetDimension())->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $styleArray = [
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('A2:A100')->applyFromArray($styleArray);
            },
        ];
    }
}
