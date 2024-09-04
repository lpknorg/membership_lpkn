<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editable Table</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="{{asset('template/coloris/coloris.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.table td {
			padding: 0.5rem;
			position: relative;
		}
		.editable {
			display: inline-block;
			width: 100%;
		}
		.edit-input {
			width: 100%;
			border: none;
			background: transparent;
			outline: none;
			display: block;
		}
		.edit-input:focus {
			background: #f0f0f0;
			border: 1px solid #007bff;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
		}
		.placeholder {
			color: #ccc;
		}
		table thead th{
			font-weight: 600;
			font-size: 15px;
		}
		tbody tr td{
			max-width: 100px; /* Sesuaikan dengan lebar maksimum yang diinginkan */
			overflow: hidden;
			text-overflow: ellipsis; /* Menampilkan elipsis (...) jika teks terpotong */
			white-space: nowrap;
		}
		table#users-table{
			max-height:600px;
			overflow-y: auto;
			overflow-x: auto;

		}
		#users-table thead th {
			position: sticky;
			top: 0;
			z-index: 2; /* Ensure it stays on top of other content */
			background-color: #f8f9fa; /* Optional: Background color for the sticky header */
		}

		/* Custom vertical and horizontal scrollbar styles */
		.table-responsive::-webkit-scrollbar {
			width: 12px; /* Width of vertical scrollbar */
			height: 12px; /* Height of horizontal scrollbar */            
		}

		.table-responsive::-webkit-scrollbar-track {
			background: #f1f1f1; /* Track color */            
		}

		.table-responsive::-webkit-scrollbar-thumb {
			background-color: #888; /* Thumb color */
			border-radius: 10px; /* Rounded corners */
			border: 3px solid #f1f1f1; /* Optional: Add padding around thumb */
		}

		.table-responsive::-webkit-scrollbar-thumb:hover {
			background: #555; /* Hover color */
		}
	</style>
