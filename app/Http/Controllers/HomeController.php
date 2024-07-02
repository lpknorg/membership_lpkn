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

    public function viewImportMember(){     
    //    User::where('user_has_update_dateimport', 1)->delete();   
        $users = User::where('user_has_update_dateimport', 1)
        ->whereHas('userEvent', function($q){
            $q->where('createdBy', \Auth::user()->id);
        })
        ->select('id','name','email','nip')->orderBy('updated_at', 'desc')->get();
        $list_event = \Helper::getRespApiWithParam(env('API_EVENT').'member/event/list_all_event', 'get');
        return view('import_member_pbj', compact('users', 'list_event'));
    }

    public function importMemberDatatable(){
        $users = User::where('user_has_update_dateimport', 1)->select('name','email','nip')->orderBy('updated_at', 'desc')->get();
        return \DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('email_', function($row){
            return "<a style='color: #4f4fbd;' target='_blank' href=".route('dashboard2.detail_alumni', $row->email).">{$row->name}</a>";
        })
        ->rawColumns(['email_'])
        ->make(true);
    }

    public function importMember(Request $request){     
        try {
            $batch = \Helper::generateRandString(8);
            $file = $request->file('dok_import_member');
            $time = time();
            $filename = "{$time}_{$file->getClientOriginalName()}";
            $file->move(public_path("uploaded_files/excel_peserta"), $filename);
            Excel::import(new MemberNewImport($batch, $request->event_id), public_path("uploaded_files/excel_peserta/{$filename}"));
            $total = User::where('import_batch', $batch)->select('id')->count();
            return response()->json([
                'status'   => "oke",
                'messages' => "Berhasil import {$total} data peserta",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'   => "fail",
                'messages' => "Terjadi kesalahan : ".$e->getMessage(),
            ], 422);
        }
        // Excel::import(new MemberImport, $request->file('dok_import_member')->store('files'));
        // return back()->with(['success_import_member' => 'Berhasil import data member']);
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
