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
use PhpOffice\PhpSpreadsheet\Worksheet\{Drawing, MemoryDrawing};
use Intervention\Image\Facades\Image;

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
            'B' => 30,
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
                ->setARGB('f2f2f2');
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

                $users = $this->alData;
                $row = 2;
                foreach ($users as $index => $user) {
                    $currentRow = $row + $index;
                    $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(90); 
                    $event->sheet->getDelegate()->getStyle("B{$currentRow}")
                        ->getFont()
                        ->setBold(true);
                    $row += 4;
                }

                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();

                $event->sheet->getDelegate()->getStyle("A1:{$highestColumn}{$highestRow}")
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle("B1:{$highestColumn}{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
            $image = Image::make(public_path('uploaded_files/foto_profile/'.$user->foto_profile))
            ->resize(200, 150, function ($constraint) {
                $constraint->aspectRatio(); // Menjaga aspek rasio gambar
                // $constraint->upsize();     // Tidak memperbesar gambar kecil
            });

            //memory
            $memoryImage = new MemoryDrawing();
            $memoryImage->setName('Profile Picture');
            $memoryImage->setDescription('User Profile Picture');
            $memoryImage->setImageResource($image->getCore()); // Ambil resource gambar
            $memoryImage->setRenderingFunction(MemoryDrawing::RENDERING_PNG); // Atur format gambar
            $memoryImage->setMimeType(MemoryDrawing::MIMETYPE_PNG); // Atur MIME type
            $memoryImage->setHeight(110); // Atur tinggi gambar
            $memoryImage->setCoordinates('B' . $row); // Lokasi gambar di Excel
            // end memory

            $cellHeight = 15; // Tinggi sel dalam satuan Excel (dalam poin, sesuaikan dengan `setRowHeight`)
            $cellWidth = 30;  // Lebar sel dalam satuan Excel (estimasi, tergantung ukuran kolom)
            $imageHeight = 80; // Tinggi gambar (harus sama dengan setHeight)
            $imageWidth = 80;

            $memoryImage->setOffsetX(($cellWidth * 6.7 - $imageWidth) / 2); // 7.5 poin per unit Excel
            $memoryImage->setOffsetY(($cellHeight * 6 - $imageHeight) / 2); // 0.75 poin per unit Excel

            $drawings[] = $memoryImage;
            $row += 4;
        }

        return $drawings;
    }

}