<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
use DataTables;
use DB;

class MenungguPembayaranController extends Controller
{
    public function getRespApi($endpoint){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($endpoint);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
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
    

    public function index()
    {
        $email = \Auth::user()->email;
        $datapost = ['email'=>$email];
    	$event_waiting = $this->getRespApiWithParam($datapost, 'member/event/waiting');
        return view('member.profile.menunggu_pembayaran', compact('event_waiting'));
    }
    public function get_event(Request $request){
        $slug = $request->slug;
        $email = \Auth::user()->email;
        $member = DB::table('users')
            ->join('members', 'users.id', '=', 'members.user_id')
            ->where('users.email', $email)->get();

        $datapost = array('slug' => $slug, 'email' => $email );
        $detail_event = $this->getRespApiWithParam($datapost, 'member/event/event_detail');
       
        if($detail_event['status'] == 0){
            // return view('member.profile.modal.get_event', compact('detail_event','member'));
        }elseif($detail_event['status'] == 1){
            // return view('member.profile.modal.get_event_status', compact('detail_event','member')); //terdafar
        }else{
            // return view('member.profile.modal.get_event_lunas', compact('detail_event','member'));//lunas
        }

    }

    private function upload_bukti(Request $request)
    {
        echo "upload";
    }  

	    

}
