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
    private $rangeTgl;
    public function __construct($data, $range_tgl){
        $this->alData = $data;
        $this->rangeTgl = $range_tgl;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 13,
            'B' => 45,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // $event->sheet->getDelegate()->getStyle('A1:H1')
                // ->getFill()
                // ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                // ->getStartColor()
                // ->setARGB('f2f2f2');
                // $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

                $users = $this->alData;

                //kunci
                $row = 13; //ini cell yg sejajar dengan garis yang ada fotonya
                $startMerge = 13; //ini cell yg sejajar dengan garis yang ada fotonya
                $start = 16; //ini cell yang pertama untuk instansi
                // end kunci

                // penyesuaian ukuran font untuk judul Daftar hadir presensi...
                for ($i=2; $i <= 5; $i++) { 
                    $event->sheet->getDelegate()->getStyle("A{$i}")->getFont()->setSize(13);
                }
                // penyesuaian ukuran font untuk judul Daftar hadir presensi...

                foreach ($users as $index => $user) {
                    $currentRow = $row + $index;
                    $event->sheet->getDelegate()->getRowDimension($row)->setRowHeight(90);
                    $row += 4;
                }

                // bold seluruh cell
                $event->sheet->getDelegate()->getStyle("A1:Z1000")
                ->getFont()
                ->setBold(true);
                // bold seluruh cell

                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();

                //wrap text untuk bagian instansi agar tidak terlalu panjang 
                $increment = 4;
                for ($i = $start; $i <= $highestRow; $i += $increment) {
                    $event->sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
                }
                //wrap text untuk bagian instansi agar tidak terlalu panjang                

                // center seluruh text pada cell
                $event->sheet->getDelegate()->getStyle("A1:{$highestColumn}{$highestRow}")
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // center seluruh text pada cell

                // center tanggal dan jumlah peserta
                $event->sheet->getDelegate()->getStyle("A6:B9")
                ->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP)
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // center tanggal dan jumlah peserta                

                // merge & center spesifik cells                
                $incrementMerge = 4;
                for ($i = $startMerge; $i <= $highestRow; $i += $incrementMerge) {
                    $batas2 = $i+3;
                    if (count($this->rangeTgl) >= 1) {
                        $event->sheet->mergeCells("C{$i}:C{$batas2}");                        
                        $event->sheet->mergeCells("D{$i}:D{$batas2}");

                        $event->sheet->getDelegate()->getStyle("C{$i}:C{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        $event->sheet->getDelegate()->getStyle("D{$i}:D{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
                    if (count($this->rangeTgl) >= 2) {
                        $event->sheet->mergeCells("E{$i}:E{$batas2}");
                        $event->sheet->mergeCells("F{$i}:F{$batas2}");

                        $event->sheet->getDelegate()->getStyle("E{$i}:E{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        $event->sheet->getDelegate()->getStyle("F{$i}:F{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
                    if (count($this->rangeTgl) >= 3) {
                        $event->sheet->mergeCells("G{$i}:G{$batas2}");
                        $event->sheet->mergeCells("H{$i}:H{$batas2}");

                        $event->sheet->getDelegate()->getStyle("G{$i}:G{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                        $event->sheet->getDelegate()->getStyle("H{$i}:H{$batas2}")
                        ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    }
                }                
            },
        ];
    }

    public function view(): View
    {
        $data        = $this->alData;
        $range_tgl   = $this->rangeTgl;
        $colPresensi = count($range_tgl) * 2;
        $colJudul = count($range_tgl) * 2 + 2;
        $imgKop = count($range_tgl) == 2 ? public_path('img/kop-presensi2.jpg') : public_path('img/kop-presensi3.jpg');
        $tgl1 = explode(" ",$range_tgl[0]['tanggal_penuh']);
        $tgl2 = explode(" ",$range_tgl[count($range_tgl)-1]['tanggal_penuh']);
        // dd($tgl1);
        if ($tgl1[2] == $tgl2[2]) {
            $tglPelaksanaan = $tgl1[1]." - ".$tgl2[1]." ".$tgl1[2]." ".$tgl1[3];
        }else{
            $tglPelaksanaan = $tgl1[1]." ". $tgl1[2] ." - ".$tgl2[1]." ".$tgl2[2]." ".$tgl1[3];
        }
        return view('excel_kegiatan.presensi_pelatihan', compact('data', 'range_tgl', 'colPresensi', 'imgKop', 'colJudul', 'tglPelaksanaan'));
    }

    public function drawings()
    {
        $drawings = [];
        $users = $this->alData;
        $row = 4; // Baris awal data (setelah heading)

        foreach ($users as $user) {
            if ($user->userDetail->member) {
                $image = Image::make(public_path('uploaded_files/foto_profile/'.$user->userDetail->member->foto_profile))
                ->resize(200, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
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
        }

        return $drawings;
    }

}