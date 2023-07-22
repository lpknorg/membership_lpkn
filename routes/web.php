<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
	ProvinsiController,
	KotaController,
	InstansiController,
	LembagaPemerintahanController,
	KategoriTempatKerjaController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard');
Route::view('abc', 'test');
Route::get('member', function(){
	return redirect('/home');
});

Route::get('/import_provinsi', [App\Http\Controllers\HomeController::class, 'importProvinsi']);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::get('/provinsi/dataTables', [ProvinsiController::class, 'getDatatable'])->name('provinsi.dataTables');
	Route::resource('/provinsi', ProvinsiController::class);

	Route::get('/kota/dataTables', [KotaController::class, 'getDatatable'])->name('kota.dataTables');
	Route::resource('/kota', KotaController::class);

	Route::get('/instansi/dataTables', [InstansiController::class, 'getDatatable'])->name('instansi.dataTables');
	Route::resource('/instansi', InstansiController::class);

	Route::get('/lembaga_pemerintahan/dataTables', [LembagaPemerintahanController::class, 'getDatatable'])->name('lembaga_pemerintahan.dataTables');
	Route::resource('/lembaga_pemerintahan', LembagaPemerintahanController::class);

	Route::get('/kategori_tempat_kerja/dataTables', [KategoriTempatKerjaController::class, 'getDatatable'])->name('kategori_tempat_kerja.dataTables');
	Route::resource('/kategori_tempat_kerja', KategoriTempatKerjaController::class);
});