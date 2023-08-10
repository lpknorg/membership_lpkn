<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MemberImport;
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

    public function importMember(Request $request){
        Excel::import(new MemberImport, $request->file('dok_import_member')->store('files'));
        // return redirect()->back();
        return back()->with(['success_import_member' => 'Berhasil import data member']);
    }

    public function downloadFile($file, $folder=null){
        if ($folder) {
            $filePath = public_path($folder.'/'.$file);
        }else{
            $filePath = public_path($file);
        }
        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404);
        }
            // Atur header response untuk men-download file
        return response()->download($filePath);
    }
}
