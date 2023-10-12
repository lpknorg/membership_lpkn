<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
	ProvinsiController,
	KotaController,
	InstansiController,
	LembagaPemerintahanController,
	ArtikelKategoriController,
	UserController,
	MemberController,
	VideoController as VideoControllerAdmin,
	ArtikelController as ArtikelAdminController
};
use App\Http\Controllers\Member\{
	ProfileController,
	MenungguPembayaranController,
	EventKamuController,
	SertifikatKamuController,
	DokumentasiController,
	VoucherController,
	VideoController as VideoControllerMember,
};
use App\Http\Controllers\{
	HomeController,
	WelcomeController,
	EventController,
	PeraturanController,
	DashboardController	
};
use App\Http\Controllers\Artikel\{
	ArtikelController,
	ArtikelKomentarController,
	ArtikelLikeController
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
Route::get('ea', function(){
	$a = env('MAIL_USERNAME');
	dd($a);
});
Route::get('/verify_email/{token}', [App\Http\Controllers\Api\MemberController::class, 'updateVerifyEmail'])->name('updateVerifyEmail');
Route::post('/lupa_password', [App\Http\Controllers\Auth\LupaPasswordController::class, 'sendLink'])->name('lupa_password.send_link');
Route::get('/lupa_password/{token}', [App\Http\Controllers\Auth\LupaPasswordController::class, 'showForm'])->name('lupa_password.show_form');
Route::post('/update_lupa_password', [App\Http\Controllers\Auth\LupaPasswordController::class, 'updatePassword'])->name('lupa_password.update_password');

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/allevent/{id}', [EventController::class, 'allEvent'])->name('allevent');
Route::get('/video/allvideo', [VideoControllerMember::class, 'index'])->name('allvideo');
Route::get('/searchvideo', [VideoControllerMember::class, 'search'])->name('searchvideo');
Route::get('/peraturan', [PeraturanController::class, 'peraturan'])->name('peraturan');
Route::post('/download_peraturan', [PeraturanController::class, 'download_peraturan'])->name('download_peraturan');

Auth::routes();

Route::get('/home', function(){
	return redirect('/');
});
Route::get('/download_file/{file}/{folder?}', [HomeController::class, 'downloadFile'])->name('downloadFile');
// Route::view('dashboard', 'dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::view('abc', 'test');
Route::group(['prefix' => 'artikel', 'as' => 'artikel.'], function () {
	Route::get('/', [ArtikelController::class, 'index'])->name('index');
	Route::get('/create', [ArtikelController::class, 'create'])->name('create');
	Route::post('/store', [ArtikelController::class, 'store'])->name('store');
	Route::post('/komentar_store', [ArtikelKomentarController::class, 'store'])->name('komentar.store');
	Route::post('/komentar_list', [ArtikelKomentarController::class, 'getKomentar'])->name('komentar.getKomentar');
	Route::post('/like_store', [ArtikelLikeController::class, 'store'])->name('like.store');
});
Route::group(['prefix' => 'p'], function () {
	Route::get('/{uname}', [ArtikelController::class, 'indexProfile'])->name('artikel.indexProfile');
	Route::get('/{uname}/{slug}', [ArtikelController::class, 'detail'])->name('artikel.detail');
});
Route::get('member_profile/page/get_event/{slug}', [ProfileController::class, 'getEventModal'])->name('member_profile.get_event.modal');
Route::group(['prefix' => 'member_profile', 'as' => 'member_profile.', 'middleware' => 'auth'], function () {
	Route::get('/', [ProfileController::class, 'index'])->name('index');
	Route::get('/page/get_video_materi/{slug}', [ProfileController::class, 'getVideoMateri'])->name('get_video_materi');
	Route::post('/page/regis_event', [ProfileController::class, 'regisEvent'])->name('regis_event');
	Route::post('/page/upload_bukti', [ProfileController::class, 'uploadBukti'])->name('upload_bukti');
	Route::get('/edit_profile', [ProfileController::class, 'editProfile'])->name('edit_profile');
	Route::post('/update_profile', [ProfileController::class, 'updateProfile'])->name('update_profile');
	Route::post('/add_sosial_media', [ProfileController::class, 'storeSosialMedia'])->name('store_sosial_media');
	Route::post('/remove_sosial_media', [ProfileController::class, 'deleteSosialMedia'])->name('delete_sosial_media');
	Route::post('/update_fotoprofile', [ProfileController::class, 'updateFotoProfile'])->name('update_fotoprofile');

	Route::get('/menunggu_pembayaran', [MenungguPembayaranController::class, 'index'])->name('menunggu_pembayaran.index');

	Route::get('/event_kamu', [EventKamuController::class, 'index'])->name('event_kamu.index');
	Route::post('/event_kamu/transfer_event', [EventKamuController::class, 'transferEvent'])->name('event_kamu.transferEvent');
	Route::post('/testimoni', [EventKamuController::class, 'storeTestimoni'])->name('testimoni.storeTestimoni');

	Route::get('/sertifikat_kamu', [SertifikatKamuController::class, 'index'])->name('sertifikat_kamu.index');

	Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi.index');
	Route::post('/get_artikel', [DokumentasiController::class, 'get_artikel'])->name('dokumentasi.get_artikel');
	// Route::post('/count', [DokumentasiController::class, 'count'])->name('dokumentasi.count');

	Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher.index');
	Route::get('/voucher2', [VoucherController::class, 'index2'])->name('voucher.index2');

	Route::get('/Kta', [ProfileController::class, 'download_kta'])->name('download_kta');
});

Route::post('/import_member', [HomeController::class, 'importMember']);
Route::get('/import_member2', [HomeController::class, 'importMember2']);


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::get('/provinsi/dataTables', [ProvinsiController::class, 'getDatatable'])->name('provinsi.dataTables');
	Route::resource('/provinsi', ProvinsiController::class);

	Route::get('/kota/dataTables', [KotaController::class, 'getDatatable'])->name('kota.dataTables');
	Route::resource('/kota', KotaController::class);

	Route::get('/instansi/dataTables', [InstansiController::class, 'getDatatable'])->name('instansi.dataTables');
	Route::resource('/instansi', InstansiController::class);

	Route::get('/lembaga_pemerintahan/dataTables', [LembagaPemerintahanController::class, 'getDatatable'])->name('lembaga_pemerintahan.dataTables');
	Route::resource('/lembaga_pemerintahan', LembagaPemerintahanController::class);

	Route::get('/artikel_kategori/dataTables', [ArtikelKategoriController::class, 'getDatatable'])->name('artikel_kategori.dataTables');
	Route::resource('/artikel_kategori', ArtikelKategoriController::class);

	Route::get('/artikel/dataTables', [ArtikelAdminController::class, 'getDatatable'])->name('artikel.dataTables');
	Route::resource('/artikel', ArtikelAdminController::class);

	Route::get('/profile', [UserController::class, 'profile'])->name('profile');
	Route::get('/user/dataTables', [UserController::class, 'getDatatable'])->name('user.dataTables');
	Route::get('/user/import_biodata/{id}', [UserController::class, 'importBiodata'])->name('user.import_biodata');

	Route::resource('/user', UserController::class);

	Route::get('/member/dataTables', [MemberController::class, 'getDatatable'])->name('member.dataTables');
	Route::resource('/member', MemberController::class);

	Route::get('/video/dataTables', [VideoControllerAdmin::class, 'getDatatable'])->name('video.dataTables');
	Route::resource('/video', VideoControllerAdmin::class);
});
