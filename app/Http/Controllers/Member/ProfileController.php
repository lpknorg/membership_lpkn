<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
    	$new_event = $this->getRespApi('https://event.lpkn.id/api/member/event');
        $user = \Auth::user();
        return view('member.profile.index', compact('user', 'new_event'));
    }

    public function allEvent($page=null){
        $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        $event = $this->getRespApi($url);
    	return view('pages.event.index', compact('event'));
    }

    public function editProfile(){
        return view('member.profile.update_profile');
    }
}
