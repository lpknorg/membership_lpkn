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
	DashboardController,
	FormPesertaController,
	ViewMemberController
};
use App\Http\Controllers\Artikel\{
	ArtikelController,
	ArtikelKomentarController,
	ArtikelLikeController
};
use Illuminate\Http\Request;

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
use App\Jobs\PersonJob2;
use Faker\Factory;
Route::get('ea', function(Request $request){
	$gambar = 'https://drive.google.com/open?id=1eERqq8o_u4n5zLVop8hokxpBvajsBEfC';
	return \Helper::downloadImageFromGoogleDrive($gambar, 'test_download');
});

// Route::resource('form_peserta', FormPesertaController::class);
Route::get('/form_peserta/{id}', [App\Http\Controllers\FormPesertaController::class, 'create'])->name('form_peserta.create');
Route::get('/form_peserta_ajax/{id}', [App\Http\Controllers\FormPesertaController::class, 'createAjax'])->name('form_peserta.createAjax');
Route::get('/form_peserta/{id}/list_peserta', [App\Http\Controllers\FormPesertaController::class, 'index'])->name('form_peserta.index');
Route::post('/form_peserta_store_online', [App\Http\Controllers\FormPesertaController::class, 'storeOnline'])->name('form_peserta_store_online');
Route::post('/form_peserta_store_tatapmuka', [App\Http\Controllers\FormPesertaController::class, 'storeTatapMuka'])->name('form_peserta_store_tatapmuka');


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

Route::view('notification', 'notification')->name('notification');


Auth::routes();

Route::get('/home', function(){
	return redirect('/');
});
Route::get('/download_file/{file}/{folder?}', [HomeController::class, 'downloadFile'])->name('downloadFile');
// Route::view('dashboard', 'dashboard');

Route::group(['prefix' => 'dashboard2', 'as' => 'dashboard2.', 'middleware' => 'auth'], function () {
	Route::get('/download_files/{id_user}/{folder}/{file}', [HomeController::class, 'downloadFiles'])->name('downloadFiles');
	Route::get('/', [DashboardController::class, 'index2'])->name('index');
	Route::get('/lulus_pbj', [DashboardController::class, 'lulusPbj'])->name('lulusPbj');
	Route::get('resp_tahun', [DashboardController::class, 'responseByBulan'])->name('responseByBulan');
	Route::get('/event_gratis', [DashboardController::class, 'eventGratis'])->name('eventGratis');
	Route::get('/dataTableEvent', [DashboardController::class, 'dataTableEvent'])->name('dataTableEvent');
	Route::get('/dataTableEventGratis', [DashboardController::class, 'dataTableEventGratis'])->name('dataTableEventGratis');
	Route::get('/exportExcelEvent/{tipe}', [DashboardController::class, 'exportExcelEvent'])->name('exportExcelEvent');
	Route::get('/exportExcelAlumniByEvent/{tipe}', [DashboardController::class, 'exportExcelAlumniByEvent'])->name('exportExcelAlumniByEvent');
	Route::get('/exportAlumniRegis', [DashboardController::class, 'exportAlumniRegis'])->name('exportAlumniRegis');
	Route::get('/detail_alumni/{name}', [DashboardController::class, 'detailAlumni'])->name('detail_alumni');
	Route::get('/event_user_list_datatable', [DashboardController::class, 'getUserByIdEventDatatable'])->name('get_user_by_event_datatable');
	// Route::view('event_user_list/{id}', 'admin.dashboard2.alumni_by_event')->name('get_user_by_event');
	Route::get('/event_user_list/{id_event}', [DashboardController::class, 'getUserByIdEvent'])->name('get_user_by_event');
	Route::get('/event_user_list_gratis/{id_events_gratis}', [DashboardController::class, 'getUserByIdEventGratis'])->name('get_user_by_event_gratis');
});
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
	Route::get('/{uname}/{slug}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
	Route::post('/artikel/update/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
	Route::get('/artikel/delete/{id}', [ArtikelController::class, 'delete'])->name('artikel.delete');
});
Route::get('member_profile/page/get_event/{id_eventt}', [ProfileController::class, 'getEventModal'])->name('member_profile.get_event.modal');
Route::get('member_profile/page/get_video_materi/{slug}', [ProfileController::class, 'getVideoMateri'])->name('member_profile.get_video_materi');
Route::group(['prefix' => 'member_profile', 'as' => 'member_profile.', 'middleware' => 'auth'], function () {
	Route::get('/', [ProfileController::class, 'index'])->name('index');	
	Route::post('/page/regis_event', [ProfileController::class, 'regisEvent'])->name('regis_event');
	Route::post('/page/upload_bukti', [ProfileController::class, 'uploadBukti'])->name('upload_bukti');
	Route::get('/edit_profile', [ProfileController::class, 'editProfile'])->name('edit_profile');
	Route::get('/edit_password', [ProfileController::class, 'editPassword'])->name('edit_password');
	Route::post('/update_password', [ProfileController::class, 'updatePassword'])->name('update_password');
	Route::post('/update_profile', [ProfileController::class, 'updateProfile'])->name('update_profile');
	Route::post('/add_sosial_media', [ProfileController::class, 'storeSosialMedia'])->name('store_sosial_media');
	Route::post('/remove_sosial_media', [ProfileController::class, 'deleteSosialMedia'])->name('delete_sosial_media');
	Route::post('/add_sertifikat', [ProfileController::class, 'storeSertifikat'])->name('store_sertifikat');
	Route::post('/remove_sertifikat', [ProfileController::class, 'deleteSertifikat'])->name('delete_sertifikat');
	Route::post('/update_fotoprofile', [ProfileController::class, 'updateFotoProfile'])->name('update_fotoprofile');

	Route::get('/menunggu_pembayaran', [MenungguPembayaranController::class, 'index'])->name('menunggu_pembayaran.index');

	Route::get('/event_kamu', [EventKamuController::class, 'index'])->name('event_kamu.index');
	Route::post('/event_kamu/transfer_event', [EventKamuController::class, 'transferEvent'])->name('event_kamu.transferEvent');
	Route::post('/testimoni', [EventKamuController::class, 'storeTestimoni'])->name('testimoni.storeTestimoni');

	Route::get('/sertifikat_kamu', [SertifikatKamuController::class, 'index'])->name('sertifikat_kamu.index');

	// Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi.index');
	Route::post('/get_artikel', [DokumentasiController::class, 'get_artikel'])->name('dokumentasi.get_artikel');
	// Route::post('/count', [DokumentasiController::class, 'count'])->name('dokumentasi.count');

	Route::get('/voucher', [VoucherController::class, 'index'])->name('voucher.index');
	Route::get('/voucher2', [VoucherController::class, 'index2'])->name('voucher.index2');	
});
Route::get('member_profile/Kta', [ProfileController::class, 'download_kta'])->name('member_profile.download_kta');


