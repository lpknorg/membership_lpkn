<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin\{Provinsi, Instansi};
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.user.index', compact('users'));
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
            'name' => ['required',  'max:255'],
            'email' => ['required',  'max:255'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        User::create([
            'name'       => $request->name,
            'email'       => $request->email,
            'password'       => Hash::make($request->password),
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah User"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $provinsi = Provinsi::select('id', 'nama')->orderBy('nama')->get();
        $instansi = Instansi::orderBy('nama')->get();
        return view('admin.user.response_data', compact('user', 'provinsi', 'instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => ['required', 'max:255'],
            'email'       => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }
        $us = User::findOrFail($id);
        $us->update([
            'name'      => $request->name,
            'email'      => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $us->password,
            'is_confirm' => $request->verifikasi_akun == 1 ? 1 : 0
        ]);
        // return $request->all();

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update user"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $us = User::findOrFail($id);
        if ($us->member->memberKantor()->exists()) {
            $us->member->memberKantor()->delete();
        }
        if ($us->member()->exists()) {
            $us->member->delete();
        }
        $us->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus user"
        ], 200);
    }

    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_user', function($row){
                    $s = '';
                    if ($row->is_confirm) {
                        $s .= '<span class="badge badge-primary">Sudah Verifikasi</span>';
                    }else{
                        $s .= '<span class="badge badge-warning">Menunggu Verifikasi</span>';
                    }
                    return $s;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('admin.user.import_biodata', $row->id) . '" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Download Biodata"><i class="fa fa-download"></i></a>';
                    $actionBtn .= '<a href="' . route('admin.user.show', $row->id) . '" id="btnShow" class="btn-sm btn btn-info  mr-1 mb-2 mb-lg-2" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                    $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="' . route('admin.user.show', $row->id) . '" class="btn-sm btn btn-warning mx-1 ml-4 ml-md-0 mb-2"><i class="fa fa-edit"></i></a>';
                    $actionBtn .= '<button type="button" class="btn-sm btn btn-danger mb-2 mb-lg-2" id="btnHapus" data-id=' . $row->id . ' action="' . route('admin.user.destroy', $row->id) . '"><i class="fa fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status_user'])
                ->make(true);
        }
    }

    public function profile()
    {
        $id = \Auth::user()->id;
        $users = User::findOrFail($id);
        return view('admin.user.profile', ['users' => $users]);
    }
    public function importBiodata($id){
        $data = User::findOrFail($id);
        $pdf = \PDF::loadView('admin.user.pdf_biodata', compact('data'));
        return $pdf->download('Biodata '.$data->name.'.pdf');
        // return view('admin.user.pdf_biodata', compact('data'));
    }
}
