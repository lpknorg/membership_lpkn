<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel\{Artikel, ArtikelLike};

class ArtikelLikeController extends Controller
{
	public function store(Request $request){
        if (!\Auth::user()) {
            return response()->json([
                'status'   => 'fail',
                'messages' => "Anda belum melakukan login.",
            ], 422);
        }
		$artikel = Artikel::whereSlug($request->slug)->first();
        if (!$artikel) {
			return response()->json([
				'status'   => 'fail',
				'messages' => "Ada kesalahan dalam suka artikel.",
			], 422);
		}

        $artikelL = ArtikelLike::where([
            ['artikel_id', $artikel->id],
            ['user_id', \Auth::user()->id]
        ]);
        $cek = $artikelL->count();
        if ($cek > 0) {
            $artikelL->delete();
            $msg = "Berhasil batal menyukai artikel";
        }else{
            ArtikelLike::create([
                'artikel_id' => $artikel->id,
                'user_id'  => \Auth::user()->id
            ]);
            $msg = "Berhasil menyukai artikel";
        }
        $likeArt = ArtikelLike::where('artikel_id', $artikel->id)->count();
		return response()->json([
			'status'   => 'ok',
			'messages' => $msg,
			'count_likes' => $likeArt
		], 200);
	}
}
