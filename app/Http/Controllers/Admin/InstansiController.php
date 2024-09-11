<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Instansi;

class InstansiController extends Controller
{
    public function index()
    {
        return view('admin.instansi.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required',  'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        Instansi::create([
            'nama'            => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah Lembaga Pemerintah.",
        ], 200);
    }

    public function show($id)
    {
        return Instansi::findOrFail($id);
    }

    public function edit($id)
    {
        return Instansi::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required',  'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $lp = Instansi::findOrFail($id);
        $lp->update([
            'nama'            => $request->nama,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update Lembaga Pemerintahan"
        ], 200);
    }

    public function destroy($id)
    {
        Instansi::findOrFail($id)->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus lembaga Pemerintahan"
        ], 200);
    }

    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Instansi::orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('admin.instansi.show', $row->id) . '" id="btnLihat" class="btn-sm btn btn-info mr-1" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                    $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="' . route('admin.instansi.show', $row->id) . '" class="btn-sm btn btn-warning mr-1"><i class="fa fa-edit"></i></a>';
                    $actionBtn .= '<button type="button" class="btn-sm btn btn-danger" id="btnHapus" data-id=' . $row->id . ' action="' . route('admin.instansi.destroy', $row->id) . '"><i class="fa fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
