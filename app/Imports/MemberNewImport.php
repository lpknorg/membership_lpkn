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
    private $batchKode;
    private $idEvent;
    public function __construct($batch, $id_event){
        $this->batchKode = $batch;
        $this->idEvent   = $id_event;
    }

    private function reindexArray(array $array): array
    {
        return array_map(function ($row) {
            return array_values($row);
        }, $array);
    }
    public function array(array $data){
        try {
            DB::beginTransaction();
            $arrPeserta = [];
            foreach ($data as $key => $v) {   
                $kecamatanId = null;
                $kotaId = null;
                $provId = null;
                $keIid = null;
                if (isset($v['email'])) {
                    $fixTglLahir = $v['tempat_tanggal_lahir'];
                    array_push($arrPeserta, [
                        'id_kelas_event'    => $this->idEvent,
                        'nama_lengkap'      => isset($v['nama_tanpa_gelar']) ? $v['nama_tanpa_gelar'] : $v['nama_dengan_gelar'],
                        'no_hp'             => $v['no_hp'],
                        'email'             => $v['email'],
                        'instansi'          => $v['instansi_perusahaan'],
                        'unit_organisasi'   => $v['unit_organisasi'],
                        'alamat'            => $v['alamat_lengkap_kantor'],
                        'nik'               => $v['nik'],
                        'tempat_lahir'      => $fixTglLahir,
                        'tgl_lahir'         => $fixTglLahir,
                        'status_pembayaran' => 1
                    ]);
                    $checkUser = User::where('email', $v['email'])->first();
                    $checkKodePos = KodePos::where('kode_pos', $v['kode_pos'])->select('id', 'kode_pos', 'id_kecamatan')->first();                    
                    if ($checkKodePos) {
                        $kecamatanId = $checkKodePos->id_kecamatan;
                        $kotaId = $checkKodePos->kecamatan()->exists() ? $checkKodePos->kecamatan->id_kota : null;
                        $provId = $checkKodePos->kecamatan()->exists() && $checkKodePos->kecamatan->kota->exists() ? $checkKodePos->kecamatan->kota->id_provinsi : null;
                        $keIid = $checkKodePos->kelurahan()->exists() ? $checkKodePos->kelurahan->id : null;
                    }                    
                    if ($checkUser) {
                        $checkUser->update([
                            'import_batch' => $this->batchKode,
                            'email' => $v['email'],
                            'name' => isset($v['nama_tanpa_gelar']) ? $v['nama_tanpa_gelar'] : $v['nama_dengan_gelar'],
                            'nip' => $v['nip'],
                            'nik' => $v['nik'],
                            'paket_kontribusi' => isset($v['paket_kontribusi']) ? $v['paket_kontribusi'] : null,
                            'user_has_update_dateimport' => 1
                        ]);                        
                        $checkUser->member->update([
                            'pendidikan_terakhir' => $v['pendidikan_terakhir'],
                            'no_hp' => $v['no_hp'],
                            'pendidikan_terakhir' => $v['pendidikan_terakhir'],
                            'tempat_lahir' => $fixTglLahir,
                            'alamat_lengkap' => $v['alamat_lengkap_kantor'],
                            'tgl_lahir' => $fixTglLahir,
                            'jenis_kelamin' => isset($v['jenis_kelamin']) ? ($v['jenis_kelamin'] == 'Perempuan' ? 'P' : 'L') : null,
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

                            'kode_pos' => isset($v['kode_pos']) && is_integer($v['kode_pos']) ? $v['kode_pos'] : null,
                            'unit_organisasi' => $v['unit_organisasi'],
                            'posisi_pelaku_pengadaan' => $v['posisi_pelaku_pengadaan'],
                            'jenis_jabatan' => $v['jenis_jabatan'],
                            'nama_jabatan' => $v['nama_jabatan'],
                            'golongan_terakhir' => $v['golongan_terakhir']
                        ]);
                    }else{
                        $user = User::create([
                            'import_batch' => $this->batchKode,
                            'email' => $v['email'],
                            'name' => isset($v['nama_tanpa_gelar']) ? $v['nama_tanpa_gelar'] : $v['nama_dengan_gelar'],
                            'password' => \Hash::make('lpkn123'),
                            'nip' => $v['nip'],
                            'nik' => $v['nik'],
                            'paket_kontribusi' => isset($v['paket_kontribusi']) ? $v['paket_kontribusi'] : null,
                            'user_has_update_dateimport' => 1,
                            'created_at' => now()
                        ]);

                        $member = Member::create([
                            'user_id' => $user->id,
                            'pendidikan_terakhir' => $v['pendidikan_terakhir'],
                            'no_hp' => $v['no_hp'],
                            'tempat_lahir' => $fixTglLahir,
                            'tgl_lahir' => $fixTglLahir,
                            'jenis_kelamin' => isset($v['jenis_kelamin']) ? ($v['jenis_kelamin'] == 'Perempuan' ? 'P' : 'L') : null,
                            'nama_lengkap_gelar' => isset($v['nama_dengan_gelar']) ? $v['nama_dengan_gelar'] : $v['nama_tanpa_gelar'],
                            'pendidikan_terakhir' => $v['pendidikan_terakhir'],
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

                            'kode_pos' => isset($v['kode_pos']) && is_integer($v['kode_pos']) ? $v['kode_pos'] : null,
                            'unit_organisasi' => $v['unit_organisasi'],
                            'posisi_pelaku_pengadaan' => $v['posisi_pelaku_pengadaan'],
                            'jenis_jabatan' => $v['jenis_jabatan'],
                            'nama_jabatan' => $v['nama_jabatan'],
                            'golongan_terakhir' => $v['golongan_terakhir']
                        ]);
                    }
                }
            }
            // $endpoint = env('API_EVENT').'member/Regis_event/import_regis_event';
            $endpoint = 'http://localhost/event.lpkn.id/api/member/Regis_event/import_regis_event';
            $datapost = ['data_peserta'=>$arrPeserta];
            \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
            DB::commit();            
        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die;

        }
    }
}

