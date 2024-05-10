<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
	FromView,
	WithColumnWidths,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class ExportAlumniByEvent implements FromView, WithColumnWidths,WithEvents
{
    private $alData;
    private $alTipe;
    public function __construct($data, $tipe){
        $this->alData = $data;
        $this->alTipe = $tipe;
    }

	public function columnWidths(): array
    {
    	return [
    		'A' => 8,
    		'B' => 40,
    		'C' => 15,
    		'D' => 30,
    		'E' => 60,
            'F' => 40,
            'G' => 20,
    	];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A3:G3')
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
        $tipe = $this->alTipe;
        // dd($data);
        return view('admin.dashboard2.export_alumni_by_event', compact('data', 'tipe'));
    }
}