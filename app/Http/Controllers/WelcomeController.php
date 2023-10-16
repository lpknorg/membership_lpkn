<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Member\ProfileController;
use App\Models\Artikel\Artikel;

class WelcomeController extends Controller
{
    public function welcome(Request $request)
    {
        $url = 'https://lpkn.id/api/produk/'.$request->keyword;
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        $artikel = Artikel::limit(10)->whereIn('status_id', [1, 6])->latest()->get();
        return view('Frontend/index', compact('event', 'artikel'));
    }
}
