<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class EventExportGratis implements FromView, WithColumnWidths,WithEvents
{
    private $evData;
    public function __construct($data){
        $this->evData = $data;
    }

	public function columnWidths(): array
    {
    	return [
    		'A' => 5,
    		'B' => 90,
    		'C' => 15,
    		'D' => 18,
    		'E' => 30,
            'F' => 20
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:F1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f06e5d');
            },
        ];
    }

    public function view(): View
    {
        $data = $this->evData;
        return view('admin.dashboard2.export_event_gratis', compact('data'));
    }
}