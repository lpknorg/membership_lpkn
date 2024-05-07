<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Member\EventKamuController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\{Provinsi, Instansi, LembagaPemerintahan};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{
    EventExport
};

class DashboardController extends Controller
{
    public function index(){        
        $provinsi = Provinsi::orderBy('nama')->get();
        $arr_provinsi = Provinsi::orderBy('nama')->pluck('nama');
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

    public function hitApi($endpoint){
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $endpoint = env('API_EVENT').$endpoint;
        $request = $client->get($endpoint);

        $response = $request->getBody()->getContents();
        // print_r($response);die;
        return json_decode($response, true);
    }

    public function index2(){        
        $arr_tipe_event = ['Berbayar', 'Gratis', 'Tatap Muka', 'Non Tatap Muka'];
        $arr_total_bytipe = $this->hitApi('member/event/total_event_by_jenis');        
        return view('dashboard2', compact('arr_tipe_event', 'arr_total_bytipe'));
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

    public function dataTableEvent(Request $request){
        $eventData = $this->hitApi("member/event/dashboard_all_event?tanggal_awal={$request->tanggal_awal}&tanggal_akhir={$request->tanggal_akhir}&kategori_event={$request->kategori_event}&jenis_event={$request->jenis_event}");
        // dd($arr_all_event);
        return \DataTables::of($eventData)
            ->addIndexColumn()
            ->addColumn('img_brosur', function($row){
                return "<a target='_blank' href={$row['brosur_img']}><img height='40' data-action='zoom' src={$row['brosur_img']}></a>";
            })
            ->addColumn('link_event', function($row){
                return "<a target='_blank' href={$row['link_slugg']}><i class='fa fa-link'></i></a>";
            })
            ->addColumn('link_list_alumni', function($row){
                return "<a target='_blank' href=".route('dashboard2.get_user_by_event', $row['id']).">{$row['judul']}</a>";
            })
            ->rawColumns(['img_brosur', 'link_event', 'link_list_alumni'])
            ->make(true);
    }

    public function exportExcelEvent(Request $request){
        $eventData = $this->hitApi("member/event/dashboard_all_event?tanggal_awal={$request->tanggal_awal}&tanggal_akhir={$request->tanggal_akhir}&kategori_event={$request->kategori_event}&jenis_event={$request->jenis_event}");
        $now = date('d-m-Y');
        return Excel::download(new EventExport($eventData),"event_{$now}.xlsx");
    }

    public function detailAlumni ($email){
        $user = User::where('email', $email)->first();
        dd($user);
        $eventKamu = new EventKamuController();
        $my_event = $eventKamu->getRespApiWithParam([], 'member/event/dashboard_detail_alumni?email='.$email, 'get');
        return view('admin.user.detail_user', compact('user', 'my_event'));
    }

    public function getUserByIdEvent($id_event){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/event/all_event_by_id';
        $datapost = ['id_event'=>$id_event];
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return view('admin.dashboard2.alumni_by_event', compact('data'));
    }
}
