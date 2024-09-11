<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Artikel\{Artikel, ArtikelLike, ArtikelKategori, ArtikelFoto, ArtikelTag};
use App\Models\User;
use DB;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $data = Artikel::latest()
        ->when($request->q, function($q)use($request){
            $q->where('judul', 'like', '%'.$request->q.'%');
        })
        ->when($request->kategori, function($q)use($request){
            $q->where('kategori', $request->kategori);
        })
        ->whereIn('status_id', [1, 6])
        ->paginate(5);
        $kategori = ArtikelKategori::orderBy('nama')->get();
        return view('pages.artikel.index', compact('data', 'kategori'));
    }

    public function delete($id){
        $art = Artikel::findOrFail($id);
        $art->delete();
        return back();        
    }

    public function indexProfile(Request $request)
    {
        $sl_user = \Request::segment(2);
        $sl_user = explode("-", $sl_user);
        $curr_user = User::where([
            ['email', 'like', "{$sl_user[0]}%"],
            ['id', $sl_user[1]]
        ])->first();
        if (!$curr_user) {
            abort(404);
        }
        $curr_login = \Auth::user();
        $data = Artikel::latest()
        ->when($request->q, function($q)use($request){
            $q->where('judul', 'like', '%'.$request->q.'%');
        })
        ->when($request->kategori, function($q)use($request){
            $q->where('kategori', $request->kategori);
        })
        ->where('user_id', $curr_user->id)
        ->when(!is_null($curr_login), function($q)use($curr_user){
            $curr_login = \Auth::user();
            if ($curr_login->id != $curr_user->id) {
                $q->whereIn('status_id', [1, 6]);
            }else if ($curr_login->id == $curr_user->id) {
                $q->where('status_id', '>=', 0);
            }
        })
        ->when(is_null($curr_login), function($q)use($curr_user){
            $q->whereIn('status_id', [1, 6]);
        })
        ->paginate(5);
        $datalike = ArtikelLike::where('user_id', $curr_user->id)->select('id')->count();
        $kategori = ArtikelKategori::orderBy('nama')->get();
        return view('pages.artikel.index_profile', compact('data', 'curr_user', 'datalike', 'kategori'));
    }

    public function edit($uname, $slug){
        if (!\Auth::check()) {
            return redirect('/');
        }
        $kategori = ArtikelKategori::orderBy('nama')->get();
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
        if ($artikel->status_id != 1 && $artikel->status_id != 2) {
            return redirect('/');
        }
        if (is_null($artikel)) {
            abort(404);
        }
        if ($artikel->user_id != \Auth::user()->id) {
            abort(403);
        }
        if($artikel->status_id != 1 && $artikel->status_id != 6){
            if (!\Auth::check()) {
                abort(403);
            }
            if($artikel->user_id != \Auth::user()->id){
                abort(404);
            }
        }
        $artikelTag = '';
        foreach($artikel->artikelTags as $t){
            $artikelTag .= $t->nama_tag.',';
        }
        // remove last comma
        $artikelTag = substr_replace($artikelTag, "", -1);
        return view('pages.artikel.edit', compact('artikel', 'kategori', 'artikelTag'));
    }

    public function create()
    {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $kategori = ArtikelKategori::orderBy('nama')->get();
        return view('pages.artikel.create', compact('kategori'));
    }

    public function store(Request $request){
        $expTags = explode(",", $request->tag);
        $request['cover'] = null;        
        $validator = Validator::make($request->only(['cover', 'kategori', 'judul', 'deskripsi', 'tag']), [
            'cover'    => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:5000'],
            'kategori'    => ['required'],
            'judul'=> ['required', 'max:255'],
            'deskripsi'=> ['required'],
            'tag'    => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        if (strlen($request->judul) < 25) {
            return response()->json([
                'status'   => 'fail',
                'messages' => "Judul Artikel harus lebih dari 25 karakter.",
            ], 422);
        }
        
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
        DB::beginTransaction();
        try {
            $art = Artikel::create([
                'slug' => \Str::slug($request->judul).rand(1,9999),
                'user_id' => \Auth::user()->id,
                'cover' => $covername,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'deskripsi' => $content
            ]);
            if ($request->hasFile('gambar_slider')){
                foreach ($request->gambar_slider as $value) {
                    ArtikelFoto::create([
                        'artikel_id' => $art->id,
                        'file'      => \Helper::storeFile('artikel/gambar_slider', $value)
                    ]);
                }
            }
            foreach ($expTags as $k => $t) {
                ArtikelTag::create([
                    'artikel_id'=> $art->id,
                    'nama_tag'  => $t
                ]);
            }
            DB::commit();
            return response()->json([
                'status'    => "ok",
                'messages' => "Berhasil menambah artikel, mohon menunggu untuk verifikasi",
                'link' => route('artikel.detail', ['uname' => \Helper::getUname(\Auth::user()), 'slug' => $art->slug])
            ], 200);   
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam input artikel",
            ],422);
        }        
    }

    public function update(Request $request){
        $expTags = explode(",", $request->tag);
        $currArtikel = Artikel::whereId($request->id)->first();
        if (!$currArtikel) {
            return response()->json([
                'status'   => "fail",
                'messages' => "Artikel tidak ditemukan",
            ], 422);
        }
        $request['cover'] = null;        
        $validator = Validator::make($request->only(['kategori', 'judul', 'deskripsi', 'tag']), [
            'kategori'    => ['required'],
            'judul'=> ['required', 'max:255'],
            'deskripsi'=> ['required'],
            'tag'    => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        if (strlen($request->judul) < 25) {
            return response()->json([
                'status'   => 'fail',
                'messages' => "Judul Artikel harus lebih dari 25 karakter.",
            ], 422);
        }
        
        $covername = $currArtikel->cover;
        if ($request->hasFile('cover')) {
            $validator = Validator::make($request->only(['cover']), [
                'cover'    => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:5000']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => "fail",
                    'messages' => $validator->errors()->first(),
                ], 422);
            }
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
        DB::beginTransaction();
        try {
            $art = $currArtikel->update([
                'cover' => $covername,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'deskripsi' => $content,
                'status_id' => 3
            ]);
            if ($request->hasFile('gambar_slider')){
                ArtikelFoto::where('artikel_id', $currArtikel->id)->delete();
                foreach ($request->gambar_slider as $value) {
                    ArtikelFoto::create([
                        'artikel_id' => $currArtikel->id,
                        'file'      => \Helper::storeFile('artikel/gambar_slider', $value)
                    ]);
                }                
            }
            foreach ($expTags as $k => $t) {
                ArtikelTag::where('artikel_id', $currArtikel->id)->delete();
                ArtikelTag::create([
                    'artikel_id'=> $currArtikel->id,
                    'nama_tag'  => $t
                ]);
            }
            DB::commit();
            return response()->json([
                'status'    => "ok",
                'messages' => "Berhasil mengubah artikel, mohon menunggu untuk verifikasi",
                'link' => route('artikel.edit', ['uname' => \Helper::getUname(\Auth::user()), 'slug' => $currArtikel->slug])
            ], 200);   
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam ubah artikel",
            ],422);
        }        
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
        if (\Auth::check()) {
            $artikel->views += 1;
            $artikel->save();   
        }
        
        if($artikel->status_id != 1 && $artikel->status_id != 6){
            if (!\Auth::check()) {
                abort(403);
            }
            if($artikel->user_id != \Auth::user()->id){
                abort(404);
            }
        }
        $artikel_terbaru = Artikel::latest()->where('slug', '!=', $slug)->whereIn('status_id', [1, 6])->limit(5)->get();
        return view('pages.artikel.detail', compact('artikel', 'artikel_terbaru'));
    }

}
