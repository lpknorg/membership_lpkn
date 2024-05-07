<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
	WithColumnFormatting,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class EventExport implements FromView, WithColumnWidths, WithColumnFormatting,WithEvents
{
    private $evData;
    public function __construct($data){
        $this->evData = $data;
    }

	public function columnFormats(): array
    {
    	return [
    		// 'A' => NumberFormat::FORMAT_NUMBER,
            // 'B' => NumberFormat::FORMAT_NUMBER,
            // 'E' => NumberFormat::FORMAT_NUMBER
    	];
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
    		'I' => 15,
            'J' => 65,
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:J1')
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
        return view('admin.dashboard2.export_event', compact('data'));
    }
}
