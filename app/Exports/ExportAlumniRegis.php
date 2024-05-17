<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class ExportAlumniRegis implements FromView, WithColumnWidths,WithEvents
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
            'G' => 20
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:G1')
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
        return view('admin.dashboard2.export_alumni_regis', compact('data'));
    }
}