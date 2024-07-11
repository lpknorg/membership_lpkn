<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDataFormByEvent implements FromView, WithColumnWidths,WithEvents
{
    private $alData;
    public function __construct($data){
        $this->alData = $data;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 35,
            'D' => 35,
            'E' => 20,
            'F' => 30,
            'G' => 20,
            'H' => 30,
            'I' => 20,
            'J' => 25,
            'K' => 25,
            'L' => 23,
            'M' => 35,
            'N' => 20,
            'O' => 45,
            'P' => 20,
            'Q' => 23,
            'R' => 20,
            'S' => 70,
            'T' => 60,
            'U' => 70,
            'V' => 10,
            'W' => 50,
            'X' => 20,
            'Y' => 20,
            'Z' => 20,
            'AA' => 28
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:AA1')
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
        return view('data_form_event', compact('data'));
    }
}