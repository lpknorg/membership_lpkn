<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MenungguPembayaranController extends Controller
{
    public function getRespApi($endpoint){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($endpoint);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }
    public function index()
    {
        $datapost = ['email'=>\Auth::user()->email];
        $endpoint_ = env('API_EVENT').'member/event/waiting';
        $event_waiting = \Helper::getRespApiWithParam($endpoint_, 'post', $datapost);
        return view('member.profile.menunggu_pembayaran', compact('event_waiting'));
    }
}
