<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, UserEvent};
use App\Models\Admin\{Member, MemberKantor, Provinsi, Kota};

class FormPesertaController extends Controller
{
    public function index($id){
        return view('form_peserta.index');
    }
    public function create($id_events, Request $request)
    {
        if (!session()->has('api_detail_event'.$id_events)) {
            $endpoint = env('API_EVENT').'member/event/detailevent_by_id?id_event='.$id_events;
            $list_api = \Helper::getRespApiWithParam($endpoint, 'get');        
            session(['api_detail_event'.$id_events => $list_api]);
        }
        $list_event = session('api_detail_event'.$id_events);
        $provinsi = Provinsi::select('id', 'nama')->orderBy('nama')->get();
        if ($request->ajax()) {            
            $user = User::with('member.memberKantor')->where('email', $request->email)->first();
            if ($user) {
                $selKota = Kota::where('id_provinsi', $user->member->memberKantor->kantor_prov_id)->get();
                return view('form_peserta.resp_get_memberby_email', compact('user', 'list_event', 'provinsi', 'selKota'));
            }else{
                return view('form_peserta.resp_get_member_not_email', compact('user', 'list_event', 'provinsi'));
            }
        }        
        return view('form_peserta.create', compact('id_events', 'list_event'));
    }

    public function store(Request $request)
    {        
        $checkUser = User::where('email', $request->email)->first();
        $foto_ktp = null;
        $pas_foto3x4 = null;
        $sk_pengangkatan_asn = null;
        if ($checkUser) {
            $foto_ktp = $checkUser->member->foto_ktp;
            $pas_foto3x4 = $checkUser->member->foto_profile;
            $sk_pengangkatan_asn = $checkUser->member->file_sk_pengangkatan_asn;
        }
        // ini kalo ada
        if ($checkUser) {
            if($checkUser->member->memberKantor->status_kepegawaian == 'POLRI' || substr($checkUser->member->memberKantor->status_kepegawaian, 0, 3) == 'TNI'){
                $validator = Validator::make($request->all(), [
                    'nrp' => 'required|string'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status'   => "fail",
                        'messages' => $validator->errors()->first(),
                    ], 422);
                }
            }
            if ($request->jenis_pelatihan == 'lkpp') {
                if (is_null($checkUser->member->foto_profile)) {
                    $validator = Validator::make($request->all(), [
                        'pas_foto' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status'   => "fail",
                            'messages' => $validator->errors()->first(),
                        ], 422);
                    }
                }
                if (is_null($checkUser->member->foto_ktp)) {
                    $validator = Validator::make($request->all(), [
                        'foto_ktp' => 'required|mimes:jpeg,png,jpg',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status'   => "fail",
                            'messages' => $validator->errors()->first(),
                        ], 422);
                    }
                }     
                if (is_null($checkUser->member->file_sk_pengangkatan_asn) || $request->status_kepegawaian == 'PNS') {
                    $validator = Validator::make($request->all(), [
                        'sk_pengangkatan_asn' => 'required|file|mimes:pdf,jpeg,png,jpg'
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status'   => "fail",
                            'messages' => $validator->errors()->first(),
                        ], 422);
                    }
                }                
            }else{
                if (is_null($checkUser->member->foto_profile)) {
                    $validator = Validator::make($request->all(), [
                        'pas_foto' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'status'   => "fail",
                            'messages' => $validator->errors()->first(),
                        ], 422);
                    }
                }
            }         
        }else{
            if ($request->status_kepegawaian == 'PNS') {
                $validator = Validator::make($request->all(), [
                    'sk_pengangkatan_asn' => 'required|mimes:pdf,jpeg,png,jpg'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status'   => "fail",
                        'messages' => $validator->errors()->first(),
                    ], 422);
                }
            }
            if ($request->jenis_pelatihan == 'lkpp') {
                $validator = Validator::make($request->all(), [
                    'pas_foto' => 'required|mimes:jpeg,png,jpg',
                    'foto_ktp' => 'required|mimes:jpeg,png,jpg'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status'   => "fail",
                        'messages' => $validator->errors()->first(),
                    ], 422);
                }
            }else{
                $validator = Validator::make($request->all(), [
                    'pas_foto' => 'required|mimes:jpeg,png,jpg'
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status'   => "fail",
                        'messages' => $validator->errors()->first(),
                    ], 422);
                }
            }
        }
        
        $id_event = $request->id_event;
        if ($request->status_kepegawaian == 'PNS') {
            $validator = Validator::make($request->all(), [
                'nip' => 'required|string',                
                'nama_jabatan' => 'required|string', 
                'golongan_terakhir' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => "fail",
                    'messages' => $validator->errors()->first(),
                ], 422);
            }
        }
        // ini kalau offline
        if ($request->jenis_kelas == '1') {
            $validator = Validator::make($request->all(), [
                // user
                'nama_tanpa_gelar' => 'required|string',
                'nama_dengan_gelar' => 'required|string',
                'email' => 'required|email',
                'no_hp' => 'required|string',
                'jenis_kelamin' => 'required|string', 
                'tempat_lahir' => 'required|string',
                'tanggal_lahir' => 'required|date', 
                'pendidikan_terakhir' => 'required|string',
                'nama_pendidikan_terakhir' => 'required|string',
                'nik' => 'required|string',
                'status_kepegawaian' => 'required|string',
                'nama_instansi' => 'required|string',
                'provinsi' => 'required|string',
                'kota' => 'required|string',
                'unit_organisasi' => 'required|string',
                'alamat_kantor' => 'required|string',
                'kode_pos' => 'required|string',
                // 'posisi_pengadaan' => 'required|string',
                // 'jenis_jabatan' => 'required|string',                       
                // 'konfirmasi_paket' => 'required|string'
            ]);
        }else{
            // ini kalau online
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'nama_tanpa_gelar' => 'required|string',
                'nama_dengan_gelar' => 'required|string',
                'nik' => 'required|string',
                'tempat_lahir' => 'required|string',
                'tanggal_lahir' => 'required|date', 
                'nama_instansi' => 'required|string',
                'provinsi' => 'required|string',
                'kota' => 'required|string'
            ]);
        }
        
        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = \Helper::storeFile('foto_ktp', $request->foto_ktp);
        }
        if ($request->hasFile('pas_foto')) {
            $pas_foto3x4 = \Helper::storeFile('poto_profile', $request->pas_foto);
        }
        if ($request->hasFile('sk_pengangkatan_asn')) {
            $sk_pengangkatan_asn = \Helper::storeFile('file_sk_pengangkatan_asn', $request->sk_pengangkatan_asn);
        }
        $alamat_lengkap = $request->alamat_kantor;
        $_alias = $request->rd_namasertif;
        $namaSertif = $request->$_alias;        

        \DB::beginTransaction();
        try {
            if ($checkUser) {
                $checkUser->update([
                    'name' => $request->nama_tanpa_gelar,
                    'nik' => $request->nik,
                    'nip' => $request->nip,
                    'nrp' => $request->nrp,
                    'email' => $request->email,
                    'email_verified_at' => now()
                ]);
                $checkUser->syncRoles(['member']);
                $request['user_id'] = $checkUser->id;

                $checkUser->member->update([
                    'no_hp'=>$request->no_hp,
                    'nama_lengkap_gelar' => $request->nama_dengan_gelar,
                    'pendidikan_terakhir'=>$request->pendidikan_terakhir,
                    'nama_pendidikan_terakhir'=>$request->nama_pendidikan_terakhir,
                    'nama_untuk_sertifikat'=>$namaSertif,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'alamat_lengkap'=>$alamat_lengkap,
                    'prov_id'=>$request->provinsi,
                    'kota_id'=>$request->kota,
                    'foto_profile'=>$pas_foto3x4,
                    'pas_foto3x4'=>$pas_foto3x4,
                    'foto_ktp'=>$foto_ktp,
                    'file_sk_pengangkatan_asn'=>$sk_pengangkatan_asn,
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'tgl_lahir' => \Helper::changeFormatDate($request->tanggal_lahir, 'Y-m-d'),
                    'user_id' => $checkUser->id
                ]);

                $checkUser->member->memberKantor->update([
                    'member_id' => $checkUser->member->id,
                    'nama_instansi' => $request->nama_instansi,
                    'kode_pos'=>$request->kode_pos,
                    'status_kepegawaian' => $request->status_kepegawaian,
                    'alamat_kantor_lengkap' => $request->alamat_kantor,
                    'kantor_prov_id'=>$request->provinsi,
                    'kantor_kota_id'=>$request->kota,
                    'unit_organisasi' => $request->unit_organisasi,
                    'posisi_pelaku_pengadaan' => $request->posisi_pengadaan ? $request->posisi_pengadaan : $checkUser->member->memberKantor->posisi_pengadaan,
                    'posisi_pelaku_pengadaan' => $request->jenis_jabatan ? $request->jenis_jabatan : $checkUser->member->memberKantor->jenis_jabatan,
                    'nama_jabatan' => $request->nama_jabatan,
                    'golongan_terakhir' => $request->golongan_terakhir ? $request->golongan_terakhir : $checkUser->member->memberKantor->golongan_terakhir,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }else{
                $user = User::create([
                    'name' => $request->nama_tanpa_gelar,
                    'nik' => $request->nik,
                    'nip' => $request->nip,
                    'nrp' => $request->nrp,
                    'email' => $request->email,
                    'password' => \Hash::make('lpkn1234'),
                    'email_verified_at' => now()
                ]);
                $user->syncRoles(['member']);
                $request['user_id'] = $user->id;
                $member = Member::create([
                    'no_hp'=>$request->no_hp,
                    'nama_lengkap_gelar' => $request->nama_dengan_gelar,
                    'pendidikan_terakhir'=>$request->pendidikan_terakhir,
                    'nama_pendidikan_terakhir'=>$request->nama_pendidikan_terakhir,
                    'nama_untuk_sertifikat'=>$namaSertif,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'alamat_lengkap'=>$alamat_lengkap,
                    'foto_profile'=>$pas_foto3x4,
                    'pas_foto3x4'=>$pas_foto3x4,
                    'foto_ktp'=>$foto_ktp,
                    'file_sk_pengangkatan_asn'=>$sk_pengangkatan_asn,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'tgl_lahir' => \Helper::changeFormatDate($request->tanggal_lahir, 'Y-m-d'),
                    'user_id' => $user->id
                ]);

                MemberKantor::create([
                    'member_id' => $member->id,
                    'nama_instansi' => $request->nama_instansi,
                    'status_kepegawaian' => $request->status_kepegawaian,
                    'alamat_kantor_lengkap' => $request->alamat_kantor,
                    'kantor_prov_id'=>$request->provinsi,
                    'kantor_kota_id'=>$request->kota,
                    'kode_pos'=>$request->kode_pos,
                    'unit_organisasi' => $request->unit_organisasi,
                    'posisi_pelaku_pengadaan' => $request->posisi_pengadaan,
                    'jenis_jabatan' => $request->jenis_jabatan,
                    'nama_jabatan' => $request->nama_jabatan,
                    'golongan_terakhir' => $request->golongan_terakhir,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            UserEvent::updateOrCreate(
                ['user_id' => $request->user_id, 'event_id' => $request->id_event],
                [
                    'updated_at' => now(),
                    'paket_kontribusi' => $request->paket_kontribusi
                ]
            );

            //update member dan store sertifikat
            $selKota = Kota::select('id', 'kota', 'kabupaten')->where('id', $request->kota)->first();
            $contKota = ($selKota->kabupaten == 0 ? 'Kota ' : 'Kabupaten ').$selKota->kota;
            $datapost = [
                'id_event' => $request->id_event,
                'email' => $request->email,
                'nama_sertif' => $namaSertif,
                'hp' => $request->no_hp,
                'instansi' => $request->nama_instansi,
                'nama_pemerintahan' => $contKota,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => \Helper::changeFormatDate($request->tanggal_lahir, 'Y-m-d'),
                'foto_diri' => $request->hasFile('pas_foto') ? \Helper::imageToBase64('poto_profile/'.$pas_foto3x4, 'local') : null,
                'nik' => $request->nik
            ];         
            $endpointsertif = env('API_SSERTIFIKAT').'membership/storeDatFromMembership';
            $eventData = \Helper::getRespApiWithParam($endpointsertif, 'POST', $datapost);
            // var_dump($eventData);die;   
            if ($eventData && $eventData['status'] == 'error') {
                return response()->json([
                    'status'   => "fail",
                    'messages' => $eventData['message'],
                ], 422);
            }

            // dapatkan list sertif                     
            $endpoint = env('API_SSERTIFIKAT').'member/list_sertif';
            $list_sertif = \Helper::getRespApiWithParam($endpoint, 'post', [
                'email'     => $request->email,
                'id_event'  => $request->id_event
            ]);
            \DB::commit();
            return response()->json([
                'status'   => 'ok',
                'messages' => "Data berhasil disimpan",
                'data_sertif' => $list_sertif
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'   => 'fail',
                'messages' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}