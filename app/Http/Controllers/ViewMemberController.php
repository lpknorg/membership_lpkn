<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ViewMemberController extends Controller
{
    public function viewByEvent($id_event){
        $users = User::whereNotNull('nik')->limit(10)->get();
        return view('detail_member_event', compact('users'));
    }

    public function updateDataMember(Request $request){
        $u = User::whereNik($request->nik)->first();
        $u->update([
            'password_lkpp' => \Helper::passHashedEncrypt($request->password)
        ]);
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update data"
        ], 200);
    }
}
