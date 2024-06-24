<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{User, UserEvent};

class ViewMemberController extends Controller
{
    public function viewByEvent($id_event){
        $users = UserEvent::where('event_id', $id_event)->get();
        return view('detail_member_event', compact('users'));
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
