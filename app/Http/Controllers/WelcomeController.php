<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Member\ProfileController;
use App\Models\Artikel\Artikel;

class WelcomeController extends Controller
{
    public function welcome($page = 1)
    {
        $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        $artikel = Artikel::limit(10)->latest()->get();
        return view('Frontend/index', compact('event', 'artikel'));
    }
}
