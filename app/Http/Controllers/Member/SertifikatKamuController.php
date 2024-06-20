<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SertifikatKamuController extends Controller
{
    public function index()
    {
        $datapost = [
            'email'=>\Auth::user()->email
        ];
        $endpoint = env('API_SSERTIFIKAT').'member/list_sertif';
        $list_sertif = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);
        return view('member.profile.sertifikat_kamu', compact('list_sertif'));
    }
}
