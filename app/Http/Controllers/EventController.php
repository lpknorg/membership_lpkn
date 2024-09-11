<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Member\ProfileController;

class EventController extends Controller
{
    public function allEvent($page=1, Request $request){

        if ($request->keyword) {
            $url = 'https://event.lpkn.id/api/member/event/search_event_page?page='.$page.'&keyword='.$request->keyword;
        }else{
            $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        }
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        return view('pages.event.index', compact('event'));
    }
}
