<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editable Table</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
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
							<div class="table-responsive">
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label>Warna Background</label>
											<input type="color" name="css-bg_color" class="form-control" value="#ffffff" />
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>Warna Teks</label>
											<input type="color" name="css-font_color" class="form-control" value="#000000" />
										</div>
									</div>
								</div>
								<a href="" id="btnHapusPeserta" class="btn btn-danger btn-sm mb-2">Hapus Data</a>	
								<table class="table table-bordered table-hover" id="users-table">
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
											<th style="min-width: 110px;">No WA</th>
											<th style="min-width: 120px;">Tempat Lahir</th>
											<th style="min-width: 80px;">Tgl Lahir</th>
											<th style="min-width: 150px;">Pendidikan Terakhir</th>
											<th style="min-width: 210px;">Nama Pendidikan Terakhir</th>
											<th style="min-width: 150px;">Status Kepegawaian</th>
											<th style="min-width: 280px;">Posisi Pelaku Pengadaan</th>
											<th style="min-width: 120px;">Jenis Jabatan</th>
											<th style="min-width: 280px;">Nama Jabatan</th>
											<th style="min-width: 120px;">Gol Terakhir</th>
											<th style="min-width: 140px;">NIP</th>
											<th style="min-width: 80px;">NRP</th>
											<th style="min-width: 290px;">Nama Instansi Lengkap</th>
											<th style="min-width: 290px;">Unit Organisasi</th>
											<th style="min-width: 290px;">Alamat Lengkap Kantor</th>
											<th style="min-width: 80px;">Kode Pos</th>
											<th style="min-width: 570px;">Paket Kontribusi</th>
											<th style="min-width: 100px">Pas Foto</th>
											<th style="min-width: 100px">KTP</th>
											<th style="min-width: 100px">SK ASN</th>
											<th style="min-width: 125px;">Waktu Dibuat</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $u)
										<tr id="custom{{$u->id}}" style="background-color: {{$u->bg_color}}">
											<td>
												<div class="form-group form-check">
													<input type="checkbox" class="form-check-input" id="cb-{{$u->id}}" data-email="{{$u->userDetail->email}}">
												</div>
											</td>
											<td style="color: {{$u->font_color}};"><div data-nik="{{$u->userDetail->nik}}" class="editable" data-tipe="users" data-field="password_lkpp" data-placeholder="Click to edit">{{\Helper::passHashedDecrypt($u->userDetail->password_lkpp)}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="marketing" data-placeholder="Click to edit">{{$u->marketing}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="user_event" data-field="keterangan" data-placeholder="Click to edit">{{$u->keterangan}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="users" data-field="name" data-placeholder="Click to edit">{{$u->userDetail->name}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="member" data-field="nama_lengkap_gelar" data-placeholder="Click to edit">{{$u->userDetail->member->nama_lengkap_gelar}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-placeholder="Click to edit" class="not-editable">{{$u->userDetail->nik}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->email}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="no_hp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->no_hp}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tempat_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tempat_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tgl_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tgl_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="nama_pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->nama_pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="status_kepegawaian" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->status_kepegawaian}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="posisi_pelaku_pengadaan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="jenis_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->jenis_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="golongan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->golongan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nip" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nip}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nrp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nrp}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_instansi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_instansi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="unit_organisasi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->unit_organisasi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="alamat_kantor_lengkap" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="kode_pos" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->kode_pos}}</div></td>
											<td style="color: {{$u->font_color}};"><div>{{$u->paket_kontribusi}}</div></td>
											<td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>
											<td>
												@if($u->userDetail->member->foto_ktp)	
												<a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											<td>
												@if($u->userDetail->member->file_sk_pengangkatan_asn)
												<a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
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
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<a href="" id="btnPulihkanPeserta" class="btn btn-success btn-sm mb-2">Pulihkan Data</a>
								<table class="table table-bordered table-hover" id="users-table2">
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
											<th style="min-width: 110px;">No WA</th>
											<th style="min-width: 120px;">Tempat Lahir</th>
											<th style="min-width: 80px;">Tgl Lahir</th>
											<th style="min-width: 150px;">Pendidikan Terakhir</th>
											<th style="min-width: 210px;">Nama Pendidikan Terakhir</th>
											<th style="min-width: 150px;">Status Kepegawaian</th>
											<th style="min-width: 280px;">Posisi Pelaku Pengadaan</th>
											<th style="min-width: 120px;">Jenis Jabatan</th>
											<th style="min-width: 280px;">Nama Jabatan</th>
											<th style="min-width: 120px;">Gol Terakhir</th>
											<th style="min-width: 140px;">NIP</th>
											<th style="min-width: 80px;">NRP</th>
											<th style="min-width: 290px;">Nama Instansi Lengkap</th>
											<th style="min-width: 290px;">Unit Organisasi</th>
											<th style="min-width: 290px;">Alamat Lengkap Kantor</th>
											<th style="min-width: 80px;">Kode Pos</th>
											<th style="min-width: 570px;">Paket Kontribusi</th>
											<th style="min-width: 100px">Pas Foto</th>
											<th style="min-width: 100px">KTP</th>
											<th style="min-width: 100px">SK ASN</th>
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
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="users" data-field="name" data-placeholder="Click to edit">{{$u->userDetail->name}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="editable" data-tipe="member" data-field="nama_lengkap_gelar" data-placeholder="Click to edit">{{$u->userDetail->member->nama_lengkap_gelar}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-placeholder="Click to edit" class="not-editable">{{$u->userDetail->nik}}</div></td>
											<td style="color: {{$u->font_color}};"><div class="not-editable" data-placeholder="Click to edit">{{$u->userDetail->email}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="no_hp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->no_hp}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tempat_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tempat_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="tgl_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tgl_lahir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member" data-field="nama_pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->nama_pendidikan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="status_kepegawaian" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->status_kepegawaian}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="posisi_pelaku_pengadaan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="jenis_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->jenis_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_jabatan}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="golongan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->golongan_terakhir}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nip" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nip}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="users" data-field="nrp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nrp}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="nama_instansi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_instansi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="unit_organisasi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->unit_organisasi}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="alamat_kantor_lengkap" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</div></td>
											<td style="color: {{$u->font_color}};"><div data-tipe="member_kantor" data-field="kode_pos" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->kode_pos}}</div></td>
											<td style="color: {{$u->font_color}};"><div>{{$u->paket_kontribusi}}</div></td>
											<td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>
											<td>
												@if($u->userDetail->member->foto_ktp)	
												<a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
												@else
												-
												@endif
											</td>
											<td>
												@if($u->userDetail->member->file_sk_pengangkatan_asn)
												<a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
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
	</div>

	<!-- jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function(){
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
							// location.reload()
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
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					$(`#custom${id}`).css('background-color', _val)
				})
			})
			$('body').on('blur', '[name=css-bg_color]', function(e) {
				var arrBgColor = []
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){

					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					arrBgColor.push(id)
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
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					$(`#custom${id} td`).css('color', _val)
				});				
			})
			$('body').on('blur', '[name=css-font_color]', function(e) {
				var arrFontColor = []
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){

					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					arrFontColor.push(id)
				})
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
				"pageLength": 50
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
