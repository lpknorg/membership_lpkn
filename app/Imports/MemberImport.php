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

class MemberImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){        
        try {
            DB::beginTransaction();
            // dd($rows);
            foreach ($rows->chunk(5) as $v) {
                foreach ($v as $value) {
                    if (strpos($value['email_aktif'], "@") !== false) {
                        $_nip = preg_replace('/\s+/', '', $value['nipnrp']);
                        $u = User::updateOrCreate(
                            [
                                'nik' => $value['nik']
                            ],
                            [
                                'nip' => $_nip,
                                'name' => $value['nama_lengkap'],
                                'email' => $value['email_aktif'],
                                'password' => \Hash::make($_nip),
                                'is_confirm' => 1,
                                'updated_at' => now()
                            ]
                        );
                        $u->syncRoles('member');
                        $m = Member::updateOrCreate(
                            [
                                'user_id' => $u->id,
                            ],
                            [
                                'no_hp' => $value['no_hp_whatsapp_aktif'],
                                'tempat_dan_tgl_lahir' => $value['tempat_tanggal_lahir'],
                                'pendidikan_terakhir' => $value['pendidikan_terakhir'],
                                'pas_foto3x4' => $value['upload_pas_foto_resmi_3x4'],
                                'file_sk_pengangkatan_asn' => $value['upload_sk_pengangkatan_asn'],
                                'foto_ktp' => $value['upload_foto_ktp']
                            ]
                        );
                        MemberKantor::updateOrCreate(
                            [
                                'member_id' => $m->id
                            ],
                            [
                                'status_kepegawaian' => $value['status_kepegawaian'],
                                'posisi_pelaku_pengadaan' => $value['posisi_pelaku_pengadaan'],
                                'jenis_jabatan' => $value['jenis_jabatan'],
                                'nama_jabatan' => $value['nama_jabatan'],
                                'golongan_terakhir' => $value['golongan_terakhir'],
                                'nama_instansi' => $value['instansiperusahaan'],
                                'pemerintah_instansi' => $value['pemerintah_kotakabupaten'],
                                'alamat_kantor_lengkap' => $value['alamat_lengkap_kantor']                                
                            ]
                        );
                    }                    
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
