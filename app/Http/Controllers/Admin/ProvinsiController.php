<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Provinsi;

class ProvinsiController extends Controller
{
    //
    public function index()
    {
        return view('admin.provinsi.index');
    }

    public function store(Request $request)
    {
        if ($request->photo == 'undefined') {
            return response()->json([
                'status'   => "fail",
                'messages' => "Photo harus diisi"
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'nama'       => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        Provinsi::create([
            'nama'       => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah provinsi"
        ], 200);
    }

    public function show($id)
    {
        return Provinsi::findOrFail($id);
    }

    public function edit($id)
    {
        return Provinsi::findOrFail($id);
    }

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

        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update([
            'nama'      => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update provinsi"
        ], 200);
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        \Helper::deleteFile($provinsi->photo);
        $provinsi->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus provinsi"
        ], 200);
    }


    public function getDatatable(Request $request){
        if ($request->ajax()) {
            $data = Provinsi::orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('admin.provinsi.show', $row->id).'" id="btnShow" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="'.route('admin.provinsi.show', $row->id).'" class="btn-sm btn btn-warning mx-1 ml-4 ml-md-0 mb-2"><i class="fa fa-edit"></i></a>';
                $actionBtn .= '<button type="button" class="btn-sm btn btn-danger mb-2 mb-lg-2" id="btnHapus" data-id='.$row->id.' action="'.route('admin.provinsi.destroy', $row->id).'"><i class="fa fa-trash"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
