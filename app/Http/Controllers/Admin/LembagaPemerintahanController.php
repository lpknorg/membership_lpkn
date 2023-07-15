<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Admin\{Instansi, LembagaPemerintahan};
use Spatie\Permission\Models\Role;

class LembagaPemerintahanController extends Controller
{
    public function index()
    {
        $instansis = Instansi::where('nama', '!=', 'Perangkat Daerah')->orderBy('nama')->get();
        return view('admin.lembaga_pemerintahan.index', compact('instansis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instansi' => ['required'],
            'nama'     => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $u = LembagaPemerintahan::create([
            'instansi_id' => $request->instansi,
            'nama' => $request->nama
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah Lembaga Pemerintahan"
        ], 200);
    }

    public function show($id)
    {
        $data = [
            'lembaga' => LembagaPemerintahan::findOrFail($id),
            'instansi' => Instansi::where('nama', '!=', 'Perangkat Daerah')->orderBy('nama')->get()
        ];
        return $data;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'instansi' => ['required'],
            'nama'     => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $l = LembagaPemerintahan::findOrFail($id);
        $l->update([
            'instansi_id' => $request->instansi,
            'nama' => $request->nama
        ]);
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update Lembaga Pemerintahan"
        ], 200);
    }

    public function destroy($id)
    {
        LembagaPemerintahan::findOrFail($id)->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus Lembaga Pemerintahan"
        ], 200);
    }

    public function getDatatable(Request $request){
        if ($request->ajax()) {
            $data = LembagaPemerintahan::with('instansi')->orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_instansi', function($row){
                return $row->instansi->nama;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="' . route('admin.lembaga_pemerintahan.show', $row->id) . '" id="btnShow" class="btn-sm btn btn-info mr-1" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="' . route('admin.lembaga_pemerintahan.show', $row->id) . '" class="btn-sm btn btn-warning"><i class="fa fa-edit"></i></a>';
                $actionBtn .= '<button type="button" class="btn-sm btn btn-danger" id="btnHapus" data-id=' . $row->id . ' action="' . route('admin.lembaga_pemerintahan.destroy', $row->id) . '"><i class="fa fa-trash"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function getData(Request $req){
        $l = LembagaPemerintahan::when($req->instansi_id, function($q)use($req){
            $q->where('instansi_id', $req->instansi_id);
        })
        ->orderBy('nama')
        ->get();
        return $l;
    }
}
