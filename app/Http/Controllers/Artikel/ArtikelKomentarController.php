<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel\{Artikel, ArtikelKomentar};

class ArtikelKomentarController extends Controller
{
	public function store(Request $request){
		if (is_null($request->isi_komentar)) {
			return response()->json([
				'status'   => 'fail',
				'messages' => "Komentar tidak boleh kosong.",
			], 422);
		}
		if (strlen($request->isi_komentar) <= 10) {
			return response()->json([
				'status'   => 'fail',
				'messages' => "Komentar harus lebih dari 10 karakter.",
			], 422);
		}
		$a = Artikel::where('slug', $request->slug)->first();
		if (!$a) {
			return response()->json([
				'status'   => 'fail',
				'messages' => "Ada kesalahan dalam berkomentar.",
			], 422);
		}

		ArtikelKomentar::create([
			'isi_komentar' => $request->isi_komentar,
			'artikel_id' => $a->id,
			'user_id' => 2
		]);

		return response()->json([
			'status'   => 'ok',
			'messages' => "Berhasil menambahkan komentar.",
		], 200);
	}

	public function getKomentar(Request $request){
		$b = Artikel::where('slug', $request->slug)->first();
		$data = ArtikelKomentar::where('artikel_id', $b->id)->with('user')->latest()->get();
		return $data;
		return view('page.beautyjournal.komentar', compact('data'))->render();
	}
}
