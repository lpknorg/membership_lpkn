<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    // public function index()
    // {
    //     return view('member.profile.voucher');
    // }

    public function index()
    {
        $email = \Auth::user()->email;
        $datapost = ['email'=>$email];
    	$my_event = $this->getRespApiWithParam($datapost, 'member/event/my_event');

        $detailevent = [];
        foreach($my_event['event'] as $myevent){
            $datapost2 = array('slug' => $myevent['slug'], 'email' => $email );
            $event = $this->getRespApiWithParam($datapost2, 'member/event/event_detail');
            $datevoucher = $event['eventregis']['create_date'];
            $dv = $this->expld($datevoucher);
            if(date("Y") == $dv[0]){
                $detailevent[] = array(
                    'judul' => $event['event']['judul'],
                    'kdvcr' =>$event['eventregis']['kode_vocher'],                  
                    'create_date' => $datevoucher,                  
                );
            }else{
                $detailevent = [];
            }
        }


        return view('member.profile.voucher', compact('detailevent'));
    }

    public function index2()
    {
        return view('member.profile.voucher2');
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

    function expld($date){
        $date = str_replace("/", "-", $date);
        $date = explode("-",$date);
        return $date;
    }


    


}
