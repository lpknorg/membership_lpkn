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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_events)
    {   
        $endpoint = env('API_EVENT').'member/event/detailevent_by_id?id_event='.$id_events;
        $list_event = \Helper::getRespApiWithParam($endpoint, 'get');
        // dd($list_event);
        return view('form_peserta.create', compact('list_event'));
    }

    public function store(Request $request)
    {
        $id_event = $request->id_event;
        $request->validate([
            // user
            'nama_tanpa_gelar' => 'required|string',
            'nama_dengan_gelar' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'nip' => 'nullable|string',
            'nik' => 'required|string',

            // member
            'no_hp' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'foto_ktp' => 'required|file|mimes:jpeg,png,jpg',
            'pas_foto' => 'required|file|mimes:jpeg,png,jpg',
            'sk_pengangkatan_asn' => 'required|file|mimes:pdf,jpeg,png,jpg',
            'kode_pos' => 'required|string',
            // member kantor
            'instansi' => 'required|string',
            'status_kepegawaian' => 'required|string',
            'alamat_kantor' => 'required|string',
            'unit_organisasi' => 'required|string',
            'posisi_pengadaan' => 'required|string',
            'jenis_jabatan' => 'required|string',
            'nama_jabatan' => 'required|string',
            'golongan_terakhir' => 'required|string',
            'konfirmasi_paket' => 'required|string',          
        ]);

        $password =  \Hash::make('lpkn1234');
        $user = User::create([
            'name' => $request->nama_tanpa_gelar,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'email' => $request->email,
            // set password default untuk alumni
            'password' => \Hash::make('lpkn1234'),
            'email_verified_at' => now()
        ]);
        $user->syncRoles('member');

        $foto_ktp = null;
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = \Helper::storeFile('foto_ktp', $request->foto_ktp);
        }

        $pas_foto3x4 = null;
        if ($request->hasFile('pas_foto')) {
            $pas_foto3x4 = \Helper::storeFile('pas_foto3x4', $request->pas_foto);
        }

        $sk_pengangkatan_asn = null;
        if ($request->hasFile('sk_pengangkatan_asn')) {
            $sk_pengangkatan_asn = \Helper::storeFile('file_sk_pengangkatan_asn', $request->sk_pengangkatan_asn);
        }

        $request['user_id'] = $user->id;
        $member = Member::create([
            'no_hp'=>$request->no_hp,
            'pendidikan_terakhir'=>$request->pendidikan_terakhir,
            'nama_lengkap_gelar'=>$request->nama_lengkap_gelar,
            'nama_untuk_sertifikat'=>$request->nama_tanpa_gelar,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tgl_lahir'=>$request->tgl_lahir,
            'tempat_lahir'=>$request->tempat_lahir,
            'kode_pos'=>$request->kode_pos,
            'alamat_lengkap'=>$request->alamat_kantor,
            'foto_profile'=>$pas_foto3x4,
            'unit_kerja'=>$request->unit_kerja,
            'pas_foto3x4'=>$pas_foto3x4,
            'foto_ktp'=>$foto_ktp,
            'file_sk_pengangkatan_asn'=>$sk_pengangkatan_asn,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'tgl_lahir' => \Helper::changeFormatDate($request->tgl_lahir, 'Y-m-d'),
            'user_id' => $user->id
        ]);

        MemberKantor::create([
            'member_id' => $member->id,
            'instansi' => $request->nama_instansi,
            'status_kepegawaian' => $request->status_kepegawaian,
            'alamat_kantor_lengkap' => $request->alamat_kantor,
            'unit_organisasi' => $request->unit_organisasi,
            'posisi_pelaku_pengadaan' => $request->posisi_pengadaan,
            'jenis_jabatan' => $request->jenis_jabatan,
            'nama_jabatan' => $request->nama_jabatan,
            'golongan_terakhir' => $request->golongan_terakhir,
            'konfirmasi_paket' => $request->konfirmasi_paket,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        
        return redirect()->route('form_peserta',$id_event)->with('success', 'Data berhasil disimpan');
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
