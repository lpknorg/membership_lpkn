<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventKamuController extends Controller
{
    public function index()
    {
        $email = \Auth::user()->email;
        $datapost = ['email'=>$email];
    	$my_event = $this->getRespApiWithParam($datapost, 'member/event/my_event');
        return view('member.profile.event_kamu', compact('my_event'));
    }

    public function getRespApiWithParam($datapost, $url){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').$url;
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }
    
}
