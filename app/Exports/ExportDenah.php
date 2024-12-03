<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    WithColumnWidths,
    WithStyles
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportDenah implements FromView, WithColumnWidths,WithStyles
{
    private $contHtml;
    private $detailEvent;
    public function __construct($data, $detail_event){
        $this->contHtml = $data;
        $this->detailEvent = $detail_event;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 25,
            'H' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:Z1000' => [ // Rentang cell yang ingin diberi gaya
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }


    public function view(): View
    {
        $data = $this->contHtml;
        $detail_event = $this->detailEvent;
        $expl = explode("-", $detail_event['event']['tgl_end']);
        $tgl_pelaksanaan = $expl[2].' '.\Helper::bulanIndo((int)$expl[1]).' '.$expl[0];
        return view('excel_denah', compact('data', 'tgl_pelaksanaan'));
    }
}