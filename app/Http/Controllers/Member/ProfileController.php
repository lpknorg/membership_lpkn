<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin\{Member, MemberKantor, Provinsi, Instansi};
use DB;

class ProfileController extends Controller
{
    public function getRespApi($endpoint){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($endpoint);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function getRespApiLpknidWithParam($datapost, $url){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_LPKN_ID').$url;
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }


    public function index()
    {
    	$new_event = $this->getRespApi('https://event.lpkn.id/api/member/event');
        $user = \Auth::user();
        return view('member.profile.index', compact('user', 'new_event'));
    }

    public function allEvent($page=1, Request $request){
        if ($request->keyword) {
            $url = 'https://event.lpkn.id/api/member/event/search_event_page?page='.$page.'&keyword='.$request->keyword;
        }else{
            $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        }        
        
        $event = $this->getRespApi($url);
        // dd($event);
        return view('pages.event.index', compact('event'));
    }

    public function peraturan(){
        return view('pages.peraturan.index');
    }

    public function download_peraturan(Request $request){
        $param = $request->param;
        $datapost = ['param' => $param];
        $result = $this->getRespApiLpknidWithParam($datapost, 'download/json_pasal');
        $peraturans = $result['peraturans'];
        print_r($peraturans);die;
    }

    public function editProfile(){
        $user = \Auth::user();
        $provinsi = Provinsi::select('id', 'nama')->orderBy('nama')->get();
        $instansi = Instansi::orderBy('nama')->get();
        return view('member.profile.update_profile', compact('user', 'provinsi', 'instansi'));
    }

    public function updateProfile(Request $request){
        $Id = \Auth::user()->id;
        $user = User::findOrFail($Id);
        if ($request->pas_foto == "undefined") {
            $request['pas_foto'] = null;
        }
        if ($request->foto_ktp == "undefined") {
            $request['foto_ktp'] = null;
        }

        $validator = Validator::make($request->all(), array(
            'nip' => "required|numeric",
            'nik' => "required",
            'email' => "required",
            'pendidikan_terakhir' => "required",
            'nama_tanpa_gelar' => "required",
            'nama_dengan_gelar' => "required",
            'no_hp' => "required",
            'tempat_lahir' => "required",
            'tgl_lahir' => "required",
            'jenis_kelamin' => "required",
            'alamat_lengkap_rumah' => "required",
            'rumah_provinsi' => "required",
            'rumah_kota' => "required",
            'rumah_kecamatan' => "required",
            'rumah_kelurahan' => "required",
            'kategori_pekerjaan' => "required",
            'status_kepegawaian' => "required",
            'posisi_pelaku_pengadaan' => "required",
            'jenis_jabatan' => "required",
            'nama_jabatan' => "required",
            'golongan_terakhir' => "required",
            'tempat_kerja' => "required",
            'pemerintah_instansi' => "required",
            'alamat_lengkap_kantor' => "required",
            'kantor_provinsi' => "required",
            'kantor_kota' => "required",
            'kantor_kecamatan' => "required",
            'kantor_kelurahan' => "required",
            'pas_foto' => "required",
            'foto_ktp' => "required",
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        if ($request->kategori_pekerjaan == 0) {
            $validator = Validator::make($request->only(['instansi', 'lembaga_pemerintahan']), array(
                'instansi' => "required",
                'lembaga_pemerintahan' => "required"
            ));

            if ($validator->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => $validator->errors()->first(),
                ], 422);
            }
        }else{
            $request['instansi'] = null;
            $request['lembaga_pemerintahan'] = null;
        }

        if ($request->kategori_pekerjaan == 4) {
            $validator = Validator::make($request->only('pekerjaan_lainnya'), array(
                'pekerjaan_lainnya' => "required"
            ));

            if ($validator->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => $validator->errors()->first(),
                ], 422);
            }
        }else{
            $request['pekerjaan_lainnya'] = null;
        }
        $npas_foto3x4 = null;
        $nfoto_ktp = null;
        $nfile_sk_pengangkatan_asn = null;
        if ($request->hasFile('pas_foto')){
            $npas_foto3x4 = \Helper::storeFile('pas_foto', $request->pas_foto);
        }
        if ($request->hasFile('foto_ktp')){
            $nfoto_ktp = \Helper::storeFile('foto_ktp', $request->foto_ktp);
        }
        if ($request->hasFile('sk_pengangkatan_asn')){
            $nfile_sk_pengangkatan_asn = \Helper::storeFile('sk_pengangkatan_asn', $request->sk_pengangkatan_asn);
        }
        try {
            DB::beginTransaction();
            $user->update([
                'name' => $request->nama_tanpa_gelar,
                'email' => $request->email
            ]);
            $user->member->update([
                'nip'=> $request->nip,
                'nik'=> $request->nik,
                'nama_lengkap_gelar'=> $request->nama_dengan_gelar,
                'no_hp'=> $request->no_hp,
                'tempat_lahir'=> $request->tempat_lahir,
                'tgl_lahir'=> $request->tgl_lahir,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,

                'jenis_kelamin'=> $request->jenis_kelamin,
                'alamat_lengkap'=> $request->alamat_lengkap_rumah,
                'prov_id'=> $request->rumah_provinsi,
                'kota_id'=> $request->rumah_kota,
                'kecamatan_id'=> $request->rumah_kecamatan,
                'kelurahan_id'=> $request->rumah_kelurahan,
                // 'kelurahan_id'=> $request->rumah_kelurahan,
                'pas_foto3x4' => $npas_foto3x4,
                'foto_ktp' => $nfoto_ktp,
                'file_sk_pengangkatan_asn' => $nfile_sk_pengangkatan_asn,
            ]);
            $user->member->memberKantor->update([
                'kategori_pekerjaan_id' => $request->kategori_pekerjaan,
                'instansi_id' => $request->instansi,
                'lembaga_pemerintahan_id' => $request->lembaga_pemerintahan,
                'kategori_pekerjaan_lainnya' => $request->pekerjaan_lainnya,

                'status_kepegawaian' => $request->status_kepegawaian,
                'posisi_pelaku_pengadaan' => $request->posisi_pelaku_pengadaan,
                'jenis_jabatan' => $request->jenis_jabatan,
                'nama_jabatan' => $request->nama_jabatan,
                'golongan_terakhir' => $request->golongan_terakhir,

                'nama_instansi' => $request->tempat_kerja,
                'pemerintah_instansi' => $request->pemerintah_instansi,
                'alamat_kantor_lengkap' => $request->alamat_lengkap_kantor,
                'kantor_prov_id'=> $request->kantor_provinsi,
                'kantor_kota_id'=> $request->kantor_kota,
                'kantor_kecamatan_id'=> $request->kantor_kecamatan,
                'kantor_kelurahan_id'=> $request->kantor_kelurahan,
            ]);
            DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die;
        }
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil update profile"
        ], 200);
    }

    public function detailEvent($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/event/event_detail';
        $request = $client->post($endpoint, ['form_params' => $datapost]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function getEventModal($slug){
        if (\Auth::check()) {
            $member = \Auth::user();
            $datapost = ['slug' => $slug, 'email' => $member->email];
            $event = $this->detailEvent($datapost);
            $data['detail_event'] = $event;
            $data['member'] = $member;
            // dd($event);
            if ($event['status'] == 0) {
                return view('response.event.get_event')->with($data);
            }else if($event['status'] == 1){
                return view('response.event.get_event_status')->with($data);
            }else if($event['status'] == 2){
                return view('response.event.get_event_lunas')->with($data);
            }
        }else{
            dd('engga');
        }
    }
    
    public function getVideoMateri($slug){
        $datapost = ['slug' => $slug];
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_SSERTIFIKAT').'member/get_materi_by_slug';
        $request = $client->post($endpoint, ['form_params' => $datapost]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $data = $data['materi'];
        $_data = $data[0]['video'];
        $arr = explode("\r\n", $_data);
        // dd($arr);
        echo json_encode($arr);
        // return $data;
    }

    public function eventRegist($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/action/regis_event';
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function regisEvent(Request $request){
        $user = \Auth::user();
        $data = array(
            'id_event' => $request->id_event, 
            'email' => $user->email, 
            'nama_lengkap' => $user->name,
            'alamat_lengkap' => $user->member->alamat_lengkap,
            'ref' => null,
            'biaya' => $request->biaya,
            'no_hp' => $user->member->no_hp
        );
        $slug = $request->slug;
        $getRes = $this->eventRegist($data);
        if ($getRes['status'] == "sukses") {
            $resp['success'] = true;
            $resp['msg'] = 'Berhasil Mendaftar';
            $resp['slug'] = $slug;
        }else if($getRes['status'] == 'duplikat'){
            $resp['success'] = false;
            $resp['msg'] = 'Anda sudah terdaftar';
        }else{
            $resp['success'] = false;
            $resp['msg'] = 'Gagal';
        }
        return $resp;

    }

    public function buktiUpload($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/action/upload_bukti';
        $request = $client->post($endpoint, [
            'multipart' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function uploadBukti(Request $request){
        if (!isset($request->bukti)) {
            $data['success'] = false;
            $data['msg'] = "Dokumen bukti harus diupload";            
            return $data;
        }
        if ($request->hasFile('bukti')) {
            $validator = Validator::make($request->only('bukti'), [
                'bukti' => ['mimes:jpg,png,jpeg', 'max:3000'],
            ]);

            if ($validator->fails()) {
                $data['success'] = false;
                $data['msg'] = "File harus berupa gambar dengan format jpg atau png";            
                return $data;
            }
        }
        $client = new \GuzzleHttp\Client();
        $id_regis = $request->id_regis;
        $bukti = $request->bukti;
        $slug = $request->slug;
        // $data = ['id_regis' => $id_regis, 'bukti' => $bukti];
        $data = [
            [
                'name'     => 'bukti',
                'contents' => $bukti->getContent(),
                'filename' => $bukti->getClientOriginalName()
            ],
            [
                'name'     => 'id_regis',
                'contents' => $id_regis
            ]
        ];
        $getRes = $this->buktiUpload($data);
        return $getRes;

    }
}