<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\{
    ProvinsiImport
};
use App\Http\Controllers\Member\ProfileController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function importProvinsi(){
        Excel::import(new ProvinsiImport, public_path('/excel/provinsi_new.xlsx'));
    }

    public function welcome($page=1, Request $request){
        $url = 'https://event.lpkn.id/api/member/event/event_page?page='.$page;
        $p = new ProfileController();
        $event = $p->getRespApi($url);
        return view('Frontend/index', compact('event'));
    }
}
