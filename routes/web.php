<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
	ProvinsiController,
	KotaController,
	InstansiController,
	LembagaPemerintahanController,
	KategoriTempatKerjaController,
	UserController,
    MemberController,
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
Route::group(['prefix' => 'member_profile', 'as' => 'member_profile.', 'middleware' => 'auth'], function () {
	Route::get('/', [App\Http\Controllers\Member\ProfileController::class, 'index'])->name('index');
	Route::get('/page/get_event/{slug}', [App\Http\Controllers\Member\ProfileController::class, 'getEventModal'])->name('get_event.modal');
	Route::get('/page/get_video_materi/{slug}', [App\Http\Controllers\Member\ProfileController::class, 'getVideoMateri'])->name('get_video_materi');
	Route::post('/page/regis_event', [App\Http\Controllers\Member\ProfileController::class, 'regisEvent'])->name('regis_event');
	Route::post('/page/upload_bukti', [App\Http\Controllers\Member\ProfileController::class, 'uploadBukti'])->name('upload_bukti');
	Route::get('/edit_profile', [App\Http\Controllers\Member\ProfileController::class, 'editProfile'])->name('edit_profile');
	Route::post('/update_profile', [App\Http\Controllers\Member\ProfileController::class, 'updateProfile'])->name('update_profile');

	Route::get('/menunggu_pembayaran', [App\Http\Controllers\Member\MenungguPembayaranController::class, 'index'])->name('menunggu_pembayaran.index');
	
	Route::get('/event_kamu', [App\Http\Controllers\Member\EventKamuController::class, 'index'])->name('event_kamu.index');
	Route::get('/sertifikat_kamu', [App\Http\Controllers\Member\SertifikatKamuController::class, 'index'])->name('sertifikat_kamu.index');
	Route::get('/dokumentasi', [App\Http\Controllers\Member\DokumentasiController::class, 'index'])->name('dokumentasi.index');
	Route::get('/voucher', [App\Http\Controllers\Member\VoucherController::class, 'index'])->name('voucher.index');

	Route::get('/allevent/{id}', [App\Http\Controllers\Member\ProfileController::class, 'allEvent'])->name('allevent');
	Route::get('/peraturan', [App\Http\Controllers\Member\ProfileController::class, 'peraturan'])->name('peraturan');
	Route::post('/download_peraturan', [App\Http\Controllers\Member\ProfileController::class, 'download_peraturan'])->name('download_peraturan');
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

	Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/user/dataTables', [UserController::class, 'getDatatable'])->name('user.dataTables');
	Route::resource('/user', UserController::class);

    Route::get('/member/dataTables', [MemberController::class, 'getDatatable'])->name('member.dataTables');
	Route::resource('/member', MemberController::class);

});
