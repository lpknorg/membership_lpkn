<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SertifikatKamuController extends Controller
{
    public function index()
    {
        $email = \Auth::user()->email;
        $datapost = ['email'=>$email];
    	$list_sertif = $this->getRespApiWithParam($datapost, 'member/list_sertif');
        return view('member.profile.sertifikat_kamu', compact('list_sertif'));
    }

    public function getRespApiWithParam($datapost, $url){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_SSERTIFIKAT').$url;
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=bf473e252ab962e8117a839b7de0889046813ae2'
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

}
