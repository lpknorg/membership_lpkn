<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToArray,
    WithHeadingRow
};
use Illuminate\Support\Facades\Hash;
use DB;

class MemberNewImport implements ToArray, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private function reindexArray(array $array): array
    {
        return array_map(function ($row) {
            return array_values($row);
        }, $array);
    }
    public function array(array $rows){
        $data = $this->reindexArray($rows);
        try {
            DB::beginTransaction();
            foreach ($data as $key => $v) {
                if (!is_null($v[0])) {
                    echo $key.'==>'.$v[0].'<br>';
                    $checkUser = User::where('email', $v[0])->first();
                    $expl1 = explode(",", $v[3]);
                    if ($checkUser) {
                        $checkUser->update([
                            'email' => $v[0],
                            'name' => $v[1],
                            'nip' => $v[7],
                            'nik' => $v[8],
                            'paket_kontribusi' => $v[18],
                            'user_has_update_dateimport' => 1
                        ]);
                        $checkUser->member->update([
                            'no_hp' => $v[2],
                            'tempat_lahir' => $expl1[0],
                            'tgl_lahir' => $expl1[1],                            
                            'jenis_kelamin' => $v[17] == 'Perempuan' ? 'P' : 'L',
                            'foto_profile' => $v[19],
                            'foto_ktp' => $v[20],
                            'file_sk_pengangkatan_asn' => $v[21]
                        ]);
                        $checkUser->member->memberKantor->update([
                            'nama_instansi' => $v[5],
                            'pemerintah_instansi' => $v[6],
                            'status_kepegawaian' => $v[9],
                            'alamat_kantor_lengkap' => $v[10],
                            'kode_pos' => $v[11],
                            'unit_organisasi' => $v[12],
                            'posisi_pelaku_pengadaan' => $v[13],
                            'jenis_jabatan' => $v[14],
                            'nama_jabatan' => $v[15],
                            'golongan_terakhir' => $v[16]
                        ]);
                    }else{
                        $user = User::create([
                            'email' => $v[0],
                            'name' => $v[1],
                            'password' => \Hash::make('lpkn123'),
                            'nip' => $v[7],
                            'nik' => $v[8],
                            'paket_kontribusi' => $v[18],
                            'user_has_update_dateimport' => 1,
                            'created_at' => now()
                        ]);

                        $member = Member::create([
                            'user_id' => $user->id,
                            'no_hp' => $v[2],
                            'tempat_lahir' => $expl1[0],
                            'tgl_lahir' => $expl1[1],                    
                            'jenis_kelamin' => $v[17] == 'Perempuan' ? 'P' : 'L',
                            'foto_profile' => $v[19],
                            'foto_ktp' => $v[20],
                            'file_sk_pengangkatan_asn' => $v[21]
                        ]);
                        $memberKantor = MemberKantor::create([
                            'member_id' => $member->id,
                            'nama_instansi' => $v[5],
                            'pemerintah_instansi' => $v[6],
                            'status_kepegawaian' => $v[9],
                            'alamat_kantor_lengkap' => $v[10],
                            'kode_pos' => $v[11],
                            'unit_organisasi' => $v[12],
                            'posisi_pelaku_pengadaan' => $v[13],
                            'jenis_jabatan' => $v[14],
                            'nama_jabatan' => $v[15],
                            'golongan_terakhir' => $v[16]
                        ]);
                    }
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
