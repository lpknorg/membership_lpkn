<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventKamuController extends Controller
{
    public function index()
    {
        return view('member.profile.event_kamu');
    }
}
