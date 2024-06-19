<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});
Route::get('all_alumni', function(){
	$results = \DB::select("select email from users limit 10");
	$emails = array_map(function($item) {
		return $item->email;
	}, $results);
	dd($emails);
});
Route::post('/daftar_member/', [App\Http\Controllers\Api\MemberController::class, 'daftar'])->name('api.daftar_member');
Route::post('/daftar_member_lpkn/', [App\Http\Controllers\Api\MemberController::class, 'daftarLpkn'])->name('api.daftar_member_lpkn');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('api.login');
Route::post('/update_profile/', [App\Http\Controllers\Member\ProfileController::class, 'updateProfile'])->name('api.update_profile');
Route::post('/update_password/', [App\Http\Controllers\Member\ProfileController::class, 'updatePassword'])->name('api.update_password');
Route::post('/update_fotoprofile', [App\Http\Controllers\Member\ProfileController::class, 'updateFotoProfile'])->name('update_fotoprofile');
Route::get('/Kta', [App\Http\Controllers\Member\ProfileController::class, 'download_kta'])->name('download_kta');


Route::get('/get_video_materi/{slug}', [App\Http\Controllers\Member\ProfileController::class, 'getVideoMateri'])->name('get_video_materi');

Route::post('/general/lembaga_pemerintahan', [App\Http\Controllers\Admin\LembagaPemerintahanController::class, 'getData'])->name('api.get.lembaga_pemerintahan');
Route::get('/general/provinsi', [App\Http\Controllers\Api\general\Provinsi::class, 'main'])->name('api.get.provinsi');
Route::get('/general/kota', [App\Http\Controllers\Api\general\Kota::class, 'main'])->name('api.get.kota');
Route::get('/general/kecamatan', [App\Http\Controllers\Api\general\Kecamatan::class, 'main'])->name('api.get.kecamatan');
Route::get('/general/kelurahan', [App\Http\Controllers\Api\general\Kelurahan::class, 'main'])->name('api.get.kelurahan');
Route::get('/general/kodepos', [App\Http\Controllers\Api\general\Kodepos::class, 'main'])->name('api.get.kodepos');


Route::get('get_member_by_lembaga_pemerintahan', [App\Http\Controllers\DashboardController::class, 'getByLembagaPemerintahan'])->name('api.getMemberByLembagaPemerintahan');