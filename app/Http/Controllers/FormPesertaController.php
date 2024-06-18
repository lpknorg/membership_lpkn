<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin\Member;
use App\Models\Admin\MemberKantor;

class FormPesertaController extends Controller
{
    public function create($id_events, Request $request)
    {   
        if (!session()->has('api_detail_event'.$id_events)) {
            $endpoint = env('API_EVENT').'member/event/detailevent_by_id?id_event='.$id_events;
            $list_api = \Helper::getRespApiWithParam($endpoint, 'get');        
            session(['api_detail_event'.$id_events => $list_api]);
        }
        $list_event = session('api_detail_event'.$id_events);
        dd($list_event);
        if ($request->ajax()) {            
            $user = User::with('member.memberKantor')->where('email', $request->email)->first();
            if ($user) {
                return view('form_peserta.resp_get_memberby_email', compact('user', 'list_event'));
            }else{
                return view('form_peserta.resp_get_member_not_email', compact('user', 'list_event'));
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
                if (is_null($checkUser->member->file_sk_pengangkatan_asn)) {
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
            if ($request->jenis_pelatihan == 'lkpp') {
                $validator = Validator::make($request->all(), [
                    'pas_foto' => 'required|mimes:jpeg,png,jpg',
                    'foto_ktp' => 'required|mimes:jpeg,png,jpg',
                    'sk_pengangkatan_asn' => 'required|mimes:pdf,jpeg,png,jpg'
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
        $validator = Validator::make($request->all(), [
            // user
            'nama_tanpa_gelar' => 'required|string',
            'nama_dengan_gelar' => 'required|string',
            'email' => 'required|email',
            'nip' => 'nullable|string',
            'nik' => 'required|string',
            // member
            'no_hp' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string',
            'jenis_kelamin' => 'required|string',            
            'kode_pos' => 'required|string',
            // member kantor
            'nama_instansi' => 'required|string',
            'status_kepegawaian' => 'required|string',
            'alamat_kantor' => 'required|string',
            'unit_organisasi' => 'required|string',
            'posisi_pengadaan' => 'required|string',
            'jenis_jabatan' => 'required|string',
            'nama_jabatan' => 'required|string',
            'golongan_terakhir' => 'required|string',
        ]);
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

        \DB::beginTransaction();
        try {
            if ($checkUser) {
                $checkUser->update([
                    'name' => $request->nama_tanpa_gelar,
                    'nik' => $request->nik,
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'email_verified_at' => now()
                ]);
                $checkUser->syncRoles(['member']);
                $request['user_id'] = $checkUser->id;

                $checkUser->member->update([
                    'no_hp'=>$request->no_hp,
                    'nama_lengkap_gelar' => $request->nama_dengan_gelar,
                    'pendidikan_terakhir'=>$request->pendidikan_terakhir,
                    'nama_untuk_sertifikat'=>$request->nama_tanpa_gelar,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'alamat_lengkap'=>$alamat_lengkap,
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
                    'unit_organisasi' => $request->unit_organisasi,
                    'posisi_pelaku_pengadaan' => $request->posisi_pengadaan,
                    'jenis_jabatan' => $request->jenis_jabatan,
                    'nama_jabatan' => $request->nama_jabatan,
                    'golongan_terakhir' => $request->golongan_terakhir,
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }else{
                $user = User::create([
                    'name' => $request->nama_tanpa_gelar,
                    'nik' => $request->nik,
                    'nip' => $request->nip,
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
                    'nama_untuk_sertifikat'=>$request->nama_tanpa_gelar,
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
            \DB::commit();
            return response()->json([
                'status'   => 'ok',
                'messages' => "Data berhasil disimpan"
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
