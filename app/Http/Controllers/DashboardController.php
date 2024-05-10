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
    ExportAlumniByEvent
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
        ->addColumn('tgl_start', function($row){
            return \Helper::changeFormatDate($row['tgl_start'], 'd-M-Y');
        })
        ->addColumn('tgl_end', function($row){
            return \Helper::changeFormatDate($row['tgl_end'], 'd-M-Y');
        })
        ->rawColumns(['img_brosur', 'link_event', 'link_list_alumni'])
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
        return \DataTables::of($event_gratis)
        ->addIndexColumn()
        ->addColumn('created_at', function($row){
            return \Helper::changeFormatDate($row['created_at'], 'd-M-Y');
        })
        ->addColumn('link_sertifikat', function($row){
            return "<a href={$row['link']} target='_blank'>{$row['link']}</a>";
        })
        ->addColumn('link_list_alumni', function($row){
            return "<a target='_blank' href=".route('dashboard2.get_user_by_event_gratis', $row['id']).">{$row['judul']}</a>";
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

    public function exportExcelAlumniByEvent($tipe, Request $req){
        if ($tipe == 'berbayar') {
            $endpoint = env('API_EVENT').'member/event/all_event_by_id?id_event='.$req->id_event;
            $data = \Helper::getRespApiWithParam($endpoint, 'get');
        }else{
            $endpoint = env('API_FORM_SERTIFIKAT').'Kelas_sertif/regis_sertif/'.$req->id_event;
            $data = \Helper::getRespApiWithParam($endpoint, 'get');
            $data = $data['list_regis_sertif'];
        }
        return Excel::download(new ExportAlumniByEvent($data, $tipe),"alumnievent-{$tipe}.xlsx");
    }

    public function detailAlumni ($email){
        $user = User::where('email', $email)->first();

        $eventKamu = new EventKamuController();
        $my_event = $eventKamu->getRespApiWithParam([], 'member/event/dashboard_detail_alumni?email='.$email, 'get');
        $dataAlumni = $my_event['dataAlumni'];
        dd($dataAlumni);
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
        return view('admin.user.detail_user', compact('user', 'my_event'));
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
        return view('admin.dashboard2.alumni_by_event', compact('id_events', 'totalDataStatus'));
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
        return view('admin.dashboard2.alumni_by_event', compact('id_events', 'totalDataStatus'));
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
            return "<a target='_blank' href=".route('dashboard2.detail_alumni', $row['email']).">{$row['email']}</a>";
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
