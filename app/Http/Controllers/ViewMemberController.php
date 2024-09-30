<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{User, UserEvent, HistoryKelasDiklatOnline};
use App\Exports\ExportDataFormByEvent;

class ViewMemberController extends Controller
{
    public function downloadZip($tipe, $id_event){
        $users = UserEvent::where('event_id', $id_event)->get();
        $filePaths = [];
        foreach($users as $u){ 
            $_file = $u->userDetail->member->$tipe;      
            if (substr($u->userDetail->member->$tipe, 0, 13) == 'https://drive') {
                $nama = \Helper::downloadImageFromGoogleDrive($_file, $tipe);
                if ($nama) {
                    $u->userDetail->member->update([
                        $tipe => $nama
                    ]);
                }else{
                    return 'ada link google yang masih private';
                }
                $_file = $u->userDetail->member->$tipe;
            }       
            if ($_file) {
                $_ext = pathinfo($_file);
                $cekk2 = explode(".", $_file);
                $_ext = ".".$_ext['extension'];                
                if (count($cekk2) > 1) {
                    $filePaths[public_path("uploaded_files/{$tipe}/$_file")] = $u->userDetail->name.$_ext;
                } 
            }

        }
        return \Helper::downloadZip($filePaths, $tipe);
    }

    public function viewByEvent($id_event){
        if (!session()->has('kelas_diklatonline')) {
            $endpoint = env('API_DIKLATONLINE').'Membership/listKelas';
            $list_api = \Helper::getRespApiWithParam($endpoint, 'get');        
            session(['kelas_diklatonline' => $list_api]);
        }
        if (!session()->has('api_detail_event'.$id_event)) {
            $endpoint = env('API_EVENT').'member/event/detailevent_by_id?id_event='.$id_event;
            $list_api = \Helper::getRespApiWithParam($endpoint, 'get');        
            session(['api_detail_event'.$id_event => $list_api]);
        }        
        $list_event = session('api_detail_event'.$id_event);
        $list_kelasdo = session('kelas_diklatonline');
        $users = UserEvent::where([
            ['event_id', $id_event],
            ['is_deleted', 0]
        ])->orderBy('id', 'desc')->get();
        $users_deleted = UserEvent::where([
            ['event_id', $id_event],
            ['is_deleted', 1]
        ])->orderBy('updated_at', 'desc')->get();
        return view('detail_member_event', compact('users', 'users_deleted', 'list_kelasdo', 'list_event',  'id_event'));
    }

    public function updateDataMember(Request $request){
        if ($request->isi_field == "Click to edit") {
            $request['isi_field'] = null;
        }
        $u = User::whereNik($request->nik)->first();
        // return $u->userEvent;
        if($u){
            // ini kalo isinya engga kosong
            $_field = $request->nama_field;
            if (!is_null($request->isi_field)) {
                // ini kalo users dan data sebelumnya tidak sama dengan data yang sekarang diupdate
                if ($request->tipe == 'user_event' && $request->isi_field != $u->userEvent->$_field) {
                    $uv = UserEvent::where('user_id', $u->id)
                    ->where('event_id', $request->id_event)
                    ->first();
                    if ($uv) {
                        $uv->update([
                            $_field => $request->isi_field
                        ]);     
                    }                                
                }
                if ($request->tipe == 'users' && $request->isi_field != $u->$_field) {                    
                    if ($request->nama_field == "password_lkpp") {
                        $u->update([
                            $_field => \Helper::passHashedEncrypt($request->isi_field)
                        ]);
                    }else{
                        $u->update([
                            $_field => $request->isi_field
                        ]);
                    }                    
                }
                if ($request->tipe == 'member' && $request->isi_field != $u->member->$_field) {
                    $u->member->update([
                        $_field => $request->isi_field
                    ]);                 
                }
                if ($request->tipe == 'member_kantor' && $request->isi_field != $u->member->memberKantor->$_field) {
                    $u->member->memberKantor->update([
                        $_field => $request->isi_field
                    ]);                 
                }
            }                        
        }        
    }

