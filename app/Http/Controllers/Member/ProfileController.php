<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getRespApi($endpoint){
        $client = new \GuzzleHttp\Client();
        $request = $client->get($endpoint);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function index()
    {
    	$new_event = $this->getRespApi('https://event.lpkn.id/api/member/event');
        $user = \Auth::user();
        return view('member.profile.index', compact('user', 'new_event'));
    }

    public function allEvent($page=null){
        $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        $event = $this->getRespApi($url);
        // dd($event);
        return view('pages.event.index', compact('event'));
    }

    public function editProfile(){
        return view('member.profile.update_profile');
    }

    public function detailEvent($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/event/event_detail';
        $request = $client->post($endpoint, ['form_params' => $datapost]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function getEventModal($slug){
        if (\Auth::check()) {
            $member = \Auth::user();
            $datapost = ['slug' => $slug, 'email' => $member->email];
            $event = $this->detailEvent($datapost);
            $data['detail_event'] = $event;
            $data['member'] = $member;
            // dd($event);
            if ($event['status'] == 0) {
                return view('response.event.get_event')->with($data);
            }else if($event['status'] == 1){
                return view('response.event.get_event_status')->with($data);
            }else if($event['status'] == 2){
                return view('response.event.get_event_lunas')->with($data);
            }
        }else{
            dd('engga');
        }
    }

    public function eventRegist($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/action/regis_event';
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function regisEvent(Request $request){
        $user = \Auth::user();
        $data = array(
            'id_event' => $request->id_event, 
            'email' => $user->email, 
            'nama_lengkap' => $user->name,
            'alamat_lengkap' => $user->member->alamat_lengkap,
            'ref' => null,
            'biaya' => $request->biaya,
            'no_hp' => $user->member->no_hp
        );
        $slug = $request->slug;
        $getRes = $this->eventRegist($data);
        if ($getRes['status'] == "sukses") {
            $resp['success'] = true;
            $resp['msg'] = 'Berhasil Mendaftar';
            $resp['slug'] = $slug;
        }else if($getRes['status'] == 'duplikat'){
            $resp['success'] = false;
            $resp['msg'] = 'Anda sudah terdaftar';
        }else{
            $resp['success'] = false;
            $resp['msg'] = 'Gagal';
        }
        return $resp;

    }

    public function buktiUpload($datapost){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_EVENT').'member/action/upload_bukti';
        $request = $client->post($endpoint, [
            'multipart' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
            ]
        ]);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }

    public function uploadBukti(Request $request){
        if (!isset($request->bukti)) {
            $data['success'] = false;
            $data['msg'] = "Dokumen bukti harus diupload";            
            return $data;
        }
        if ($request->hasFile('bukti')) {
            $validator = Validator::make($request->only('bukti'), [
                'bukti' => ['mimes:jpg,png,jpeg', 'max:3000'],
            ]);

            if ($validator->fails()) {
                $data['success'] = false;
                $data['msg'] = "File harus berupa gambar dengan format jpg atau png";            
                return $data;
            }
        }
        $client = new \GuzzleHttp\Client();
        $id_regis = $request->id_regis;
        $bukti = $request->bukti;
        $slug = $request->slug;
        // $data = ['id_regis' => $id_regis, 'bukti' => $bukti];
        $data = [
            [
                'name'     => 'bukti',
                'contents' => $bukti->getContent(),
                'filename' => $bukti->getClientOriginalName()
            ],
            [
                'name'     => 'id_regis',
                'contents' => $id_regis
            ]
        ];
        $getRes = $this->buktiUpload($data);
        return $getRes;

    }
}
