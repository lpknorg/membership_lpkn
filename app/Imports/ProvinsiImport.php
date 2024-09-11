<?php

namespace App\Imports;

use App\Models\Admin\Provinsi;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow
};
use Illuminate\Support\Facades\Hash;
use DB;

class ProvinsiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){        
        try {
            DB::beginTransaction();
            foreach ($rows->chunk(5) as $v) {
                foreach ($v as $value) {
                    $nama = preg_replace('/[0-9]/', '', $value['nama']);
                    $nama = str_replace('. ', '', $nama);
                    Provinsi::updateOrCreate(
                        [
                            'nama' => $nama
                        ]
                    );
                }
            }
            echo "berhasil";
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die;

        }
    }
}
