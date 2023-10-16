<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};
use Illuminate\Support\Str;
use Carbon\Carbon;

class MemberController extends Controller{
	public function daftar(Request $request){
		$validator = Validator::make($request->all(),[
			'nama_lengkap'    => 'required|string|max:255',
			'no_hp' => 'required|string|max:13',
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
			$this->sendLinkVerifRegister($request);
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
			'messages'     => "Berhasil mendaftar, silakan verifikasi email anda.",
			'data'         =>  $user
		], 200);
	}

	public function daftarLpkn(Request $request){
		$validator = Validator::make($request->all(),[
			'nama_lengkap'    => 'required|string|max:255',
			'tanggal_lahir'    => 'required|string|max:255',
			'kota'    => 'required|string|max:255',
			'domisili_lengkap'    => 'required|string|max:255',
			'pendidikan_terakhir'    => 'required|string|max:255',
			// 'instansi'    => 'required|string|max:255',
			// 'jabatan'    => 'required|string|max:255',
			// 'unit_kerja'    => 'required|string|max:255',
			'email'    => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'no_hp' => 'required|string|max:13',
			// 'profil_singkat' => 'required|string|max:1000',
			// 'tema_kegiatan' => 'required|string|max:255',
			'upload_foto' => 'required',
			// 'bintang' => 'required|string',
			// 'testimoni' => 'required|string|max:500',
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

		$userNik = User::where('nik', $request['nik'])->first();
		if($userNik && $request->nik){
			return response()->json([
				'status'    => "fail",
				'messages' => "nik sudah digunakan",
			], 422);
		}

		$usernip = User::where('nip', $request['nip'])->first();
		if($usernip && $request->nip){
			return response()->json([
				'status'    => "fail",
				'messages' => "nip sudah digunakan",
			], 422);
		}


		$request['name'] = $request->nama_lengkap;
		$request['password'] = \Hash::make($request->password);
		$request['email_verified_at'] = now();
		\DB::beginTransaction();
		try {
			$user = User::create($request->only('name', 'email', 'password', 'nik', 'nip', 'email_verified_at'));
			$user->syncRoles('member');
			$reqMember['no_hp'] = $request->no_hp;
			$reqMember['user_id'] = $user->id;
			$reqMember['no_member'] = $request->no_member;
			$reqMember['pendidikan_terakhir'] = $request->pendidikan_terakhir;
			$reqMember['nama_lengkap_gelar'] = $request->nama_lengkap;
			$reqMember['tgl_lahir'] = $request->tanggal_lahir;
			$reqMember['alamat_lengkap'] = $request->domisili_lengkap;
			$reqMember['nama_kota'] = $request->kota;
			$reqMember['foto_profile'] = null;
			$reqMember['no_member'] = $request->no_member;
			if (base64_decode($request->upload_foto)) {
				$reqMember['foto_profile'] = \Helper::storeBase64File('poto_profile', $request->upload_foto, \Helper::generateRandString());
			}
			// if ($request->hasFile('upload_foto')) {
			// 	$reqMember['foto_profile'] = \Helper::storeFile('poto_profile', $request->upload_foto);
			// }
			$reqMember['profil_singkat'] = $request->profil_singkat;


			$member = Member::create($reqMember);
			MemberKantor::create([
				'member_id' => $member->id,
				'nama_jabatan' => $request->jabatan,
				'nama_instansi' => $request->instansi,
				'unit_kerja' => $request->unit_kerja,
				'pemerintah_instansi' => $request->tempat_kerja
			]);
			// $this->sendLinkVerifRegister($request);
			$_user = User::whereId($user->id)->with('member.memberKantor')->first();
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
			'messages'     => "Berhasil mendaftar dari LPKN",
			'data'         =>  $_user
		], 200);
	}

	public function sendLinkVerifRegister(Request $request){
		if (is_null(env('MAIL_USERNAME'))) {
			return response()->json([
				'status'    => "fail",
				'messages' => "ENV untuk email belum dikonfigurasi.",
			], 422);
		}

		$user = User::where('email', $request->email)->first();

		$user->token_verif_regist = Str::uuid();
		$user->save();

		\Mail::send('auth.verif-email', ['data' => $user], function($message) use($user){

			$message->to($user->email);
			$message->subject('Verifikasi Membership LPKN');
		});

		return response()->json([
			'status'    => "ok",
			'messages' => "Silakan check kembali email anda untuk verifikasi email ".$request->email
		], 200);           
	}

	public function customSendEmailVerifRegister($user){
		
	}
	public function updateVerifyEmail($token){
		$user = User::where('token_verif_regist', $token)->first();
		if ($user) {
			$now = Carbon::now();
			$user = User::where('token_verif_regist', $token)->first();
			$user->email_verified_at = now();
			$user->save();
			return redirect('login')->with('success_verify_email', 'Berhasil melakukan verifikasi email');
		}
		return redirect('login')->with('exception_verify_password', 'Url Link verify email tidak valid');
	}

}