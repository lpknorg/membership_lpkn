<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Member\ProfileController;

class WelcomeController extends Controller
{
    public function welcome($page = 1)
    {
        $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        return view('Frontend/index', compact('event'));
    }
}
