<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LupaPasswordController extends Controller
{
    public function sendLink(Request $request){
        if (is_null(env('MAIL_USERNAME'))) {
            return response()->json([
                'status'    => "fail",
                'messages' => "ENV untuk email belum dikonfigurasi.",
            ], 422);
        }
        $validator = Validator::make($request->all(), array(
            'email' => "required"
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
                'messages' => "Email tidak ditemukan.",
            ], 422);
        }

        $user->token_reset_password = Str::uuid();
        $user->exp_token_reset_password = date('Y-m-d H:i:s', strtotime('+24 hours'));
        $user->save();

        $this->customSendEmailResetPassword($user);

        return response()->json([
            'status'    => "ok",
            'messages' => "Silakan check kembali email anda untuk reset password dengan email ".$request->email
        ], 200);           
    }

    public function customSendEmailResetPassword($user){
        \Mail::send('auth.passwords.reset_password_email', ['data' => $user], function($message) use($user){
            
            $message->to($user->email);
            $message->subject('Reset Password Notifikasi Membership LPKN');
        });
    }

    public function showForm($token){
        $user = User::where('token_reset_password', $token)->first();
        if ($user) {
            $now = Carbon::now();
            $exp_token = Carbon::parse($user->exp_token_reset_password);
            if ($now->lte($exp_token)) {
                return view('auth.passwords.reset', compact('user'));
            }
            return redirect('login')->with('exception_resetp', 'Url Link sudah tidak berlaku, Silahkan coba kembali reset password');
        }
        return redirect('login')->with('exception_resetp', 'Url Link reset password tidak valid');
    }

    public function updatePassword(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, array(
            'password' => [
                'required',
                'string'
            ],
            'password_konfirmasi' => [
                'required',
                'same:password'
            ]
        ));
        if ($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $user = User::where('token_reset_password', $request->user_id)->first();
        $user->password = \Hash::make($request->password);
        $user->save();
        return response()->json([
            'status'    => "ok",
            'messages' => "Reset password berhasil",
        ], 200);
    }
}