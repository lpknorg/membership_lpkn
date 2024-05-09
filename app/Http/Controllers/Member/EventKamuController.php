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
        $list_event = $this->getRespApiWithParam($datapost, 'member/event/list_all_event');
        // dd($list_event);
        return view('member.profile.event_kamu', compact('my_event', 'list_event'));
    }

    public function getRespApiWithParam($datapost, $url, $type='get'){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').$url;
        $request = $client->$type($endpoint, [
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

    public function transferEvent(Request $request){
        $request['email_baru'] = \Auth::user()->email;

        $validator = Validator::make($request->all(), array(
            'email' => ["required"],
            'event' => ["required"],
            'judul' => ["required"],
            'tgl_end' => ["required"],
        ));
        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $datapost = [
            'email_lama'=>$request->email,
            'email_baru' => $request->email_baru,
            'judul' => $request->judul,
            'tgl_end' => $request->tgl_end,
            'id_kelas_event' => $request->event
        ];
        // return $datapost;
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT')."member/Event/checking_event";
        $request = $client->post($endpoint, [
            'form_params' => $datapost
        ]);

        $response = $request->getBody()->getContents();
        print_r($response);
        $data = json_decode($response, true);
    }

    public function storeTestimoni(Request $request){
        // return $request->all();
        $validator = Validator::make($request->all(), array(
            'testimoni' => ["required"],
            'star_rating' => ["required"]
        ));
        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $datapost = [
            'testimoni'=>$request->testimoni,
            'rating' => $request->star_rating,
            'slug' => $request->slug,
            'email' => $request->email
        ];
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT')."member/Event/add_testimoni/?testimoni={$request->testimoni}&rating={$request->star_rating}&slug={$request->slug}&email={$request->email}";
        $request = $client->get($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }
    
}
