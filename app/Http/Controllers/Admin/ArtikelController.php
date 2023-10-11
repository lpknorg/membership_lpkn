<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.artikel.index');
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

        Artikel::create([
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
     * @param  \App\Models\Admin\Artikel  $Artikel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = Artikel::whereSlug($id)->first();
        if (!$artikel) {
            abort(404);
        }
        return view('admin.artikel.detail', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Artikel  $Artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Artikel::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Artikel  $Artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->status_id == 2 || $request->status_id == 5) {
            if (is_null($request->alasan_tolak)) {
                return response()->json([
                    'status'   => "fail",
                    'messages' => "Alasan tolak harus diisi",
                ], 422);
            }
        }
        $Artikel = Artikel::findOrFail($id);
        $Artikel->update([
            'status_id' => $request->status_id,
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update artikel"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Artikel  $Artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $Artikel = Artikel::findOrFail($id);
        $Artikel->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus kategori"
        ], 200);
    }

    public function getDatatable(Request $request){
        if ($request->ajax()) {
            $data = Artikel::orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('admin.artikel.show', $row->id).'" id="btnShow" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="'.route('admin.artikel.edit', $row->id).'" class="btn-sm btn btn-warning mx-1 ml-4 ml-md-0 mb-2"><i class="fa fa-edit"></i></a>';
                $actionBtn .= '<button type="button" class="btn-sm btn btn-danger mb-2 mb-lg-2" id="btnHapus" data-id='.$row->id.' action="'.route('admin.artikel.destroy', $row->id).'"><i class="fa fa-trash"></i></button>';
                return $actionBtn;
            })
            ->addColumn('deskripsi', function($row){
                return \Helper::cutString(strip_tags($row->deskripsi));
            })
            ->addColumn('status', function($row){
                if ($row->status_id == 0) {
                    $c = '<span class="badge badge-info">Pending</span>';
                }elseif ($row->status_id == 1 || $row->status_id == 6) {
                    $c = '<span class="badge badge-success">Tayang</span>';
                }elseif ($row->status_id == 2 || $row->status_id == 5) {
                    $c = '<span class="badge badge-danger">Ditolak</span>';
                }elseif ($row->status_id == 3) {
                    $c = '<span class="badge badge-info">Pengajuan Edit</span>';
                }elseif ($row->status_id == 4) {
                    $c = '<span class="badge badge-warning">Pending Edit</span>';
                }elseif ($row->status_id == 7) {
                    $c = '<span class="badge badge-warning">Pengajuan Kembali</span>';
                }
                return $c;
            })
            ->rawColumns(['action', 'deskripsi', 'status'])
            ->make(true);
        }
    }

}
