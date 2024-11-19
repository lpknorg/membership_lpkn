<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\{
    FromView,
    WithColumnWidths,
    WithEvents,
    WithDrawings
};
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportPresensiPelatihan implements FromView, WithColumnWidths,WithEvents, WithDrawings
{
    private $alData;
    public function __construct($data){
        $this->alData = $data;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 50,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:B1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('f06e5d');

                // Atur tinggi baris (contoh: baris 1 untuk header)
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);

                // Jika ingin mengatur tinggi baris data (contoh: mulai dari baris ke-2)
                $users = $this->alData;
                $row = 2; // Baris awal data
                foreach ($users as $user) {
                    $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(100); // Tinggi baris disesuaikan dengan gambar
                    $row += 4;
                }

                // Atur alignment untuk seluruh kolom
                $highestRow = $event->sheet->getDelegate()->getHighestRow(); // Dapatkan baris terakhir
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn(); // Dapatkan kolom terakhir

                $event->sheet->getDelegate()->getStyle("A1:{$highestColumn}{$highestRow}")
                    ->getAlignment()
                    // ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) // Tengah horizontal
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);   // Tengah vertikal
                $event->sheet->getDelegate()->getStyle("B1:{$highestColumn}{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Tengah horizontal
            },
        ];
    }

    public function view(): View
    {
        $data = $this->alData;
        return view('excel_kegiatan.presensi_pelatihan', compact('data'));
    }

    public function drawings()
    {
        $drawings = [];
        $users = $this->alData;
        $row = 2; // Baris awal data (setelah heading)

        foreach ($users as $user) {
            $drawing = new Drawing();
            $drawing->setName('Profile Picture');
            $drawing->setDescription('User Profile Picture');

            // Pastikan `profile_picture` berisi path ke gambar (misalnya public/storage/images).            
            $drawing->setPath(public_path('uploaded_files/foto_profile/'.$user->foto_profile));
            $drawing->setHeight(100); // Tinggi gambar dalam piksel
            $drawing->setWidth(70); // Lebar gambar dalam piksel
            $drawing->setCoordinates('B' . $row); // Kolom untuk gambar

            $cellHeight = 20; // Tinggi sel dalam satuan Excel (dalam poin, sesuaikan dengan `setRowHeight`)
            $cellWidth = 50;  // Lebar sel dalam satuan Excel (estimasi, tergantung ukuran kolom)
            $imageHeight = 100; // Tinggi gambar (harus sama dengan setHeight)
            $imageWidth = 70;

            $drawing->setOffsetX(($cellWidth * 7.5 - $imageWidth) / 2); // 7.5 poin per unit Excel
            $drawing->setOffsetY(($cellHeight * 6 - $imageHeight) / 2); // 0.75 poin per unit Excel

            $drawings[] = $drawing;
            $row += 4;
        }

        return $drawings;
    }

}