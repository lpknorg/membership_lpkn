<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Validator};
use App\Models\User;
use App\Models\Artikel\Artikel;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){    
        $validator = Validator::make($request->all(), array(
            'email' => "required",
            'password' => "required"
        ));

        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return response()->json([
                'status'    => "fail",
                'messages' => "User tidak terdaftar.",
            ], 422);
        }
        // if($user->email != 'wdinda375@gmail.com' && is_null($user->email_verified_at) && $user->email != 'admin@mail.com'){
        //      return response()->json([
        //          'status'    => "fail",
        //          'messages' => "User belum melakukan verifikasi email",
        //      ], 422);
        //  }
        // $cek = Hash::check($request->password, $user->password);
        // if ($cek && $user->roles->pluck('name')[0] == 'member inactive') {
        //     return response()->json([
        //         'status'    => "fail",
        //         'messages' => "Akun anda sudah tidak aktif, silakan hubungi admin",
        //     ], 422);
        // }


        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))){
            if ($request->slug_log) {
                session(['key_slug' => $request->slug_log]);
                $redirect = '/';
            }elseif($request->slug_artikel){
                $artikel = Artikel::where('slug', $request->slug_artikel)->first();
                if (is_null($artikel)) {
                    $redirect = '/';
                }
                $uname = \Helper::getUname($artikel->user);
                $redirect = "/p/{$uname}/$artikel->slug";
            }else{
                if (\Auth::user()->getRoleNames()[0] == 'admin') {
                    $redirect = '/dashboard2';
                }else{
                    $redirect = '/member_profile';
                }
            }
            $_user = User::where('email', $request->email)->with(['member.alamatProvinsi', 'member.alamatKota', 'member.alamatKecamatan', 'member.alamatKelurahan', 'member.memberKantor'])->first();
            return response()->json([
                'data' => $_user,
                'status'    => "ok",
                'messages' => "Sukses login",
                'redirect_to' => $redirect
            ], 200);
        }else{
            return response()->json([
                'status'    => "fail",
                'messages' => "Email dan password tidak cocok",
            ], 422);
        }   
    }
}
