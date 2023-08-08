<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};

class MemberController extends Controller{
	public function daftar(Request $request){
		$validator = Validator::make($request->all(),[
			'nama_lengkap'    => 'required|string|max:255',
			'no_hp' => 'required|string|max:255',
			'email'    => 'required|string|max:255',
			'password' => 'required|string|max:255'
		]);

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		$userm = Member::where('no_hp', $request['no_hp'])->first();
		if($userm){
			return response()->json([
				'status'    => "fail",
				'messages' => "No handphone sudah digunakan",
			], 422);
		}

		$user = User::where('email', $request['email'])->first();
		if($user){
			return response()->json([
				'status'    => "fail",
				'messages' => "Email sudah digunakan",
			], 422);
		}


		$request['name'] = $request->nama_lengkap;
		$request['password'] = \Hash::make($request->password);
		try {
			$user = User::create($request->only('name', 'email', 'password'));
			$user->syncRoles('member');
			$request['user_id'] = $user->id;

			$member = Member::create($request->only('no_hp', 'user_id'));
			MemberKantor::create([
				'member_id' => $member->id
			]);
			\DB::commit();
		} catch (Exception $e) {
			\DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages' => "Ada kesalahan dalam proses daftar",
			], 422);
		}
		return response()->json([
			'status'       => "ok",
			'messages'     => "Berhasil mendaftar, akun anda menunggu verifikasi dari admin.",
			'data'         =>  $user
		], 200);
	}
}