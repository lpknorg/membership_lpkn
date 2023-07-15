<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Kota;
use App\Models\Admin\Provinsi;

class KotaController extends Controller
{
    //
    public function index()
    {
        $provinsi = Provinsi::orderBy('nama')->get();
        return view('admin.kota.index', compact('provinsi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provinsi'=> ['required'],
            'kota'    => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        Kota::create([
            'kota'       => $request->kota,
            'id_provinsi'=> $request->provinsi,
            'kabupaten'  => $request->kabupaten_checked
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah kota"
        ], 200);
    }

    public function show($id)
    {
        $data = [
            'kota' => Kota::findOrFail($id),
            'provinsi' => Provinsi::orderBy('nama')->get()
        ];
        return $data;
    }

    public function edit($id)
    {
        return Kota::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'provinsi'=> ['required'],
            'kota'    => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $kota = Kota::findOrFail($id);
        $kota->update([
            'kota'       => $request->kota,
            'id_provinsi'=> $request->provinsi,
            'kabupaten'  => $request->kabupaten_checked
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update kota"
        ], 200);
    }

    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus kota"
        ], 200);
    }

    public function getDatatable(Request $request){
        if ($request->ajax()) {
            $data = Kota::with('provinsi')->orderBy('kota');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('provinsi', function($row){
                return $row->provinsi->nama;
            })
            ->addColumn('is_kabupaten', function($row){
                $cont = '<div class="form-check">';
                if ($row->kabupaten) {
                    $cont .= '<input type="checkbox" class="form-check-input" checked id="exampleCheck{$row->id}" disabled>';
                }else{
                    $cont .= '<input type="checkbox" class="form-check-input" id="exampleCheck{$row->id}" disabled>';
                }
                return $cont;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="'.route('admin.kota.show', $row->id).'" id="btnShow" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="'.route('admin.kota.show', $row->id).'" class="btn-sm btn btn-warning mx-1 ml-4 ml-md-0 mb-2"><i class="fa fa-edit"></i></a>';
                $actionBtn .= '<button type="button" class="btn-sm btn btn-danger mb-2 mb-lg-2" id="btnHapus" data-id='.$row->id.' action="'.route('admin.kota.destroy', $row->id).'"><i class="fa fa-trash"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'is_kabupaten'])
            ->make(true);
        }
    }
}
