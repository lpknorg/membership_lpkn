<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class EventExportBerbayar implements FromView, WithColumnWidths,WithEvents
{
    private $evData;
    public function __construct($data){
        $this->evData = $data;
    }

	public function columnWidths(): array
    {
    	return [
    		'A' => 5,
    		'B' => 60,
    		'C' => 80,
    		'D' => 15,
    		'E' => 15,
    		'F' => 15,
    		'G' => 15,
    		'H' => 15,
            'I' => 85,
            'J' => 20,
            'K' => 20,
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
        $data = $this->evData;
        // dd($data);
        return view('admin.dashboard2.export_event_berbayar', compact('data'));
    }
}
