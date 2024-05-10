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
        $my_event = \Helper::getRespApiWithParam(env('API_EVENT').'member/event/my_event', 'post', $datapost);
        $list_event = \Helper::getRespApiWithParam(env('API_EVENT').'member/event/list_all_event', 'get', $datapost);

        return view('member.profile.event_kamu', compact('my_event', 'list_event'));
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
