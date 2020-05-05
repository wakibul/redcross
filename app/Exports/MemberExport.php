<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class MemberExport implements FromView, ShouldAutoSize, WithEvents
{
    private $members    = null;
    public function __construct($members)
    {
        $this->members    = $members;
    }

    public function view(): View
    {
        $members  = $this->members;
        return view('admin.export.approved-member', compact('members'));
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
