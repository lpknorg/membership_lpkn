<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumentasiController extends Controller
{
    public function index()
    {
        return view('member.profile.dokumentasi');
    }
}
