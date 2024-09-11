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
        $endpoint = env('API_EVENT').'member/event/my_event';
        $my_event = \Helper::getRespApiWithParam($endpoint, 'post', $datapost);

        $detailevent = [];
        foreach($my_event['event'] as $myevent){
            $datapost2 = array('slug' => $myevent['slug'], 'email' => $email );
            $event = \Helper::getRespApiWithParam(env('API_EVENT').'member/event/event_detail', 'post', $datapost2);
            $datevoucher = $event['eventregis']['create_date'];
            $dv = $this->expld($datevoucher);
            // print_r(\Helper::changeFormatDate($event['event']['tgl_start']).' s/d '.\Helper::changeFormatDate($event['event']['tgl_end']).'====');
            // if(date("Y") == $dv[0]){
            //     $detailevent[] = array(
            //         'judul' => $event['event']['judul'],
            //         'kdvcr' =>$event['eventregis']['kode_vocher'],                  
            //         'create_date' => $datevoucher,                  
            //     );
            // }else{
            //     $detailevent = [];
            // }
            $detailevent[] = array(
                'judul' => $event['event']['judul'],
                'kdvcr' =>$event['eventregis']['kode_vocher'],                  
                'create_date' => $datevoucher, 
                'waktu_event' => \Helper::changeFormatDate($event['event']['tgl_start']).' s/d '.\Helper::changeFormatDate($event['event']['tgl_end'])
            );
        }
        return view('member.profile.voucher', compact('detailevent'));
    }

    public function index2()
    {
        return view('member.profile.voucher2');
    }

    function expld($date){
        $date = str_replace("/", "-", $date);
        $date = explode("-",$date);
        return $date;
    }
}
