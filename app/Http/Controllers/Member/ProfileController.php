<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{User, UserSosialMedia, MemberSertifikatLainnya};
use App\Models\Admin\{Member, MemberKantor, Provinsi, Instansi, SosialMedia};
use DB;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Member\SertifikatKamuController;

class ProfileController extends Controller
{
    public function getRespApi($endpoint){
        $client = new \GuzzleHttp\Client(['verify' => false]);
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
        $new_event = $this->getRespApi(env('API_EVENT').'member/event');
        $user = \Auth::user();        
        return view('member.profile.index', compact('user', 'new_event'));
    }

    public function editProfile(){
        $user = \Auth::user();
        $path = \Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile');        
        // dd('file gaada');
        $endpoint = env('API_EVENT').'member/event/event_kelulusan';
        $datapost = ['email' => \Auth::user()->email];
        $list_event_ujian = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
        $provinsi = Provinsi::select('id', 'nama')->orderBy('nama')->get();
        $instansi = Instansi::orderBy('nama')->get();
        $sosmed = SosialMedia::orderBy('nama')->get();
        return view('member.profile.update_profile', compact('user', 'provinsi', 'instansi', 'sosmed', 'list_event_ujian'));
    }
    public function editPassword(){
        $user = \Auth::user();
        return view('member.profile.update_password', compact('user'));
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), array(
            'password_lama'       => ['required'],
            'password_baru'       => ['required', 'min:8'],
            'password_konfirmasi' => ['required', 'min:8', 'same:password_baru']
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        //ini api user
        if(\Auth::check()){
            $_Id = \Auth::user()->id;
            $cek = \Hash::check($request->password_lama, \Auth::user()->password);
            $cek_baru = \Hash::check($request->password_baru, \Auth::user()->password);
        }else{
            $u = User::where('email', $request->email)->first();
            $_Id = $u->id;
            $cek = \Hash::check($request->password_lama, $u->password);
            $cek_baru = \Hash::check($request->password_baru, $u->password);
        }
        if (!$cek) {
            return response()->json([
                'status'   => "fail",
                'messages' => "Password saat ini salah.",
            ], 422);
        }
        if ($cek_baru) {
            return response()->json([
                'status'   => "fail",
                'messages' => "Password tidak boleh sama seperti sebelumnya.",
            ], 422);
        }

        $user = User::findOrFail($_Id);
        $user->update([
            'password' => \Hash::make($request->password_baru)
        ]);
        $_user = User::where('id', $_Id)->with(['member.alamatProvinsi', 'member.alamatKota', 'member.alamatKecamatan', 'member.alamatKelurahan', 'member.memberKantor'])->first();
        
        return response()->json([
            'data' => $_user,
            'status'   => "ok",
            'messages' => "Berhasil melakukan update password.",
        ], 200);
    }

    public function updateProfile(Request $request){
        $Id = $request->id_user;
        $user = User::with('member')->findOrFail($Id);
        if ($request->foto_ktp == "undefined" && is_null($user->member->foto_ktp)) {
            $request['foto_ktp'] = null;
        }

        // if ($request->pas_foto == "undefined") {
        //     $request['pas_foto'] = null;
        // }
        // if (is_null($request->pas_foto) && is_null($user->member->pas_foto3x4)) {
        //     $validator = Validator::make($request->only('pas_foto'), array(
        //         'pas_foto' => ["required", "mimes:jpg,png,jpeg", 'max:7000']
        //     ));
        //     if ($validator->fails()) {
        //         return response()->json([
        //             'status'    => "fail",
        //             'messages' => $validator->errors()->first(),
        //         ], 422);
        //     }
        // }

        if (is_null($request->foto_ktp) && is_null($user->member->foto_ktp)) {
            $validator = Validator::make($request->only('foto_ktp'), array(
                'foto_ktp' => ["required", "mimes:jpg,png,jpeg", 'max:7000']
            ));
            if ($validator->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => $validator->errors()->first(),
                ], 422);
            }
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
            'status_kepegawaian' => "required",
            // 'posisi_pelaku_pengadaan' => "required",
            'jenis_jabatan' => "required",
            'nama_jabatan' => "required",
            'golongan_terakhir' => "required",
            'tempat_kerja' => "required",
            'pemerintah_instansi' => "required",
            'alamat_lengkap_kantor' => "required",
            'kantor_provinsi' => "required",
            'kantor_kota' => "required",
            'kantor_kecamatan' => "required",
            'kantor_kelurahan' => "required"
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        if(\Auth::check() && \Auth::user()->getRoleNames()[0] != 'admin'){
            $_email = \Auth::user()->email;
        }else{
            $_email = $request->email;
        }
        $userEmail = User::where('email', $_email)->where('id', '!=', $Id)->first();
        if($userEmail){
            return response()->json([
                'status'    => "fail",
                'messages' => "Email sudah digunakan",
            ], 422);
        }