    public function deletePeserta(Request $request){
        $query = UserEvent::whereIn('id', $request->idArr);
        $queryCount = $query->count();
        if ($request->is_deleted == 1) {
            $endpointsertif = env('API_SSERTIFIKAT').'member/hapusMemberSertifikat';
            \Helper::getRespApiWithParam($endpointsertif, 'POST', [
                'email' => $request->emailArr,
                'id_event' => $request->id_event
            ]);
        }else{
            $arrPeserta = [];
            foreach($query->get() as $u){
                array_push($arrPeserta, [
                    'id_kelas_event'    => $request->id_event,
                    'nama_lengkap'      => $u->userDetail->name,
                    'no_hp'             => $u->userDetail->member->no_hp,
                    'email'             => $u->userDetail->email,
                    'instansi'          => $u->userDetail->member->memberKantor->nama_instansi,
                    'unit_organisasi'   => $u->userDetail->member->memberKantor->unit_organisasi,
                    'alamat'            => $u->userDetail->member->alamat_lengkap,
                    'nik'               => $u->userDetail->nik,
                    'tempat_lahir'      => $u->userDetail->member->tempat_lahir,
                    'tgl_lahir'         => $u->userDetail->member->tgl_lahir,
                    'status_pembayaran' => 1,                        
                    'bukti'             => 'default_restore_data.jpg'
                ]);
            }
            $endpoint = env('API_EVENT').'member/Regis_event/import_regis_event';
            $datapost = ['data_peserta'=>$arrPeserta];
            $xxx = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
        }     

        $query->update([
            'is_deleted' => $request->is_deleted,
            'updated_at' => now()
        ]);
        \Helper::storeHistoryUserEvent($request->idArr, $request->is_deleted);
        return response()->json([
            'status'   => 'ok',
            'messages' => "{$queryCount} peserta berhasil diupdate."
        ], 200);
    }

    public function storeToDiklatOnline(Request $request){
        $selUser = User::whereIn('email', $request->emailArr)->get();
        foreach($selUser as $u){
            $arrayData[] = [
                'nama'              => $u->name ?? '-',
                'instansi'          => $u->member->memberKantor->nama_instansi ?? '-',
                'email'             => $u->email,
                'no_hp'             => $u->member->no_hp ?? '-',
                'id_kelas'          => $request->id_kelas
            ];
        }
        $endpoint = env('API_DIKLATONLINE').'Membership/process_data';
        $datapost = ['data_peserta'=>$arrayData];
        $xxx = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
        if($xxx['message'] == 'success'){
            $uv = UserEvent::whereIn('id', $request->idArr)
            ->update(['idkelas_diklatonline' => $request->id_kelas]);
            foreach($request->idArr as $key => $value){
                HistoryKelasDiklatOnline::updateOrCreate(
                    ['user_event_id' => $value,'idkelas_diklatonline' => $request->id_kelas],
                    [
                        'createdBy' => \Auth::user()->id,
                        'updated_at' => now()
                    ]
                );
            }            
            return response()->json([
                'status'   => 'ok',
                'messages' => "Berhasil submit data ke Diklatonline"
            ], 200);
        }
    }

    public function updateCss(Request $request){
        $uv = UserEvent::whereIn('id', $request->idArr)
        ->when($request->tipe == "background-color", function($q2)use($request){
            $q2->update(['bg_color' => $request->color]);
        })
        ->when($request->tipe == "font-color", function($q2)use($request){
            $q2->update(['font_color' => $request->color]);
        });
    }

    public function downloadExcelByEvent($id_event){
        // $userse = UserEvent::with(['userDetail' => function($q){
        //     $q->orderBy('name', 'asc');
        // }])
        // ->where('event_id', $id_event)->get();
        $userse = UserEvent::join('users', 'user_events.user_id', '=', 'users.id')
        ->where('user_events.event_id', $id_event)
        ->where('user_events.is_deleted', 0)
        ->orderBy('users.name', 'asc')
        ->select('user_events.*') // pastikan hanya memilih kolom yang diperlukan
        ->with('userDetail')
        ->get();
        return Excel::download(new ExportDataFormByEvent($userse),"data-peserta-{$id_event}.xlsx");
    }
}
