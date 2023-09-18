<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumentasiController extends Controller
{
    public function index(Request $request)
    {


        if(empty($request->id_artikel)){
            $id = 'all';
        }else{
            $id =  $request->id_artikel;
        }

        $perPage = 9; // Number of images per page
        $currentPage = $request->input('page', 1); // Get the current page from the URL parameter
        $offset = ($currentPage - 1) * $perPage;

		$datapost = [
            'id' => $id,
            'offset' => $offset,
            'perPage' => $perPage,
        ];

        $dokumentasi = $this->getRespApiWithParam($datapost, 'Artikel/get_artikel');
        $dokumentasi =  $dokumentasi['artikels'];

        $totalData = $this->countData();
        $totalPages = ceil($totalData / $perPage);

        $skipPages1 = [];
        for ($i = 1; $i <=4; $i++) {
            if($i<3){
                $skipPages1[] = $i;
            }
        }
        $addzero = [0];
        $skipPages1 = array_merge($skipPages1, $addzero);
        $skipPages2 = [];

        if($currentPage <= ($totalPages-2)){
            for ($i = $currentPage ; $i <= ($currentPage+2); $i++) {
                $skipPages2[] = $i;
            }
        }
        if($currentPage < 6 ){
            if($currentPage == 5){
                $paginationLinks = [1,2,3,4,5,($currentPage+1), 0, ($totalPages-1),$totalPages];
            }else{
                $paginationLinks = [1,2,3,4,5, 0, ($totalPages-1),$totalPages];
            }
        }elseif($currentPage == 6){
            $paginationLinks = [1,2,3,4,5,($currentPage),($currentPage+1),0, ($totalPages-1),$totalPages];
        }else {
            $paginationLinks = [1,2,3,4,5,0, ($totalPages-1),$totalPages];
            if(($currentPage == $totalPages) || ($currentPage == ($totalPages-1)) ){
                $skipPages3 = array_unique(array_merge($skipPages1, $skipPages2));
                $addbefore = [($totalPages-1),($totalPages)];
                $paginationLinks = array_merge($skipPages3, $addbefore);

            }else{
                $addbefore = [($currentPage-2),($currentPage-1)];
                $skipPages4 = array_merge($addbefore, $skipPages2);
                $paginationLinks = array_unique(array_merge($skipPages1, $skipPages4));
            }
        }

        return view('member.profile.dokumentasi', compact('dokumentasi', 'currentPage', 'totalPages', 'paginationLinks'));
    }

    public function getRespApiWithParam($datapost, $url){
        $client = new \GuzzleHttp\Client();
        $endpoint = env('API_LPKN_ID').$url;
        $request = $client->post($endpoint, [
            'form_params' => $datapost,
            'headers' => [
                'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
                'Cookie' => 'ci_session=bf473e252ab962e8117a839b7de0889046813ae2'
            ]
        ]);

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return $data;
    }


    public function get_artikel(Request $request){
        if(empty($request->id_artikel)){
            $id = 'all';
        }else{
            $id =  $request->id_artikel;
        }

		$datapost = [
            'id' => $id,
            'offset' => null,
            'perPage' => null,
        ];

        $dokumentasi = $this->getRespApiWithParam($datapost, 'Artikel/get_artikel');
        $html = '';
        $html .= '
            <div class="col-md-12 mb-3 flex-column">
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-head"></div>
                    <div class="card-body text-center">
                        <div class="text-left">
                            <h4>'.$dokumentasi['artikels']['judul'].'</h4>
                            <small class="text-left"><a href="">Dibuat Oleh : <i class="fa fa-user"></i> '.$dokumentasi['artikels']['first_name'].'</a></small> |
                            <small class="text-muted text-left"><i class="far fa-calendar-alt"></i> '.mediumdate_indo($dokumentasi['artikels']['create_date']).'</small>
                        </div>
                        <hr/>
                        <img width="100%" src="'.$dokumentasi['artikels']['linkfoto'].'">
                        <hr>
                        <div class="card-text pl-3 pr-3 text-left">'.$dokumentasi['artikels']['isi'].'</div>
                        <hr>
                    </div>
                    </div>
                </div>
            </div>';

            echo json_encode($html);
	}

    public function countData()
    {
		$datapost = [
            'id' => "all",
            'offset' => null,
            'perPage' => null,
        ];
        $dokumentasi = $this->getRespApiWithParam($datapost, 'Artikel/get_artikel');
        $totalRecords = count($dokumentasi['artikels']);

        return  $totalRecords;
    }

}