Route::group(['middleware' => ['auth', 'role:panitia|admin']], function () {
	Route::get('/import_member', [HomeController::class, 'viewImportMember']);
	Route::get('/download_zip/{tipe}/{id_event}', [ViewMemberController::class, 'downloadZip'])->name('downloadZip');
	Route::get('/import_member/{id_event}', [ViewMemberController::class, 'viewByEvent']);
	Route::post('/import_member/{id_event}/import_pdf_lkpp', [ViewMemberController::class, 'importPdfLkpp']);
	Route::post('/import_member/{id_event}/import_denah_lkpp', [ViewMemberController::class, 'convertDenahUjian']);
	Route::post('/import_member/delete_peserta', [ViewMemberController::class, 'deletePeserta']);
	Route::post('/import_member/store_diklat_online', [ViewMemberController::class, 'storeToDiklatOnline']);
	Route::get('/import_member/{id_event}/excel_peserta', [ViewMemberController::class, 'downloadExcelByEvent']);
	Route::get('/import_member/{id_event}/excel_to', [ViewMemberController::class, 'downloadExcelTo']);
	Route::get('/import_member/{id_event}/presensi_pelatihan', [ViewMemberController::class, 'downloadPresensiPelatihan']);
	Route::post('/import_member/{nik}/store', [ViewMemberController::class, 'updateDataMember']);
	Route::post('/import_member/{user_id}/update', [ViewMemberController::class, 'updateDataMemberKredens']);
	Route::post('/import_member/update_css/{tipe}', [ViewMemberController::class, 'updateCss']);
	Route::post('/import_member', [HomeController::class, 'importMember']);
	Route::get('/import_member_datatable', [HomeController::class, 'importMemberDatatable']);
	Route::get('/import_member2', [HomeController::class, 'importMember2']);
});

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

	Route::get('/user/exportExcelAlumni', [UserController::class, 'exportExcelAlumni'])->name('user.exportExcelAlumni');

	Route::get('/user/dataTables', [UserController::class, 'getDatatable'])->name('user.dataTables');
	Route::get('/user/import_biodata/{id}', [UserController::class, 'importBiodata'])->name('user.import_biodata');

	Route::resource('/user', UserController::class);

	Route::get('/member/dataTables', [MemberController::class, 'getDatatable'])->name('member.dataTables');
	Route::resource('/member', MemberController::class);

	Route::get('/video/dataTables', [VideoControllerAdmin::class, 'getDatatable'])->name('video.dataTables');
	Route::resource('/video', VideoControllerAdmin::class);
});
