<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{User, UserEvent};

class ViewMemberController extends Controller
{
    public function downloadZip($tipe, $id_event){
        $users = UserEvent::where('event_id', $id_event)->get();
        $filePaths = [];
        foreach($users as $u){       
            $_file = $u->userDetail->member->$tipe;
            // ini karena beda path
            if($tipe == 'foto_profile'){
                $tipe = 'poto_profile';   
            }
            if ($_file) {
                $_ext = explode(".", $_file);
                if (count($_ext) > 1) {
                    $_ext = ".".$_ext[1];
                    $filePaths[public_path("uploaded_files/{$tipe}/$_file")] = $u->userDetail->name.$_ext;
                } 
            }

        }
        return \Helper::downloadZip($filePaths, $tipe);
    }
    public function viewByEvent($id_event){
        $users = UserEvent::where('event_id', $id_event)->get();
        return view('detail_member_event', compact('users', 'id_event'));
    }

    public function updateDataMember(Request $request){
        $u = User::whereNik($request->nik)->first();
        if($u){
            $u->update([
                'password_lkpp' => \Helper::passHashedEncrypt($request->password)
            ]);
            return response()->json([
                'status'   => 'ok',
                'messages' => "Berhasil update data"
            ], 200);
        }        
    }
}
