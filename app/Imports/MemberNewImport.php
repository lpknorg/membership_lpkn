<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Admin\{Member, MemberKantor, KodePos, Kecamatan};
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
    public function array(array $data){
        // $data = $this->reindexArray($rows);        
        try {
            DB::beginTransaction();
            foreach ($data as $key => $v) {   
                $kecamatanId = null;
                $kotaId = null;
                $provId = null;
                $keIid = null;
                if (isset($v['email'])) {
                    $checkUser = User::where('email', $v['email'])->first();
                    $checkKodePos = KodePos::where('kode_pos', $v['kode_pos'])->select('id', 'kode_pos', 'id_kecamatan')->first();                    
                    if ($checkKodePos) {
                        $kecamatanId = $checkKodePos->id_kecamatan;
                        $kotaId = $checkKodePos->kecamatan()->exists() ? $checkKodePos->kecamatan->id_kota : null;
                        $provId = $checkKodePos->kecamatan()->exists() && $checkKodePos->kecamatan->kota->exists() ? $checkKodePos->kecamatan->kota->id_provinsi : null;
                        $keIid = $checkKodePos->kelurahan()->exists() ? $checkKodePos->kelurahan->id : null;
                    }
                    $expl1 = explode(", ", $v['tempat_tanggal_lahir']);
                    if ($checkUser) {
                        $checkUser->update([
                            'email' => $v['email'],
                            'name' => isset($v['nama_tanpa_gelar']) ? $v['nama_tanpa_gelar'] : $v['nama_dengan_gelar'],
                            'nip' => $v['nip'],
                            'nik' => $v['nik'],
                            'paket_kontribusi' => $v['paket_kontribusi'],
                            'user_has_update_dateimport' => 1
                        ]);
                        if(count($expl1) > 1){
                            $removed = preg_replace('/\s+/', ' ', $expl1[1]);
                            $removed = str_replace('-', ' ', $expl1[1]);
                            $a = explode(" ", $removed);
                            $bulan = strtolower($a[1]);
                            $fixTglLahir = \Helper::convertFromBulanIndo($bulan, $a);
                        }
                        $checkUser->member->update([
                            'no_hp' => $v['no_hp'],
                            'tempat_lahir' => $expl1[0],
                            'alamat_lengkap' => $v['alamat_lengkap_kantor'],
                            'tgl_lahir' => count($expl1) < 2 ? null : $fixTglLahir,
                            'jenis_kelamin' => $v['jenis_kelamin'] == 'Perempuan' ? 'P' : 'L',
                            'nama_lengkap_gelar' => isset($v['nama_dengan_gelar']) ? $v['nama_dengan_gelar'] : $v['nama_tanpa_gelar'],

                            'prov_id' => $provId,
                            'kota_id' => $kotaId,
                            'kecamatan_id' => $kecamatanId,
                            'kelurahan_id' => $keIid,

                            'foto_profile' => $v['pas_foto'],
                            'foto_ktp' => $v['ktp'],
                            'file_sk_pengangkatan_asn' => $v['sk_pengangkatan_asn']
                        ]);
                        $checkUser->member->memberKantor->update([
                            'nama_instansi' => $v['instansi_perusahaan'],
                            'pemerintah_instansi' => $v['pemerintah_kota'],
                            'status_kepegawaian' => $v['status_kepegawaian'],
                            'alamat_kantor_lengkap' => $v['alamat_lengkap_kantor'],

                            'kantor_prov_id' => $provId,
                            'kantor_kota_id' => $kotaId,
                            'kantor_kecamatan_id' => $kecamatanId,
                            'kantor_kelurahan_id' => $keIid,

                            'kode_pos' => $v['kode_pos'],
                            'unit_organisasi' => $v['unit_organisasi'],
                            'posisi_pelaku_pengadaan' => $v['posisi_pelaku_pengadaan'],
                            'jenis_jabatan' => $v['jenis_jabatan'],
                            'nama_jabatan' => $v['nama_jabatan'],
                            'golongan_terakhir' => $v['golongan_terakhir']
                        ]);
                    }else{
                        $user = User::create([
                            'email' => $v['email'],
                            'name' => isset($v['nama_tanpa_gelar']) ? $v['nama_tanpa_gelar'] : $v['nama_dengan_gelar'],
                            'password' => \Hash::make('lpkn123'),
                            'nip' => $v['nip'],
                            'nik' => $v['nik'],
                            'paket_kontribusi' => $v['paket_kontribusi'],
                            'user_has_update_dateimport' => 1,
                            'created_at' => now()
                        ]);
                        if(count($expl1) > 1){
                            $removed = preg_replace('/\s+/', ' ', $expl1[1]);
                            $removed = str_replace('-', ' ', $expl1[1]);
                            $a = explode(" ", $removed);
                            $bulan = strtolower($a[1]);
                            $fixTglLahir = \Helper::convertFromBulanIndo($bulan, $a);
                        }

                        $member = Member::create([
                            'user_id' => $user->id,
                            'no_hp' => $v['no_hp'],
                            'tempat_lahir' => $expl1[0],
                            'tgl_lahir' => count($expl1) < 2 ? null : $fixTglLahir,      
                            'jenis_kelamin' => $v['jenis_kelamin'] == 'Perempuan' ? 'P' : 'L',
                            'nama_lengkap_gelar' => isset($v['nama_dengan_gelar']) ? $v['nama_dengan_gelar'] : $v['nama_tanpa_gelar'],

                            'prov_id' => $provId,
                            'kota_id' => $kotaId,
                            'kecamatan_id' => $kecamatanId,
                            'kelurahan_id' => $keIid,

                            'foto_profile' => $v['pas_foto'],
                            'alamat_lengkap' => $v['alamat_lengkap_kantor'],
                            'foto_ktp' => $v['ktp'],
                            'file_sk_pengangkatan_asn' => $v['sk_pengangkatan_asn']
                        ]);
                        $memberKantor = MemberKantor::create([
                            'member_id' => $member->id,
                            'nama_instansi' => $v['instansi_perusahaan'],
                            'pemerintah_instansi' => $v['pemerintah_kota'],
                            'status_kepegawaian' => $v['status_kepegawaian'],
                            'alamat_kantor_lengkap' => $v['alamat_lengkap_kantor'],

                            'kantor_prov_id' => $provId,
                            'kantor_kota_id' => $kotaId,
                            'kantor_kecamatan_id' => $kecamatanId,
                            'kantor_kelurahan_id' => $keIid,

                            'kode_pos' => $v['kode_pos'],
                            'unit_organisasi' => $v['unit_organisasi'],
                            'posisi_pelaku_pengadaan' => $v['posisi_pelaku_pengadaan'],
                            'jenis_jabatan' => $v['jenis_jabatan'],
                            'nama_jabatan' => $v['nama_jabatan'],
                            'golongan_terakhir' => $v['golongan_terakhir']
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