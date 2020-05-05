<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DonationExport implements FromView, ShouldAutoSize, WithEvents
{
    private $donations    = null;
    public function __construct($donations)
    {
        $this->donations    = $donations;
    }

    public function view(): View
    {
        $donations  = $this->donations;
        return view('admin.export.donation', compact('donations'));
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

