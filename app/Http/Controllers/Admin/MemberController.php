<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Member;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\{Instansi, LembagaPemerintahan, KategoriTempatKerja};

class MemberController extends Controller
{
    public function index()
    {
        $instansi = Instansi::orderBy('nama')->get();
        $lembagapemerintah = LembagaPemerintahan::orderBy('nama')->get();
        $kategoritempatkerja = KategoriTempatKerja::orderBy('nama')->get();
        return view('admin.member.index', compact('instansi', 'lembagapemerintah', 'kategoritempatkerja'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_member'         => ['required'],
            'nik'               => ['required'],
            'email'             => ['required'],
            'nama_lengkap'      => ['required'],
            'no_hp'             => ['required'],
            'alamat_lengkap'    => ['required'],
            'tempat_lahir'      => ['required'],
            'tgl_lahir'         => ['required'],
            'ref'               => ['required'],
            'bank_rek_ref'      => ['required'],
            'no_rek_ref'        => ['required'],
            'an_rek_ref'        => ['required'],
            'fb'                => ['required'],
            'pp'                => ['required|image|mimes:png,jpg,jpeg,svg|max:5000'],
            'instagram'         => ['required'],
            'nama_instansi'     => ['required'],
            'lembaga_pemerintahan'  => ['required'],
            'kategori_kerja'     => ['required'],
            'expired_date'      => ['required'],
            'nip'               => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }


        $photofile = null;
        if ($request->hasFile('pp')) {
            $photofile = \Helper::storeFile('foto_profile', $request->pp);
        }
        // $photofile = \Helper::storeFile('foto_profile', $request->pp);
        $member = Member::create([
            'no_member'                 => $request->no_member,
            'nik'                       => $request->nik,
            'email'                     => $request->email,
            'nama_lengkap'              => $request->nama_lengkap,
            'no_hp'                     => $request->no_hp,
            'alamat_lengkap'            => $request->alamat_lengkap,
            'tempat_lahir'              => $request->tempat_lahir,
            'tgl_lahir'                 => $request->tgl_lahir,
            'ref'                       => $request->ref,
            'bank_rek_ref'              => $request->bank_rek_ref,
            'no_rek_ref'                => $request->no_rek_ref,
            'an_rek_ref'                => $request->an_rek_ref,
            'fb'                        => $request->fb,
            'pp'                        => $photofile,
            'instagram'                 => $request->instagram,
            'instansi_id'               => $request->nama_instansi,
            'lembaga_pemerintahan_id'   => $request->lembaga_pemerintahan,
            'kategori_tempat_kerja_id'  => $request->kategori_kerja,
            'expired_date'              => $request->expired_date,
            'nip'                       => $request->nip,

        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menambah member"
        ], 200);
    }

    public function show($id)
    {
        return Member::with('instansi', 'lembagapemerintah', 'kategoritempatkerja')->findOrFail($id);
    }

    public function edit($id)
    {
        return Member::with('instansi', 'lembagapemerintah', 'kategoritempatkerja')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_member'                 => ['required', 'max:255'],
            'nik'                       => ['required', 'max:255'],
            'email'                     => ['required', 'max:255'],
            'nama_lengkap'              => ['required', 'max:255'],
            'no_hp'                     => ['required', 'max:255'],
            'alamat_lengkap'            => ['required', 'max:255'],
            'tempat_lahir'              => ['required', 'max:255'],
            'tgl_lahir'                 => ['required', 'max:255'],
            'ref'                       => ['required', 'max:255'],
            'bank_rek_ref'              => ['required', 'max:255'],
            'no_rek_ref'                => ['required', 'max:255'],
            'an_rek_ref'                => ['required', 'max:255'],
            'fb'                        => ['required', 'max:255'],
            'instagram'                 => ['required', 'max:255'],
            'nama_instansi'             => ['required', 'max:255'],
            'lembaga_pemerintahan'      => ['required', 'max:255'],
            'kategori_kerja'            => ['required', 'max:255'],
            'expired_date'              => ['required', 'max:255'],
            'nip'                       => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => "fail",
                'messages' => $validator->errors()->first(),
            ], 422);
        }

        $photofile = null;
        if ($request->hasFile('pp')) {
            $photofile = \Helper::storeFile('foto_profile', $request->pp);
        }
        $member = Member::findOrFail($id);
        $member->update([
            'no_member'                 => $request->no_member,
            'email'                     => $request->email,
            'nama_lengkap'              => $request->nama_lengkap,
            'no_hp'                     => $request->no_hp,
            'alamat_lengkap'            => $request->alamat_lengkap,
            'tempat_lahir'              => $request->tempat_lahir,
            'tgl_lahir'                 => $request->tgl_lahir,
            'bank_rek_ref'              => $request->bank_rek_ref,
            'no_rek_ref'                => $request->no_rek_ref,
            'an_rek_ref'                => $request->an_rek_ref,
            'fb'                        => $request->fb,
            'pp'                        => $photofile,
            'instagram'                 => $request->instagram,
            'instansi_id'               => $request->nama_instansi,
            'lembaga_pemerintahan_id'   => $request->lembaga_pemerintahan,
            'kategori_tempat_kerja_id'  => $request->kategori_kerja,
            'expired_date'              => $request->expired_date,
            'nip'                       => $request->nip,
        ]);

        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil update member"
        ], 200);
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return response()->json([
            'status'   => 'ok',
            'messages' => "Berhasil menghapus member"
        ], 200);
    }

    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::with('instansi', 'lembagapemerintah', 'kategoritempatkerja')->orderBy('updated_at', 'ASC');
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_instansi', function ($row) {
                    return $row->instansi->nama;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('admin.member.show', $row->id) . '" id="btnShow" class="btn-sm btn btn-info mr-1" data-toggle="tooltip" data-placement="top" title="Lihat Data"><i class="fa fa-eye"></i></a>';
                    $actionBtn .= '<a data-toggle="tooltip" data-placement="top" title="Edit Data" id="btnEdit" href="' . route('admin.member.show', $row->id) . '" class="btn-sm btn btn-warning"><i class="fa fa-edit"></i></a>';
                    $actionBtn .= '<button type="button" class="btn-sm btn btn-danger" id="btnHapus" data-id=' . $row->id . ' action="' . route('admin.member.destroy', $row->id) . '"><i class="fa fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
