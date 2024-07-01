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
            'I' => 15,
            'J' => 25,
            'K' => 25,
            'L' => 20,
            'M' => 30,
            'N' => 20,
            'O' => 23,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 40,
            'T' => 40,
            'U' => 50,
            'V' => 10,
            'W' => 30,
            'X' => 30,
            'Y' => 30,
            'Z' => 30
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:Z1')
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