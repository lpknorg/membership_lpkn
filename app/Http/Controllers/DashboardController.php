<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Member\EventKamuController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\{Provinsi, Instansi, LembagaPemerintahan, Member, MemberKantor};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{
    EventExportBerbayar,
    EventExportGratis,
    ExportAlumniByEvent,
    ExportAlumniRegis
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

    public function flattenArray($array) {
        $result = [];

        foreach ($array as $element) {
            if (is_array($element)) {
                $result = array_merge($result, $this->flattenArray($element));
            } else {
                $result[] = $element;
            }
        }

        return $result;
    }

    public function getApiTotalTahunan($arrYear, $jenis_kelas=0){
        $newArr = [];
        $by_tahun = $this->hitApi("member/event/total_regis_pertahun?jenis_kelas={$jenis_kelas}&tahun=2022");
        foreach($arrYear as $y){
            $by_tahun = $this->hitApi("member/event/total_regis_pertahun?jenis_kelas={$jenis_kelas}&tahun={$y['tahun']}");
            foreach($by_tahun as $t){
                $content = [
                    $t['jumlah_event'], $t['jumlah_peserta']
                ];
                array_push($newArr, $content);
            }
        }
        return $this->flattenArray($newArr);
    }
    public function getApiTotalPbj($tahun1,$tahun2=null, $jenis_kelas='pbj'){
        $data = $this->hitApi("member/event/total_kelulusan?tahun1={$tahun1}&tahun2={$tahun2}&jenis_kelas=pbj");
        return $data;
    }

    public function getApiTotalBulanan($tahun=2022, $jenis_kelas=0){
        $by_bulan = $this->hitApi("member/event/total_regis_perbulan?jenis_kelas={$jenis_kelas}&tahun={$tahun}");
        $defaultEvents = [];
        for ($i = 1; $i <= 12; $i++) {
            $defaultEvents[$i] = ['bulan' => $i, 'jumlah_event' => 0, 'jumlah_peserta' => 0];
        }

        // Gabungkan array asli dengan array default
        foreach ($by_bulan as $event) {
            $bulan = $event['bulan'];
            $defaultEvents[$bulan] = $event;
        }
        ksort($defaultEvents);
        array_values($defaultEvents);
        $newArr = [];
        foreach($defaultEvents as $t){
            $content = [
                $t['jumlah_event'], $t['jumlah_peserta']
            ];
            array_push($newArr, $content);
        }
        return $this->flattenArray($newArr);
    }

    public function index2(Request $request){  
        if ($request->ajax()) {
            // $arrYear = $this->hitApi('member/event/total_event_pertahun');
            $arrYear = [];
            for($i=$request->year1;$i<=$request->year2;$i++){
                array_push($arrYear, ['tahun' => $i]);
            }         
            $listStatus = ['Total Event', 'Verifikasi'];
            session()->forget('api_dashboard_total_tahunan');
            $arrApi = [
                $this->getApiTotalTahunan($arrYear),
                $this->getApiTotalTahunan($arrYear, 1),
                $this->getApiTotalTahunan($arrYear, 'pbj')
            ];
            session(['api_dashboard_total_tahunan' => $arrApi]);
            $api_tahunan = session('api_dashboard_total_tahunan');
            $fixApiT = [$api_tahunan[0], $api_tahunan[1], $api_tahunan[2]];            

            $newArrayTahun = [
                'KELAS ONLINE' => $fixApiT[0],
                'KELAS TATAP MUKA' => $fixApiT[1],
                'KELAS PBJ' => $fixApiT[2]
            ];
            return view('admin.dashboard2.resp_event_tahunan', compact('arrYear', 'listStatus', 'newArrayTahun'));
        }
        $selectedYear = \Request::get('year_dash_filter');

        $arr_tipe_event = ['Berbayar', 'Gratis', 'Tatap Muka', 'Non Tatap Muka'];
        $arr_total_bytipe = $this->hitApi('member/event/total_event_by_jenis');
        

        return view('dashboard2', compact('arr_tipe_event', 'arr_total_bytipe','selectedYear'));
    }

    public function responseByBulan(Request $req){
        $selectedYear = $req->year;
        $months = [];
        $listStatus = ['Total Event', 'Verifikasi'];
        for ($i = 1; $i <= 12; $i++) {
            $date = \DateTime::createFromFormat('!m', $i);
            $months[] = $date->format('F');
        }
        if (!session()->has('api_total_bulanan') || \Request::get('refresh_api') || $selectedYear) {
            $arrApi = [
                $this->getApiTotalBulanan($selectedYear),
                $this->getApiTotalBulanan($selectedYear, 1),
                $this->getApiTotalBulanan($selectedYear, 'pbj')
            ];
            session(['api_total_bulanan' => $arrApi]);            
        }        
        $api_bulanan = session('api_total_bulanan');
        $fixApiB = [$api_bulanan[0], $api_bulanan[1], $api_bulanan[2]];

        $newArrayBulan = [
            'KELAS ONLINE' => $fixApiB[0],
            'KELAS TATAP MUKA' => $fixApiB[1],
            'KELAS PBJ' => $fixApiB[2],
        ];
        return view('admin.dashboard2.resp_rekap_event_bulanan', compact('newArrayBulan', 'selectedYear', 'months', 'listStatus'));
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
        // dd($eventData);
        return \DataTables::of($eventData)
        ->addIndexColumn()
        ->addColumn('link_event', function($row){
            return "<a target='_blank' href={$row['link_slugg']}><i class='fa fa-link'></i></a>";
        })
        ->addColumn('link_list_alumni', function($row){
            return "<a style='color: #4f4fbd;' target='_blank' href=".route('dashboard2.get_user_by_event', $row['id']).">{$row['judul']}</a>";
        })
        ->addColumn('waktu_pelaksanaan', function($row){
            if ($row['tgl_start'] == $row['tgl_end']) {
                return \Helper::changeFormatDate($row['tgl_start'], 'd-M-Y');
            }
            $cont = \Helper::changeFormatDate($row['tgl_start'], 'd-M-Y').' s/d '. \Helper::changeFormatDate($row['tgl_end'], 'd-M-Y');   
            // if ($row['jenis_kelas'] == '0') {                
                // $a = $row['jam_start'];
                // $b = $row['jam_end'];
                // $cont .= '<br>';
                // if ($a == '00:00:00') {
                //     $cont .= $row['jumlah_sesi'];
                // }else{
                //     $cont .= $a.' s/d '.$b;
                // }
            // }
            return $cont; 
        })
        ->rawColumns(['link_event', 'link_list_alumni', 'waktu_pelaksanaan'])
        ->make(true);
    }

    public function eventGratis(){
        return view('admin.dashboard2.event_gratis');
    }

    public function dataTableEventGratis(Request $request){
        $endpoint_ = env('API_FORM_SERTIFIKAT').'kelas_sertif';
        if ($request->tgl1) {
            $endpoint_ = env('API_FORM_SERTIFIKAT')."kelas_sertif/{$request->tgl1}";
        }
        if ($request->tgl2) {
            $endpoint_ = env('API_FORM_SERTIFIKAT')."kelas_sertif/{$request->tgl1}/{$request->tgl2}";
        }
        $event_gratis = \Helper::getRespApiWithParam($endpoint_);
        // dd($event_gratis);
        return \DataTables::of($event_gratis)
        ->addIndexColumn()
        ->addColumn('created_at', function($row){
            return \Helper::changeFormatDate($row['created_at'], 'd-M-Y');
        })
        ->addColumn('link_sertifikat', function($row){
            return "<a style='color: #4f4fbd;' href={$row['link']} target='_blank'>{$row['link']}</a>";
        })
        ->addColumn('link_list_alumni', function($row){
            return "<a style='color: #4f4fbd;' target='_blank' href=".route('dashboard2.get_user_by_event_gratis', $row['id']).">{$row['judul']}</a>";
        })
        ->rawColumns(['created_at', 'link_sertifikat', 'link_list_alumni'])
        ->make(true);
    }

    public function exportExcelEvent($tipe, Request $request){
        $now = date('d-m-Y');
        if ($tipe == 'berbayar') {
            $eventData = $this->hitApi("member/event/dashboard_all_event?tanggal_awal={$request->tanggal_awal}&tanggal_akhir={$request->tanggal_akhir}&kategori_event={$request->kategori_event}&jenis_event={$request->jenis_event}");            
            return Excel::download(new EventExportBerbayar($eventData),"event-berbayar_{$now}.xlsx");
        }else{
            $endpoint_ = env('API_FORM_SERTIFIKAT')."kelas_sertif/{$request->tanggal_awal}/{$request->tanggal_akhir}";
            $eventData = \Helper::getRespApiWithParam($endpoint_);
            return Excel::download(new EventExportGratis($eventData),"event-gratis_{$now}.xlsx");
        }
    }



    public function exportAlumniRegis(Request $request){
        $now = date('d-m-Y');
        $alumniRegist = $this->hitApi("member/event/dashboard_all_regis_event?tanggal_awal={$request->tanggal_awal}&tanggal_akhir={$request->tanggal_akhir}&kategori_event={$request->kategori_event}&jenis_event={$request->jenis_event}&kelulusan_event={$request->kelulusan_event}&ketidaklulusan_event={$request->ketidaklulusan_event}");
        return Excel::download(new ExportAlumniRegis($alumniRegist),"alumni-regist_{$now}.xlsx");
    }

    public function exportExcelAlumniByEvent($tipe, Request $req){
        if ($tipe == 'berbayar') {
            $endpoint = env('API_EVENT').'member/event/all_event_by_id?id_event='.$req->id_event;
            $data = \Helper::getRespApiWithParam($endpoint, 'get');
        }else{
            $endpoint = env('API_FORM_SERTIFIKAT').'Kelas_sertif/regis_sertif/'.$req->id_event;
            $data = \Helper::getRespApiWithParam($endpoint, 'get');
            $data = $data['list_regis_sertif'];
        }
        dd($data);
        return Excel::download(new ExportAlumniByEvent($data, $tipe),"alumnievent-{$tipe}.xlsx");
    }

    public function detailAlumni ($email){
        $user = User::where('email', $email)->first();
        $endpoint = env('API_EVENT').'member/event/dashboard_detail_alumni?email='.$email;
        $my_event = \Helper::getRespApiWithParam($endpoint, 'get');
        $dataAlumni = $my_event['dataAlumni'];  
        $statVerif = [];
        $statPending = [];
        $statBelumBayar = [];  
        foreach($my_event['event'] as $key => $v){
            if ($v['status_pembayaran'] == 1) {
                array_push($statVerif, $key);
            }elseif ($v['status_pembayaran'] == 0 && $v['bukti']) {
                array_push($statPending, $key);
            }else{
                array_push($statBelumBayar, $key);                
            }
        }
        $totalDataStatus = [count($statVerif), count($statPending), count($statBelumBayar)];
        if (!$user) {
            \DB::beginTransaction();
            $dataAlumni = $my_event['dataAlumni'];
            try {
                $user = User::create([
                    'name' => $dataAlumni['nama_lengkap'],
                    'nik' => $dataAlumni['nik'],
                    'email' => $email,
                    // set password default untuk alumni
                    'password' => \Hash::make('alumni@2024'),
                    'email_verified_at' => now()
                ]);
                $user->syncRoles('member');

                $request['user_id'] = $user->id;
                $member = Member::create([
                    'no_hp' => $dataAlumni['no_hp'],
                    'alamat_lengkap' => $dataAlumni['alamat'],
                    'tempat_lahir' => $dataAlumni['tempat_lahir'],
                    'tgl_lahir' => \Helper::changeFormatDate($dataAlumni['tgl_lahir'], 'Y-m-d'),
                    'user_id' => $user->id
                ]);
                MemberKantor::create([
                    'member_id' => $member->id,
                    'nama_instansi' => $dataAlumni['instansi'],
                    'unit_kerja' => $dataAlumni['unit_organisasi'],
                ]);
                \DB::commit();
            } catch (Exception $e) {
                \DB::rollback();
                return response()->json([
                    'status'    => "fail",
                    'messages' => "Ada kesalahan dalam proses daftar",
                ], 422);
            }
        }
        return view('admin.user.detail_user', compact('user', 'my_event', 'totalDataStatus'));
    }

    public function getUserByIdEvent($id_events){
        $endpoint = env('API_EVENT').'member/event/all_event_by_id?id_event='.$id_events;
        $alumni_list_event = \Helper::getRespApiWithParam($endpoint, 'get');
        $statVerif = [];
        $statPending = [];
        $statBelumBayar = [];
        foreach($alumni_list_event as $key => $v){
            if ($v['status_pembayaran'] == 1) {
                array_push($statVerif, $key);
            }elseif ($v['status_pembayaran'] == 0 && $v['bukti_bayar']) {
                array_push($statPending, $key);
            }else{
                array_push($statBelumBayar, $key);                
            }
        }
        $totalDataStatus = [count($statVerif), count($statPending), count($statBelumBayar)];
        return view('admin.dashboard2.alumni_by_event', compact('id_events', 'totalDataStatus', 'alumni_list_event'));
    }

    public function lulusPbj(Request $request){
        if ($request->ajax()) {
            $arrApi = [
                $this->getApiTotalPbj($request->year1, $request->year2)
            ];
            session()->forget('api_dashboard_total_pbjj');
            session(['api_dashboard_total_pbjj' => $arrApi]);
            $api_pbj = session('api_dashboard_total_pbjj');
            $totPbj = [];
            $a = 0;$b = 0;$c = 0;$d = 0;
            foreach($api_pbj[0]['list_kelulusan'] as $p){
                $a += $p['peserta_tidak_lulus'];
                $b += $p['peserta_lulus'];            
                $c += $p['total_peserta'];            
            }        
            $d += $api_pbj[0]['total_event'];
            array_push($totPbj, [$a, $b, $c, $d]);
            $totPbj = $this->flattenArray($totPbj);
            return view('admin.dashboard2.resp_pbj_lulus', compact('totPbj', 'api_pbj'));
        }        
        return view('admin.dashboard2.pbj_lulus');
    }

    public function getUserByIdEventGratis($id_events){
        $endpoint = env('API_FORM_SERTIFIKAT').'Kelas_sertif/regis_sertif/'.$id_events;
        $alumni_list_event = \Helper::getRespApiWithParam($endpoint, 'get');
        $statVerif = [];
        $statPending = [];
        $statBelumBayar = [];
        foreach($alumni_list_event['list_regis_sertif'] as $key => $v){
            if ($v['status_pembayaran'] == 1) {
                array_push($statVerif, $key);
            }elseif ($v['status_pembayaran'] == 0 && $v['bukti']) {
                array_push($statPending, $key);
            }else{
                array_push($statBelumBayar, $key);                
            }
        }
        $totalDataStatus = [count($statVerif), count($statPending), count($statBelumBayar)];
        return view('admin.dashboard2.alumni_by_event', compact('id_events', 'totalDataStatus', 'alumni_list_event'));
    }

    public function getUserByIdEventDatatable(Request $request){
        if ($request->tipe == 'berbayar') {
            $endpoint = env('API_EVENT').'member/event/all_event_by_id?id_event='.$request->id_event;
            $alumni_list_event = \Helper::getRespApiWithParam($endpoint, 'get');
        }else{
            $endpoint = env('API_FORM_SERTIFIKAT').'Kelas_sertif/regis_sertif/'.$request->id_event;
            $data = \Helper::getRespApiWithParam($endpoint, 'get');
            $alumni_list_event = $data['list_regis_sertif'];
        }
        return \DataTables::of($alumni_list_event)
        ->addIndexColumn()
        ->addColumn('email_', function($row){
            return "<a style='color: #4f4fbd;' target='_blank' href=".route('dashboard2.detail_alumni', $row['email']).">{$row['nama_lengkap']}</a>";
        })
        ->addColumn('status_pembayaran', function($row){
            if($row['status_pembayaran'] == 1){
                return "<span class='badge badge-success'>Terverifikasi</span>";
            }else if($row['status_pembayaran'] == 0 && $row['bukti_bayar']){
                return "<span class='badge badge-warning'>Pending</span>";
            }else{
                return "<span class='badge badge-danger'>Belum Pembayaran</span>";
            }
        })
        ->addColumn('unit_organisasi', function($row){
            if (isset($row['unit_organisasi'])) {
                return $row['unit_organisasi'];
            }
            return '-';
        })
        ->rawColumns(['status_pembayaran', 'email_'])
        ->make(true);
    }
}
