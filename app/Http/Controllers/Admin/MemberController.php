<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Member;
use App\Models\Admin\{Instansi, LembagaPemerintahan, KategoriTempatKerja};

class MemberController extends Controller
{
    public function index()
    {
        $mm = Member::orderBy('id')->get();
        $instansi = Instansi::orderBy('nama')->get();
        $lembaga = LembagaPemerintahan::orderBy('id')->get();
        $kategoritk = KategoriTempatKerja::orderBy('nama')->get();
        return view('admin.member.index', compact('mm', 'instansi', 'lembaga', 'kategoritk'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getDatatable(Request $request)
    {
        //
    }
}