        if ($request->nip != 0) {
            $userNip = User::where([
                ['nip', $request->nip],
                ['id', '!=', $Id]
            ])->first();
            if($userNip){
                return response()->json([
                    'status'    => "fail",
                    'messages' => "Nip sudah digunakan",
                ], 422);
            }
        }

        $userNik = User::where('nik', $request->nik)->where('id', '!=', $Id)->first();
        if($userNik){
            return response()->json([
                'status'    => "fail",
                'messages' => "Nik sudah digunakan",
            ], 422);
        }

        $usernohp = Member::where('no_hp', $request->no_hp)->where('user_id', '!=', $Id)->first();
        //ini $Id nya masih ngeget dari table user
        if($usernohp){
            return response()->json([
                'status'    => "fail",
                'messages' => "No HP sudah digunakan",
            ], 422);
        }
        if ($request->status_kepegawaian == 'BUMN/BUMD') {
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

        if ($request->status_kepegawaian == 'Lainnya') {
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
        $request['nama_untuk_sertifikat'] = $request->nama_tanpa_gelar;
        
        $npas_foto3x4 = $user->member->foto_profile;
        $nfoto_ktp = $user->member->foto_ktp;
        $nfile_sk_pengangkatan_asn = null;
        if ($request->hasFile('pas_foto')){
            $npas_foto3x4 = \Helper::storeFile('poto_profile', $request->pas_foto);
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
                'nip'=> $request->nip,
                'nik'=> $request->nik,
                'name' => $request->nama_tanpa_gelar,
                'email' => $_email,
                'password' => $request->password ? \Hash::make($request->password) : $user->password,
                'newuser_has_updated_data' => 1,
                'deskripsi_diri' => $request->deskripsi_diri,
                'updated_at' => now()
            ]);
            $user->member->update([
                'nama_lengkap_gelar'=> $request->nama_dengan_gelar,
                'nama_untuk_sertifikat'=> $request->nama_untuk_sertifikat,
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
                'foto_profile' => $npas_foto3x4,
                'foto_ktp' => $nfoto_ktp,
                'file_sk_pengangkatan_asn' => $nfile_sk_pengangkatan_asn,
                'updated_at' => now()
            ]);
            $user->member->memberKantor->update([
                // 'kategori_pekerjaan_id' => $request->kategori_pekerjaan,
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
                'updated_at' => now()
            ]);
            $sertif = new SertifikatKamuController();
            $path = public_path('uploaded_files/poto_profile/'.$user->member->foto_profile);
            if($user->member->foto_profile){
                if (file_exists($path)) {
                    $img = file_get_contents($path);
                    $base64 = base64_encode($img);
                }
                $datapost = [
                    'email'=> $_email,
                    'nama' => $user->member->nama_untuk_sertifikat,
                    'hp' => $user->member->no_hp,
                    'instansi' => $request->tempat_kerja,
                    'nik' => $user->nik,
                    'tempat_lahir' => $user->member->tempat_lahir,
                    'tgl_lahir' => $user->member->tgl_lahir,
                    'instansi' => $request->tempat_kerja,
                    'foto_diri' => $base64
                ];
                $endpoint = env('API_SSERTIFIKAT').'Membership/updateMember';
                $list_sertif = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
            }            
            DB::commit();
        }catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            die;
        }
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil update profile",
            'data' => $user
        ], 200);
    }

    public function updateFotoProfile(Request $request){
        if(\Auth::check()){
            $Id = \Auth::user()->id;
        }else{
            $u = User::where('email', $request->email)->first();
            $Id = $u->id;
        }
        
        $user = User::findOrFail($Id);
        if ($request->foto_profile == "undefined") {
            $request['foto_profile'] = null;
        }

        $validator = Validator::make($request->only('foto_profile'), array(
            'foto_profile' => ["required", "mimes:jpg,png,jpeg", 'max:7000']
        ));
        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        if ($request->hasFile('foto_profile')){
            $nfoto_profile = \Helper::storeFile('poto_profile', $request->foto_profile);
        }
        $user->member->update([
            'foto_profile' => $nfoto_profile
        ]);
        $_user = User::where('id', $Id)->with(['member.alamatProvinsi', 'member.alamatKota', 'member.alamatKecamatan', 'member.alamatKelurahan', 'member.memberKantor'])->first();
        return response()->json([
            'data' => $_user,
            'status'    => "ok",
            'messages' => "Berhasil update foto profile"
        ], 200);
    }

    public function storeSosialMedia(Request $request){
        $validator = Validator::make($request->all(), array(
            'sosial_media' => "required",
            'username' => "required|max:255",
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $_sosmed = SosialMedia::findOrFail($request->sosial_media);
        UserSosialMedia::create([
            'user_id' => $request->user_id,
            'sosial_media' => $_sosmed->nama,
            'username' => $request->username
        ]);
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil menambahkan sosial media"
        ], 200);
    }

    public function deleteSosialMedia(Request $request){
        if (\Auth::user()->getRoleNames()[0] == "admin") {
            UserSosialMedia::where([
                ['user_id', $request->user_id],
                ['id', $request->id]
            ])->delete();
        }else{
            //member hanya bisa menghapus sosial media mereka saja
            UserSosialMedia::where([
                ['user_id', \Auth::user()->id],
                ['id', $request->id]
            ])->delete();
        }
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil menghapus sosial media"
        ], 200);
    }

    public function storeSertifikat(Request $request){
        if (count($request->no_sertifikat_tambahan) > 0) {
            for ($i=0; $i < count($request->no_sertifikat_tambahan) ; $i++) {
                MemberSertifikatLainnya::create([
                    'member_id' => \Auth::user()->member->id,
                    'no' => $request->no_sertifikat_tambahan[$i],
                    'nama' => $request->nama_sertifikat_tambahan[$i],
                    'tahun' => $request->tahun_sertifikat_tambahan[$i]
                ]);
            }
        }                
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil menambahkan sertifikat lain"
        ], 200);
    }

    public function deleteSertifikat(Request $request){
        MemberSertifikatLainnya::where([
            ['member_id', \Auth::user()->member->id],
            ['id', $request->id]
        ])->delete();
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil menghapus sertifikat"
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
            // dd($event);
            $data['detail_event'] = $event;
            $data['member'] = $member;
            if ($event['status'] == 0) {
                return view('response.event.get_event')->with($data);
            }else if($event['status'] == 1){
                return view('response.event.get_event_status')->with($data);
            }else if($event['status'] == 2){
                return view('response.event.get_event_lunas')->with($data);
            }
        }else{
            $datapost = ['slug' => $slug, 'email' => null];
            $data['member']['ref'] = null;
            $data['detail_event'] = $this->detailEvent($datapost);
            return view('response.event.get_event')->with($data);
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

    public function download_kta(Request $request){
        if($request->id_user){
            $users = User::findOrFail($request->id_user);
        }else{
            $users = \Auth::user();
        }        

        $pdf = PDF::loadView('member.profile.kta', compact('users'));

        // return $pdf->stream();
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=Kta_{$users->name}.pdf",
        ];
        return \Response::make($pdf->output())->withHeaders($headers);
        //return $pdf->download('Kta_'.$users->name.'.pdf');
        //return $pdf->download('Kta_'.$users->name.'.pdf');
    }
}
