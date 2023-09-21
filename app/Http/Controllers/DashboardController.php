<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\{Provinsi, Instansi, LembagaPemerintahan};

class DashboardController extends Controller
{
    public function index(){
        $provinsi = Provinsi::orderBy('nama')->get();
        $arr_provinsi = Provinsi::orderBy('nama')->pluck('nama');
        $instansi = Instansi::where('nama', '!=', 'Perangkat Daerah')->orderBy('nama')->get();
        $arr_total_byprovinsi = [];
        foreach ($provinsi as $value) {
            // $t = User::whereHas('member')->where('prov_id', $value->kode)->count();
            $t = User::whereHas('member', function($q)use($value){
                $q->where('prov_id', $value->id);
            })
            ->count();
            array_push($arr_total_byprovinsi, $t);
        }
        $instansi = Instansi::where('nama', '!=', 'Perangkat Daerah')->orderBy('nama')->get();
        $arr_instansi = Instansi::where('nama', '!=', 'Perangkat Daerah')->orderBy('nama')->pluck('nama');
        $arr_total_byinstansi = [];
        foreach ($instansi as $value) {
            $t = User::whereHas('member.memberKantor', function($q)use($value){
                $q->where('instansi_id', $value->id);
            })
            ->count();
            array_push($arr_total_byinstansi, $t);
        }

        $arr_kepegawaian = ['PNS', 'SWASTA', 'TNI/POLRI', 'BUMN/BUMD', 'HONORER / KONTRAK', 'ASN', 'Swasta', 'Lainnya'];
        $arr_total_bykepegawaian = [];
        foreach ($arr_kepegawaian as $key => $value) {
            $t = User::whereHas('member.memberKantor', function($q)use($value){
                $q->where('status_kepegawaian', 'like', "%{$value}%");
            })
            ->count();
            array_push($arr_total_bykepegawaian, $t);
        }
        return view('dashboard', compact('instansi', 'arr_provinsi', 'arr_total_byprovinsi', 'arr_instansi', 'arr_total_byinstansi', 'arr_kepegawaian', 'arr_total_bykepegawaian'));
    }

    public function getByLembagaPemerintahan(Request $req){
        $lp = LembagaPemerintahan::where('instansi_id', $req->instansi_id)->orderBy('nama')->get();
        $arr_lp = LembagaPemerintahan::where('instansi_id', $req->instansi_id)->orderBy('nama')->pluck('nama');
        $arr_total_bylp = [];
        foreach ($lp as $value) {
            $t = User::whereHas('member.memberKantor', function($q)use($value){
                $q->where('lembaga_pemerintahan_id', $value->id);
            })
            ->count();
            array_push($arr_total_bylp, $t);
        }
        return [$arr_lp, $arr_total_bylp];
    }
}
