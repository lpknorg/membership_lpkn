<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Artikel, User};

class ArtikelController extends Controller
{
    public function index()
    {
        $data = Artikel::latest()->get();
        return view('pages.artikel.index', compact('data'));
    }

    public function create()
    {
        return view('pages.artikel.create');
    }

    public function store(Request $request){
        // return $request->all();
        $covername = null;
        if ($request->hasFile('cover')) {
            $covername = \Helper::storeFile('artikel/cover', $request->cover);
        }
        $dom = new \DomDocument();
        $dom->loadHtml($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= "/uploaded_files/artikel/" . time().$item.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        Artikel::create([
            'slug' => \Str::slug($request->judul).rand(1,9999),
            'user_id' => \Auth::user()->id,
            'cover' => $covername,
            'kategori' => 'kategori '.rand(1, 9999),
            'judul' => $request->judul,
            'deskripsi' => $content
        ]);
        return response()->json([
            'status'    => "ok",
            'messages' => "Berhasil menambah artikel, mohon menunggu untuk verifikasi"
        ], 200);
    }

    public function detail($uname, $slug){
        $expl = explode('-', $uname);
        $email = $expl[0];
        $id = $expl[1];
        $user = User::where([
            ['email', 'like', $email.'%'],
            ['id', $id]
        ])->first();
        if (is_null($user)) {
            abort(404);
        }
        $artikel = Artikel::where('slug', $slug)->first();
        if (is_null($artikel)) {
            abort(404);
        }
        $artikel_terbaru = Artikel::latest()->where('slug', '!=', $slug)->limit(5)->get();
        return view('pages.artikel.detail', compact('artikel', 'artikel_terbaru'));
    }

}