</head>
<body>
	<div class="mx-3">
		<h2 class="mb-4">Data Detail </h2>
		<a href="{{route('downloadZip', ['tipe' => 'foto_ktp', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> KTP</a>
		<a href="{{route('downloadZip', ['tipe' => 'file_sk_pengangkatan_asn', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> SK ASN</a>
		<a href="{{route('downloadZip', ['tipe' => 'foto_profile', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Pas Foto</a>
		<a href="{{\Request::url().'/excel'}}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Excel</a>
		<div class="mt-3">
			@csrf
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Data Peserta</button>
					<button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Data Peserta Terhapus</button>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<div class="card">
						<div class="card-body">
							<div>
								<div class="row">
									<div class="col-md-4">
										<div class="card">
											<div class="card-body" style="padding: 15px;">
												<div class="form-group" style="margin-bottom: 5px;">
													<label>Warna Background</label>
													<input type="text" data-coloris name="css-bg_color" class="form-control" value="#ffffff" />
												</div>
												<div class="form-group" style="margin-bottom: 5px;">
													<label style="margin-right: 53px;">Warna Teks</label>
													<input type="text" data-coloris name="css-font_color" class="form-control" value="#000000" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md">
										<div class="card">
											<div class="card-body">
												<div class="form-group" style="margin-bottom: 5px;">
													<label>Pilih Kelas DiklatOnline</label>
													<select name="id_kelas" class="form-control">
														<option value="">Pilih Kelas</option>
														@foreach($list_kelasdo as $l)
														<option value="{{$l['id']}}">{{$l['nama']}}</option>
														@endforeach
													</select>
													<span class="text-info d-block" style="display: block;font-size: 15px;margin-left: 10px;">* password default nya adalah: lpkn1234</span>
													<a href="" id="btnStoreDiklatOnline" class="btn btn-success btn-sm mt-2">Submit E-Learning</a>	
												</div>
											</div>
										</div>
									</div>
								</div>
								<a href="" id="btnHapusPeserta" class="btn btn-danger btn-sm my-2">Hapus Data</a>	
								<table class="table table-bordered table-responsive table-hover" id="users-table">
									<thead>
										<tr>
											<th><div class="form-group form-check">
												<input type="checkbox" class="form-check-input" id="allPesertaCb" style="width: 31px;height: 22px;margin-left: -24px;margin-top:0;">
											</div></th>
											<th style="min-width: 120px;">Password LKPP</th>
											<th style="min-width: 100px;">Marketing</th>
											<th style="min-width: 140px;">Keterangan</th>
											<th style="min-width: 210px;">Nama Lengkap(tanpa gelar)</th>											
											<th style="min-width: 140px;">NIK</th>
											<th style="min-width: 190px;">Email Aktif</th>
											<th style="min-width: 265px;">Nama Lengkap(dgn gelar)</th>
											<th style="min-width: 120px;">Tempat Lahir</th>
											<th style="min-width: 80px;">Tgl Lahir</th>
											<th style="min-width: 110px;">No WA</th>	
											<th style="min-width: 100px">Pas Foto</th>										
											<th style="min-width: 150px;">Pendidikan Terakhir</th>
											<th style="min-width: 210px;">Nama Pendidikan Terakhir</th>
											<th style="min-width: 150px;">Status Kepegawaian</th>
											<th style="min-width: 140px;">NIP</th>
											<th style="min-width: 80px;">NRP</th>
											<th style="min-width: 100px">SK ASN</th>
											<th style="min-width: 290px;">Nama Instansi Lengkap</th>
											<th style="min-width: 290px;">Alamat Lengkap Kantor</th>
											<th style="min-width: 150px;">Provinsi</th>
											<th style="min-width: 150px;">Kota/Kabupaten</th>
											<th style="min-width: 80px;">Kode Pos</th>
											<th style="min-width: 280px;">Posisi Pelaku Pengadaan</th>
											<th style="min-width: 290px;">Unit Organisasi</th>	
											<th style="min-width: 120px;">Jenis Jabatan</th>
											<th style="min-width: 280px;">Nama Jabatan</th>
											<th style="min-width: 120px;">Gol Terakhir</th>																																
											<th style="min-width: 570px;">Paket Kontribusi</th>
											<th style="min-width: 100px">KTP</th>											
											<th style="min-width: 125px;">Waktu Dibuat</th>
											<th style="min-width: 125px;">E-Learning LPKN</th>
											@if(strtolower(substr($list_event['event']['judul'], 0, 18)) == 'jabatan fungsional')
											<th style="min-width: 185px;">TMT Pangkat PNS Terakhir</th>
											<th style="min-width: 185px;">TMT SK JF PPBJ Terakhir</th>
											<th style="min-width: 290px;">Dok Penilaian Angka Kredit (PAK) Terakhir</th>
											@endif
											@if($list_event['event']['judul_pelatihan'] == "ppk_tipe_c")
											<th style="min-width: 150px;">Sertif PBJ Level 1</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@foreach($users as $u)
										<tr id="custom{{$u->id}}" style="background-color: {{$u->bg_color}}">
											<td>
												<div class="form-group form-check">
													<input type="checkbox" class="form-check-input" id="cb-{{$u->id}}" data-email="{{$u->userDetail->email}}"  style="width: 31px;height: 22px;margin-left: -24px;margin-top:0;">
												</div>
											</td>
											<td style="color: {{$u->font_color}};"><div data-nik="{{$u->userDetail->nik}}" class="editable" data-tipe="users" data-field="password_lkpp" data-placeholder="Click to edit">{{\Helper::passHashedDecrypt($u->userDetail->password_lkpp)}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="marketing" data-placeholder="Click to edit">{{$u->marketing}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="keterangan" data-placeholder="Click to edit">{{$u->keterangan}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="users" data-field="name" data-placeholder="Click to edit">{{ucwords(strtolower($u->userDetail->name))}}</div></td>											
											<td style="color: {{$u->font_color}};"><div data-placeholder="Click to edit" class="not-editable">{{$u->userDetail->nik}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->email}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="member" data-field="nama_lengkap_gelar" data-placeholder="Click to edit">{{$u->userDetail->member->nama_lengkap_gelar}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tempat_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tempat_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tgl_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tgl_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="no_hp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->no_hp}}</div></td>	
											<td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>									
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="nama_pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->nama_pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="status_kepegawaian" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->status_kepegawaian}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nip" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nip}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nrp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nrp}}</div></td>
											<td>
												@if($u->userDetail->member->file_sk_pengangkatan_asn)
												<a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_instansi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_instansi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="alamat_kantor_lengkap" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</div></td>
											<td><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->member->prov_id ? $u->userDetail->member->alamatProvinsi->nama : '-'}}</div></td>
											<td><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->member->kota_id ? $u->userDetail->member->alamatKota->kota : '-'}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="kode_pos" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->kode_pos}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="posisi_pelaku_pengadaan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="unit_organisasi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->unit_organisasi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="jenis_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->jenis_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="golongan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->golongan_terakhir}}</div></td>																						
											<td style="color: {{$u->font_color}};"><div data-tipe="user_event" data-field="paket_kontribusi" class="editable" data-placeholder="Click to edit">{{$u->paket_kontribusi}}</div></td>								
											<td>
												@if($u->userDetail->member->foto_ktp)	
												<a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											
											<td>{{\Helper::changeFormatDate($u->created_at, 'd-m-Y H:i:s')}}</td>
											<td>{{$u->learning_lpkn}}</td>

											@if(strtolower(substr($list_event['event']['judul'], 0, 18)) == 'jabatan fungsional')
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tmt_pangkat_pns_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tmt_pangkat_pns_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tmt_sk_jf_pbj_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tmt_sk_jf_pbj_terakhir}}</div></td>
											<td>
												@if($u->userDetail->member->file_penilaian_angka_kredit_terakhir)	
												<a href="{{\Helper::showImage($u->userDetail->member->file_penilaian_angka_kredit_terakhir, 'file_penilaian_angka_kredit_terakhir')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											@endif
											@if($list_event['event']['judul_pelatihan'] == "ppk_tipe_c")
											<td>
												@if($u->userDetail->member->file_sertifikat_pbj_level1)	
												<a href="{{\Helper::showImage($u->userDetail->member->file_sertifikat_pbj_level1, 'file_sertifikat_pbj_level1')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											@endif
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<div class="card">
						<div class="card-body">
							<a href="" id="btnPulihkanPeserta" class="btn btn-success btn-sm mb-2">Pulihkan Data</a>
							<table class="table table-bordered table-responsive table-hover" id="users-table2">
								<thead>
									<tr>
										<th></th>
										<th style="min-width: 120px;">Password LKPP</th>
										<th style="min-width: 100px;">Marketing</th>
										<th style="min-width: 140px;">Keterangan</th>
										<th style="min-width: 210px;">Nama Lengkap(tanpa gelar)</th>
										<th style="min-width: 265px;">Nama Lengkap(dgn gelar)</th>
										<th style="min-width: 140px;">NIK</th>
										<th style="min-width: 190px;">Email Aktif</th>
										<th style="min-width: 120px;">Tempat Lahir</th>
										<th style="min-width: 80px;">Tgl Lahir</th>
										<th style="min-width: 110px;">No WA</th>	
										<th style="min-width: 100px">Pas Foto</th>										
										<th style="min-width: 150px;">Pendidikan Terakhir</th>
										<th style="min-width: 210px;">Nama Pendidikan Terakhir</th>
										<th style="min-width: 150px;">Status Kepegawaian</th>
										<th style="min-width: 140px;">NIP</th>
										<th style="min-width: 80px;">NRP</th>
										<th style="min-width: 100px">SK ASN</th>
										<th style="min-width: 290px;">Nama Instansi Lengkap</th>
										<th style="min-width: 290px;">Alamat Lengkap Kantor</th>
										<th style="min-width: 150px;">Provinsi</th>
										<th style="min-width: 150px;">Kota/Kabupaten</th>
										<th style="min-width: 80px;">Kode Pos</th>
										<th style="min-width: 280px;">Posisi Pelaku Pengadaan</th>
										<th style="min-width: 290px;">Unit Organisasi</th>	
										<th style="min-width: 120px;">Jenis Jabatan</th>
										<th style="min-width: 280px;">Nama Jabatan</th>
										<th style="min-width: 120px;">Gol Terakhir</th>																																
										<th style="min-width: 570px;">Paket Kontribusi</th>											
										<th style="min-width: 100px">KTP</th>											
										<th style="min-width: 125px;">Waktu Dibuat</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users_deleted as $u)
									<tr id="custom{{$u->id}}" style="background-color: {{$u->bg_color}}">
										<td>
											<div class="form-group form-check">
												<input type="checkbox" class="form-check-input" id="cb-{{$u->id}}" data-email="{{$u->userDetail->email}}">
											</div>
										</td>
										<td style="color: {{$u->font_color}};"><div data-nik="{{$u->userDetail->nik}}" class="editable" data-tipe="users" data-field="password_lkpp" data-placeholder="Click to edit">{{\Helper::passHashedDecrypt($u->userDetail->password_lkpp)}}</div></td>
										<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="marketing" data-placeholder="Click to edit">{{$u->marketing}}</div></td>
										<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="keterangan" data-placeholder="Click to edit">{{$u->keterangan}}</div></td>
										<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="users" data-field="name" data-placeholder="Click to edit">{{ucwords(strtolower($u->userDetail->name))}}</div></td>
										<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="member" data-field="nama_lengkap_gelar" data-placeholder="Click to edit">{{$u->userDetail->member->nama_lengkap_gelar}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-placeholder="Click to edit" class="not-editable">{{$u->userDetail->nik}}</div></td>
										<td style="color: {{$u->font_color}};"><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->email}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tempat_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tempat_lahir}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tgl_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tgl_lahir}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="no_hp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->no_hp}}</div></td>	
										<td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->pendidikan_terakhir}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="nama_pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->nama_pendidikan_terakhir}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="status_kepegawaian" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->status_kepegawaian}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nip" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nip}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nrp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nrp}}</div></td>
										<td>
											@if($u->userDetail->member->file_sk_pengangkatan_asn)
											<a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
											@else
											-
											@endif
										</td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_instansi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_instansi}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="alamat_kantor_lengkap" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</div></td>
										<td><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->member->prov_id ? $u->userDetail->member->alamatProvinsi->nama : '-'}}</div></td>
										<td><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->member->kota_id ? $u->userDetail->member->alamatKota->kota : '-'}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="kode_pos" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->kode_pos}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="posisi_pelaku_pengadaan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="unit_organisasi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->unit_organisasi}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="jenis_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->jenis_jabatan}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_jabatan}}</div></td>
										<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="golongan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->golongan_terakhir}}</div></td>																																	
										<td style="color: {{$u->font_color}};"><div>{{$u->paket_kontribusi}}</div></td>
										
										<td>
											@if($u->userDetail->member->foto_ktp)	
											<a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
											@else
											-
											@endif
										</td>											
										<td>{{\Helper::changeFormatDate($u->created_at, 'd-m-Y H:i:s')}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<!-- jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{asset('template/coloris/coloris.min.js')}}"></script>
	<script>
		$(document).ready(function(){

			Coloris({
				format: 'hex',
				selectInput: true,
				swatchesOnly: true,
				swatches: [
					'#FFFFFF',
					'#ef838a',
					'#fad050',
					'#fafa75',
					'#92D050',
					'#99d4e8',
					'#6a9fc4',
					'#000000'
					]
			})
			function rgbStringToHex(rgb) {
				var result = rgb.match(/\d+/g);
				if (result.length !== 3) {
					throw new Error("Format RGB tidak valid");
				}

				var r = parseInt(result[0]);
				var g = parseInt(result[1]);
				var b = parseInt(result[2]);

				return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
			}

			function componentToHex(c) {
				var hex = c.toString(16);
				return hex.length == 1 ? "0" + hex : hex;
			}

			$('body').on('change', 'input[type="checkbox"][id^="cb-"]', function() {
				if ($(this).is(':checked')) {
					var parentTR = $(this).closest('tr');
					var nextTD = $(this).closest('td').next('td');
					parentTR = parentTR.attr('style')
					nextTD 	 = nextTD.attr('style')
					var bgColor = parentTR.match(/background-color:\s*([^;]+)/)[1];
					var fontColor = nextTD.match(/color:\s*([^;]+)/)[1];

					if (bgColor.substr(0,3) == 'rgb') {
						bgColor = rgbStringToHex(bgColor)
					}
					if (fontColor.substr(0,3) == 'rgb') {
						fontColor = rgbStringToHex(fontColor)
					}

					$('input[name="css-bg_color"]').prevAll('button').first().css('color', bgColor)
					$('input[name="css-font_color"]').prevAll('button').first().css('color', fontColor)


					$('[name=css-bg_color]').val(bgColor)
					$('[name=css-font_color]').val(fontColor)
				}
			});
			$('body').on('change', 'input[type="checkbox"][id="allPesertaCb"]', function() {
				if ($(this).is(':checked')) {
					$('#users-table input[type="checkbox"][id^="cb-"]').prop('checked', true);
				}else{
					$('#users-table input[type="checkbox"][id^="cb-"]').prop('checked', false);
				}
			})
			$('body').on('click', '[id=btnStoreDiklatOnline]', function(e) {
				e.preventDefault()
				var idArr = []
				var emailArr = []
				var id_kelas = $('[name=id_kelas]').find(":selected").val()
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){

					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					idArr.push(id)
					emailArr.push($(this).attr('data-email'))
				})
				if (idArr.length < 1) {
					alert('Minimal checklist 1 row pada table')
					return
				}
				if (id_kelas == '') {
					alert('Pilih kelas terlebih dahulu')
					return
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});
				$.ajax({
					type: 'post',
					url: '{{url('import_member')}}' + '/store_diklat_online',
					data: {emailArr, id_kelas, idArr},
					dataType: 'json',
					beforeSend: function(){
						$('#btnStoreDiklatOnline').attr('disabled', true).css('cursor', 'not-allowed').text('Load ...')
					},
					success: function(data) {
						console.log(data)
						if (data.status == "ok") {
							toastr.success(data.messages, 'Berhasil');
						}
					},
					error: function(data) {
						var data = data.responseJSON;
						if (data.status == "fail") {
							toastr.error(data.messages, 'Error');
						}else{
							toastr.error('Terdapat kesalahan saat submit ke diklat online', 'Error');
						}
					},
					complete: function(){
						$('#btnStoreDiklatOnline').attr('disabled', false).css('cursor', 'pointer').text('Submit')
					}
				});
				console.log(emailArr)
			})
			$('body').on('click', '[id=btnHapusPeserta]', function(e) {
				e.preventDefault()
				deleteRestoreData()
			})
			$('body').on('click', '[id=btnPulihkanPeserta]', function(e) {
				e.preventDefault()
				deleteRestoreData(0)
			})

			function deleteRestoreData(is_deleted=1){
				var idArr = []
				var emailArr = []
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){

					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					idArr.push(id)
					emailArr.push($(this).attr('data-email'))
				})
				if (idArr.length < 1) {
					alert('Minimal checklist 1 row pada table')
					return
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});

				$.ajax({
					type: 'post',
					url: '{{url("import_member/delete_peserta")}}',
					data: {
						idArr,
						is_deleted,
						emailArr,
						id_event: '{{$id_event}}'
					},
					dataType: 'json',
					beforeSend: function(){
						if (is_deleted == 1) {
							$('#btnHapusPeserta').attr('disabled', true).css('cursor', 'not-allowed').text('Load ...')
						}else{
							$('#btnPulihkanPeserta').attr('disabled', true).css('cursor', 'not-allowed').text('Load ...')
						}
					},
					success: function(data) {
						console.log(data)
						toastr.success(data.messages, 'Berhasil');
						setTimeout(() => {
							location.reload()
						}, 200)
					},
					error: function(data) {
						console.log(data)
					},
					complete: function(){
						if (is_deleted == 1) {
							$('#btnHapusPeserta').attr('disabled', false).css('cursor', 'cursor').text('Hapus Data')
						}else{
							$('#btnPulihkanPeserta').attr('disabled', false).css('cursor', 'cursor').text('Pulihkan Data')
						}
					}
				});
			}
			$('body').on('input', '[name=css-bg_color]', function(e) {
				let _val = $(this).val()
				var arrBgColor = []
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					arrBgColor.push(id)
					$('input[name="css-bg_color"]').prevAll('button').first().css('color', _val)
					$(`#custom${id}`).css('background-color', _val)
				})
				if (arrBgColor.length < 1) {
					alert('Minimal checklist 1 row pada table untuk melakukan perubahan warna background')
					return
				}
				let sendCssData = {
					color 	   : $(this).val(),
					idArr      : arrBgColor,
					tipe       : 'background-color'
				}
				updateCss(sendCssData)
			})
			$('body').on('input', '[name=css-font_color]', function(e) {
				let _val = $(this).val()
				var arrFontColor = []
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');					
					arrFontColor.push(id)
					$(`#custom${id} td`).css('color', _val)
					$('input[name="css-font_color"]').prevAll('button').first().css('color', _val)
				});				
				if (arrFontColor.length < 1) {
					alert('Minimal checklist 1 row pada table untuk melakukan perubahan warna teks')
					return
				}
				let sendCssData = {
					color 	   : $(this).val(),
					idArr      : arrFontColor,
					tipe       : 'font-color'
				}
				updateCss(sendCssData)
			})
			function updateCss(form_data){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});

				$.ajax({
					type: 'post',
					url: '{{url("import_member/update_css")}}' + `/${form_data.tipe}` ,
					data: form_data,
					dataType: 'json',
					success: function(data) {
						console.log(data)
					},
					error: function(data) {
						console.log(data)
					}
				});
			}
			function updateData(form_data){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});

				$.ajax({
					type: 'post',
					url: '{{url('import_member')}}' + `/${form_data.nik}/store` ,
					data: form_data,
					dataType: 'json',
					success: function(data) {
						console.log(data)
						if (data.status == "ok") {
							toastr.success(data.messages, 'Berhasil');
						}
					},
					error: function(data) {
						console.log(data)
						var data = data.responseJSON;
						if (data.status == "fail") {
							toastr.error(data.messages, 'Error');
						}else{
							// toastr.error('Terdapat kesalahan saat update data', 'Error');
						}
					}
				});
			}
			var table = $('#users-table').DataTable({
				"columnDefs": [
                    { "orderable": false, "targets": 0 } // Menonaktifkan sorting pada kolom pertama
                    ],
				"pageLength": 100,
			})
			var table2 = $('#users-table2').DataTable({
				"pageLength": 50
			})
			$('body').on('dblclick', '[class=not-editable]', function(e) {
				var range = document.createRange();
				range.selectNodeContents(this);
				var selection = window.getSelection();
				selection.removeAllRanges();
				selection.addRange(range);
				var textToCopy = $(this).text().trim();

				try {
					document.execCommand('copy');
					toastr.success(`Berhasil salin teks ${textToCopy}`, 'Berhasil');
				} catch (err) {
					console.log('Whoops, teks gagal disalin');
				}
			})
			$('.editable').each(function(){
				var $this = $(this);
				var placeholder = $this.data('placeholder');

				$this.attr('contenteditable', true);
				$this.addClass('edit-input');

				if($this.text().trim() === ''){
					$this.text(placeholder).addClass('placeholder');
				}

				$this.on('focus', function(){
					if($this.text() === placeholder){
						$this.text('').removeClass('placeholder');
					}
					$this.parent().addClass('editing');
				}).on('blur', function(){
					if($this.text().trim() === ''){
						$this.text(placeholder).addClass('placeholder');
					}
					// if(typeof($this.attr('data-is_alamat')) !== "undefined"){
					// 	let fixalamat = $this.attr('data-is_alamat').substr(0, 15)+'...'
					// 	$this.text(fixalamat)
					// }
					var _tipe = $this.data('tipe')
					var _field = $this.data('field')
					var _nik = $(this).closest('tr').find('div[data-nik]').data('nik');
					let sendData = {
						nik        : _nik,
						tipe       : _tipe,
						nama_field : _field,
						isi_field  : $this.text(),
						id_event   : '{{$id_event}}'
					}
					updateData(sendData)	
					$this.parent().removeClass('editing');					
				}).on('dblclick', function(){
					var range = document.createRange();
					range.selectNodeContents(this);
					var selection = window.getSelection();
					selection.removeAllRanges();
					selection.addRange(range);
					var textToCopy = $this.text().trim();

					try {
						document.execCommand('copy');
						toastr.success(`Berhasil salin teks ${textToCopy}`, 'Berhasil');
					} catch (err) {
						console.log('Whoops, teks gagal disalin');
					}
				});
			});
		});
	</script>
</body>
</html>
