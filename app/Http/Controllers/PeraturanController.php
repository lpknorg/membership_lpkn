<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Member\ProfileController;

class PeraturanController extends Controller
{
    public function allEvent($page=1, Request $request){

        if ($request->keyword) {
            $url = 'https://event.lpkn.id/api/member/event/search_event_page?page='.$page.'&keyword='.$request->keyword;
        }else{
            $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        }
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        // dd($event);
        return view('pages.event.index', compact('event'));
    }

    public function peraturan(){
        return view('pages.peraturan.index');
    }

    public function download_peraturan(Request $request){
        $param = $request->param;
        $datapost = ['param' => $param];
        $p = new ProfileController();
        $result = $p->getRespApiLpknidWithParam($datapost, 'download/json_pasal');
        $peraturans = $result['peraturans'];
        print_r($peraturans);die;
    }
}
