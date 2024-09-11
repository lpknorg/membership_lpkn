<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class ExportAlumni implements FromView, WithColumnWidths,WithEvents
{
    private $alData;
    public function __construct($data){
        $this->alData = $data;
    }

	public function columnWidths(): array
    {
    	return [
    		'A' => 5,
    		'B' => 40,
    		'C' => 15,
    		'D' => 30,
    		'E' => 20,
            'F' => 20,
            'G' => 30,
            'H' => 30,
            'I' => 20,
            'J' => 50,
            'K' => 70,
            'L' => 20,
            'M' => 30,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 40,
            'R' => 40,
            'S' => 40,
            'T' => 100
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:T1')
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
        return view('admin.user.export_alumni', compact('data'));
    }
}