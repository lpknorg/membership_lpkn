<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\{MemberImport, MemberImport2, MemberNewImport};
use App\Http\Controllers\Member\ProfileController;
use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function importMember(Request $request){
        Excel::import(new MemberNewImport, public_path('excel/format_pbj/makassar20mei.xlsx'));
        // Excel::import(new MemberNewImport, public_path('excel/format_pbj/makassar20mei.xlsx'));
        // Excel::import(new MemberNewImport, public_path('excel/format_pbj/pbjrahmi1.xlsx'));
        // Excel::import(new MemberNewImport, public_path('excel/format_pbj/pbjsoffy1.xlsx'));
        // Excel::import(new MemberNewImport, public_path('excel/format_pbj/pbjelsyin1.xlsx'));
        die;
        Excel::import(new MemberImport, $request->file('dok_import_member')->store('files'));
        // return redirect()->back();
        return back()->with(['success_import_member' => 'Berhasil import data member']);
    }

    public function importMember2(Request $request){
       echo date('d-m-Y H:i:s');
        ini_set('max_execution_time', 7000); // 10 minutes
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_LPKN_ID').'Member/member_accept';
        $request = $client->get($endpoint, [
            'form_params' => ['tgl' => date('d')],
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        //dd($data);
        foreach($data as $d){
            $user = User::updateOrCreate(
                [
                    'email' => $d['email']
                ],
                [
                    'name' => $d['nama_lengkap'],
                    'nik' => $d['nik'],
                    'nip' => $d['nip'],
                    'password' => \Hash::make($d['encrypt_pass']),
                    'email_verified_at' => now(),
                    'updated_at' => now()
                ]
            );
            $member = Member::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'no_hp' => $d['no_hp'],
                    'no_member' => $d['no_member'],
                    'pendidikan_terakhir' => $d['pendidikan_terakhir'],
                    'tgl_lahir' => $d['tgl_lahir'],
                    'profil_singkat' => $d['profil_singkat'],
                    'updated_at' => now()
                ]
            );
            $memberK = MemberKantor::updateOrCreate(
                ['member_id' => $member->id],
                [
                    'nama_jabatan' => $d['jabatan'],
                    'nama_instansi' => $d['tempat_kerja'],
                    'unit_kerja' => $d['unit_kerja'],
                    'updated_at' => now()
                ]
            );
            echo $d['id'].'<br>';
        }
        return "berhasil";
        // return back()->with(['success_import_member' => 'Berhasil import data member']);
    }

    public function downloadFile($file, $folder=null){
        if ($folder) {
            $filePath = public_path($folder.'/'.$file);
        }else{
            $filePath = public_path($file);
        }
        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404);
        }
            // Atur header response untuk men-download file
        return response()->download($filePath);
    }
}
