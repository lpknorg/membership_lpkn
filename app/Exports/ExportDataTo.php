<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDataTo implements FromView, WithColumnWidths,WithEvents
{
    private $alData;
    public function __construct($data){
        $this->alData = $data;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 35,
            'C' => 20,
            'D' => 30,
            'E' => 20,
            'F' => 30,
            'G' => 20,
            'H' => 23,
            'I' => 70,
            'J' => 60,
            'K' => 70
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:K1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f06e5d');
            },
        ];
    }

    public function view(): View
    {
        $data = $this->alData;
        return view('excel_to', compact('data'));
    }
}