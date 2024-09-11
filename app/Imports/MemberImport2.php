<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow
};
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class MemberImport2 implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){        
        ini_set('max_execution_time', 3000);
        try {
            DB::beginTransaction();
            // dd($rows);
            foreach ($rows->chunk(5) as $v) {
                foreach ($v as $value) {
                    if (strpos($value['email'], "@") !== false) {
                        $_nip = preg_replace('/\s+/', '', $value['nip']);
                        $u = User::updateOrCreate(
                            [
                                'email' => $value['email']
                            ],
                            [
                                'nip' => $_nip,
                                'name' => $value['nama_lengkap'],
                                'no_member' => $value['no_member'],
                                'nik' => $value['nik'],
                                'password' => Hash::make(123123),
                                'is_confirm' => 1,
                                'updated_at' => now()
                            ]
                        );
                        $u->syncRoles('member');
                        $_tgllahir = '-';
                        if ($value['tgl_lahir']) {
                            if ($value['tgl_lahir'] == '0000-00-00') {
                                $_tgllahir = '1999-01-01';
                            }else{
                                $datex = explode('/', $value['tgl_lahir']);
                                if (count($datex) > 1) {
                                    if (!checkdate($datex[1], $datex[0], $datex[2])) {
                                        $_tgllahir = '1999-01-02';
                                    }else{
                                        $_tgllahir = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['tgl_lahir']))->format('Y-m-d');
                                    }
                                }                                
                                
                            }                            
                        }else{
                            $_tgllahir = '-';
                        }
                        $m = Member::updateOrCreate(
                            [
                                'user_id' => $u->id,
                            ],
                            [
                                'no_hp' => $value['no_hp'],
                                'tgl_lahir' => $_tgllahir,
                                'pendidikan_terakhir' => $value['pendidikan_terakhir'],
                                'alamat_lengkap' => $value['domisili'],
                                'profil_singkat' => $value['profil_singkat']
                            ]
                        );
                        MemberKantor::updateOrCreate(
                            [
                                'member_id' => $m->id
                            ],
                            [
                                'nama_jabatan' => $value['jabatan'],
                                'nama_instansi' => $value['tempat_kerja']
                            ]
                        );
                    }                    
                    echo $value['id'].'---';
                }

            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die;
        }
    }
}
