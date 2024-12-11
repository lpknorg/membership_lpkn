<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    WithColumnWidths,
    WithStyles,
    WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;


class ExportDenah implements FromView, WithColumnWidths,WithStyles, WithEvents
{
    private $contHtml;
    private $waktuPelaksanaan;
    private $lokasiUjian;

    public function __construct($request){
        $this->contHtml = $request->tag_html;
        $this->waktuPelaksanaan = $request->waktu_pelaksanaan;
        $this->lokasiUjian = $request->lokasi_ujian;
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                // Atur margin halaman
                $sheet->getPageMargins()->setTop(0.5);    // Margin atas
                $sheet->getPageMargins()->setRight(0.5);  // Margin kanan
                $sheet->getPageMargins()->setLeft(0.5);   // Margin kiri
                $sheet->getPageMargins()->setBottom(0.5); // Margin bawah

                $sheet->getPageSetup()->setHorizontalCentered(true);
            },
        ];
    }



    public function view(): View
    {
        $data_html = $this->contHtml;
        $data_waktu = $this->waktuPelaksanaan;
        $data_lokasi = $this->lokasiUjian;
        return view('excel_denah', compact('data_html', 'data_waktu', 'data_lokasi'));
    }
}