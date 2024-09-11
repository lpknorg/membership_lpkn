<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel\ArtikelKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.artikel_kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'       => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        ArtikelKategori::create([
            'nama'       => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah Kategori"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ArtikelKategori  $ArtikelKategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ArtikelKategori::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ArtikelKategori  $ArtikelKategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ArtikelKategori::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ArtikelKategori  $ArtikelKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'       => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $ArtikelKategori = ArtikelKategori::findOrFail($id);
        $ArtikelKategori->update([
            'nama'      => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update kategori"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ArtikelKategori  $ArtikelKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $ArtikelKategori = ArtikelKategori::findOrFail($id);
        $ArtikelKategori->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus kategori"
        ], 200);
    }

    public function getDatatable(Request $request){
        if ($request->ajax()) {
            $data = ArtikelKategori::orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('admin.artikel_kategori.show', $row->id).'" id="btnShow" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="'.route('admin.artikel_kategori.show', $row->id).'" class="btn-sm btn btn-warning mx-1 ml-4 ml-md-0 mb-2"><i class="fa fa-edit"></i></a>';
                $actionBtn .= '<button type="button" class="btn-sm btn btn-danger mb-2 mb-lg-2" id="btnHapus" data-id='.$row->id.' action="'.route('admin.artikel_kategori.destroy', $row->id).'"><i class="fa fa-trash"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

}
