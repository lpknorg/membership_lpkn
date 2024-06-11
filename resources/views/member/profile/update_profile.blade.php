@extends('member.layouts.template')
@section('content')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
	.text-warning{
		color: #f5943d!important;
	}
</style>
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Update Profile Member
	</h5>
	<form method="POST" action="{{route('member_profile.update_profile')}}" id="formUpdateProfile">
		@csrf
		<input type="hidden" value="{{$user->id}}" name="id_user">
		<h4><b> Data Pribadi</b></h4>
		<hr class="mb-2 mt-0">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>NIP/NRP</label>
					<input type="number" class="form-control" name="nip" value="{{$user->nip}}">
					<span><small class="text-warning">Non PNS siliahkan isi 0</small></span>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>NIK</label>
					<input type="number" class="form-control" name="nik" value="{{$user->nik}}">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Pendidikan Terakhir</label>
					<select class="form-control" name="pendidikan_terakhir">
						<?php $arr = ['SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2']; ?>
						<option value="">Pilih Pendidikan Terakhir</option>
						@foreach($arr as $k => $v)
						<option value="{{$v}}" {{$v == $user->member->pendidikan_terakhir ? 'selected' : ''}}>{{$v}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nama Lengkap tanpa gelar</label>
					<input type="text" class="form-control" name="nama_tanpa_gelar" value="{{$user->name}}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nama Lengkap beserta gelar</label>
					<input type="text" class="form-control" name="nama_dengan_gelar" value="{{$user->member->nama_lengkap_gelar}}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nama Untuk Serifikat</label>
					<input type="text" class="form-control" name="nama_untuk_sertifikat" value="{{$user->member->nama_untuk_sertifikat}}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nomor HP</label>
					<input type="text" class="form-control" name="no_hp" value="{{$user->member->no_hp}}">
					<span><small class="text-warning">Nomor HP harus memiliki whatsapp</small></span>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" class="form-control" name="tempat_lahir" value="{{$user->member->tempat_lahir}}">
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" class="form-control" name="tgl_lahir" value="{{$user->member->tgl_lahir}}">
				</div>
			</div>
			<div class="col-sm-4">
				<label>Jenis Kelamin</label>
				<select class="form-control" name="jenis_kelamin">
					<option value="">Pilih Jenis Kelamin</option>
					<option value="P" {{$user->member->jenis_kelamin == 'P' ? 'selected' : ''}}>Perempuan</option>
					<option value="L" {{$user->member->jenis_kelamin == 'L' ? 'selected' : ''}}>Laki-Laki</option>
				</select>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Alamat Rumah Lengkap</label>
					<textarea type="textarea" class="form-control" name="alamat_lengkap_rumah"
					placeholder="Contoh: Gang Nangka Rt.02 Rw.01 No.45" rows="3">{{$user->member->alamat_lengkap}}</textarea>
				</div>
			</div>
			<div class="col-sm-3">
				<label>Provinsi</label>
				<select class="form-control" name="rumah_provinsi">
					<option value="">Pilih Provinsi</option>
					@foreach($provinsi as $p)
					<option value="{{$p->id}}">{{$p->nama}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kota/Kabupaten</label>
				<select class="form-control" name="rumah_kota" disabled>
					<option value="">Pilih Kota</option>
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kecamatan</label>
				<select class="form-control" name="rumah_kecamatan" disabled>
					<option value="">Pilih Kecamatan</option>
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kelurahan</label>
				<select class="form-control" name="rumah_kelurahan" disabled>
					<option value="">Pilih Kelurahan</option>
				</select>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Deskripsikan diri anda</label>
					<textarea type="textarea" class="form-control" name="deskripsi_diri"
					placeholder="Deskripsikan diri Anda lebih lanjut (hobi/kepribadian/topik konten favorit/dsb)" rows="3">{{$user->deskripsi_diri}}</textarea>
				</div>
			</div>
		</div>
		<br>
		<h4><b> Data Kantor</b></h4>
		<hr class="mb-2 mt-0">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Status Kepegawaian</label>
					<?php $arr = ['PNS', 'SWASTA', 'TNI/POLRI', 'BUMN/BUMD', 'HONORER / KONTRAK', 'ASN', 'Lainnya']; ?>
					<select class="form-control" name="status_kepegawaian">
						<option value="">Pilih Status Kepegawaian</option>
						@foreach($arr as $k => $v)
						<option value="{{$v}}" {{$v == $user->member->memberKantor->status_kepegawaian ? 'selected' : ''}}>{{$v}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4" id="div-bumn" style="display: {{$user->member->memberKantor->status_kepegawaian == 'BUMN/BUMD' ? 'block' : 'none';}};">
				<div class="form-group">
					<label>Instansi</label>
					<select name="instansi" class="form-control">
						<option value="">Pilih Instansi</option>
						@foreach($instansi as $i)
						<option value="{{$i->id}}" {{$i->id == $user->member->memberKantor->instansi_id ? 'selected' : ''}}>{{$i->nama}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4" id="div-bumn" style="display: {{$user->member->memberKantor->status_kepegawaian == 'BUMN/BUMD' ? 'block' : 'none';}};">
				<div class="form-group">
					<label>Lembaga Pemerintahan</label>
					<select name="lembaga_pemerintahan" class="form-control">
						<option value="">Pilih Lembaga Pemerintahan</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4" id="div-dll" style="display: {{$user->member->memberKantor->status_kepegawaian == 'Lainnya' ? 'block' : 'none';}};">
				<div class="form-group">
					<label>Pekerjaan Lainnya</label>
					<input type="text" class="form-control" name="pekerjaan_lainnya" value="{{$user->member->memberKantor->kategori_pekerjaan_lainnya}}">
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-sm-4">
				<div class="form-group">
					<label>Posisi Pelaku Pengadaan</label>
					<select class="form-control" name="posisi_pelaku_pengadaan">
						<?php $arr = ['PA (Pengguna Anggaran)','KPA (Kuasa Pengguna Anggaran)','PPK (Pejabat Pembuat Komitmen)','Pejabat Pengadaan','Unit Kerja Pengadaan Barang/Jasa (UKPBJ)','Pokja','Agen Pengadaan','PjPHP/PPHP','Penyelenggara Swakelola','Penyedia','Lainnya']; ?>
						<option value="">Pilih Pelaku Pengadaan</option>
						@foreach($arr as $k => $v)
						<option value="{{$v}}" {{$user->member->memberKantor->posisi_pelaku_pengadaan && $v == $user->member->memberKantor->posisi_pelaku_pengadaan ? 'selected' : ''}}>{{$v}}</option>
						@endforeach
					</select>
					<span><small class="text-warning">Boleh untuk tidak diisi</small></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Jenis Jabatan</label>
					<select class="form-control" name="jenis_jabatan">
						<?php $arr = ['Fungsional Umum', 'Fungsional Tertentu', 'Struktural', 'Rangkap', 'Bukan PNS']; ?>
						<option value="">Pilih Jenis Jabatan</option>
						@foreach($arr as $k => $v)
						<option value="{{$v}}" {{$v == $user->member->memberKantor->jenis_jabatan ? 'selected' : ''}}>{{$v}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Nama Jabatan</label>
					<input type="text" class="form-control" name="nama_jabatan" value="{{$user->member->memberKantor->nama_jabatan}}">
					<span><small class="text-warning">Non PNS siliahkan isi -</small></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Golongan Terakhir</label>
					<input type="text" class="form-control" name="golongan_terakhir" value="{{$user->member->memberKantor->golongan_terakhir}}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Tempat Kerja/Instansi</label>
					<input type="text" class="form-control" name="tempat_kerja" value="{{$user->member->memberKantor->nama_instansi}}">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Pemerintah (Kota/Kabupaten)</label>
					<input type="text" class="form-control" name="pemerintah_instansi" value="{{$user->member->memberKantor->pemerintah_instansi}}">
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Alamat Kantor Lengkap</label>
					<textarea type="textarea" class="form-control" name="alamat_lengkap_kantor"
					placeholder="Contoh: Jln. Jendral Sudirman Lantai 4" rows="3">{{$user->member->memberKantor->alamat_kantor_lengkap}}</textarea>
				</div>
			</div>
			<div class="col-sm-3">
				<label>Provinsi</label>
				<select class="form-control" name="kantor_provinsi">
					<option value="">Pilih Provinsi</option>
					@foreach($provinsi as $p)
					<option value="{{$p->id}}">{{$p->nama}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kota/Kabupaten</label>
				<select class="form-control" name="kantor_kota" disabled>
					<option value="">Pilih Kota</option>
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kecamatan</label>
				<select class="form-control" name="kantor_kecamatan" disabled>
					<option value="">Pilih Kecamatan</option>
				</select>
			</div>
			<div class="col-sm-3">
				<label>Kelurahan</label>
				<select class="form-control" name="kantor_kelurahan" disabled>
					<option value="">Pilih Kelurahan</option>
				</select>
			</div>

			<!-- <div class="col-sm-4">
				<div class="form-group">
					<label>Upload Pas Foto Resmi 3x4</label>
					<input type="file" name="pas_foto">
					@if($user->member->pas_foto3x4)
					<img src="{{\Helper::showImage($user->member->pas_foto3x4, 'pas_foto')}}" class="img-fluid mt-2" alt="">
					@endif
				</div>
			</div> -->
			<div class="col-sm-4 mt-4">
				<div class="form-group">
					<label>Upload Foto KTP</label>
					<input type="file" name="foto_ktp">
					@if($user->member->foto_ktp)
					<img src="{{\Helper::showImage($user->member->foto_ktp, 'foto_ktp')}}" class="img-fluid mt-2" alt="">
					@endif
				</div>
			</div>
			<div class="col-sm-4 mt-4">
				<div class="form-group">
					<label>Upload SK Pengangkatan ASN</label>
					<input type="file" name="sk_pengangkatan_asn">
					@if($user->member->file_sk_pengangkatan_asn)
					<a class="btn btn-primary btn-sm mt-2" href="{{\Helper::showImage($user->member->file_sk_pengangkatan_asn, 'sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
					@endif
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" id="btnsubmit">Update Profile</button>
	</form>
	<div class="modal fade" id="modalSosialMedia" tabindex="-1" role="dialog" aria-labelledby="modalSosialMediaLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data Sosial Media</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" action="{{ route('member_profile.store_sosial_media') }}" id="formSosialMedia">
					<div class="modal-body">
						@csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<input type="hidden" value="{{$user->id}}" name="user_id">
									<label>Sosial Media</label>
									<select name="sosial_media" class="form-control">
										<option value="">Pilih Sosial Media</option>
										@foreach($sosmed as $s)
										<option value="{{$s->id}}">{{$s->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" name="username" placeholder="Masukkan Username">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btnSimpanSosmed">Simpan</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<hr>
	<div class="card card-primary card-outline mt-2" style="background-color: #252c3c;">
		<div class="card-header" style="padding: 10px;">
			List Ujian
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-hover" id="table-pelatihanOfflineDiIkuti">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Event</th>
							<th>Lokasi</th>
							<th>Tanggal Pelaksanaan</th>
							<th>Lulus Ujian ?</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list_event_ujian as $key => $e)
						<tr>
							<td style="width: 5%">{{ $key+1 }}</td>
							<td>
								<a target="_blank" href="{{$e['link_slug']}}">{{ $e['judul']}}</a>
							</td>
							<td>{{$e['lokasi_event']}}</td>
							<td>{{ \Helper::changeFormatDate($e['tgl_start']).' s/d '.\Helper::changeFormatDate($e['tgl_end']) }}</td>
							<td>
								@if($e['lulus'] == 0)
								<span class="badge badge-warning">Tidak</span>
								@else
								<span class="badge badge-primary">Ya</span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	<hr>

	<a href="#" class="btn btn-info mt-2 btn-sm" id="btnSosialMedia">Tambah Sosial Media</a>
	@if($user->listSosialMedia()->exists())
	<div class="card card-primary card-outline mt-2" style="background-color: #252c3c;">
		<div class="card-header" style="padding: 10px;">
			List Sosial Media
		</div>
		<div class="card-body">
			<div class="row">
				<table class="table table-bordered table-hover">
					<tr>
						<th style="width:20%;">Sosial Media</th>
						<th>Username</th>
						<th>Aksi</th>
					</tr>
					@foreach($user->listSosialMedia as $s)
					<tr>
						<td>{{$s->sosial_media}}</td>
						<td>{{$s->username}}</td>
						<td><button type="button" class="btn-sm btn btn-danger" id="btnHapusSosialMedia" data-id="{{$s->id}}" action="{{route('member_profile.delete_sosial_media')}}">Hapus</button></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	@endif
	<a href="javascript:void(0)" class="btn btn-info mt-2 btn-sm" id="btnTambahSertifLainnya">Tambah Sertifikat Lainnya</a>
	<div class="card card-primary card-outline mt-2" style="background-color: #252c3c;">
		<div class="card-body">
			<div class="row">
				<form action="{{route('member_profile.store_sertifikat')}}" id="divContentSertifikatLain" class="form-inline">
					@csrf
				</form>
			</div>
		</div>
	</div>
	@if($user->member->sertifikatLain()->exists())
	<div class="card card-primary card-outline mt-2" style="background-color: #252c3c;">
		<div class="card-header" style="padding: 10px;">
			List Sertifikat Lain
		</div>
		<div class="card-body">
			<div class="row">
				<table class="table table-bordered table-hover">
					<tr>
						<th>No Sertifikat</th>
						<th>Nama</th>
						<th>Tahun</th>
						<th>Aksi</th>
					</tr>
					@foreach($user->member->sertifikatLain as $l)
					<tr>
						<td>{{$l->no}}</td>
						<td>{{$l->nama}}</td>
						<td>{{$l->tahun}}</td>
						<td><button type="button" class="btn-sm btn btn-danger" id="btnHapusSertifikat" data-id="{{$l->id}}" action="{{route('member_profile.delete_sertifikat')}}">Hapus</button></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection
@section('scripts')
@include('member.profile.update_profile_js')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
	$('#table-pelatihanOfflineDiIkuti').DataTable({})		
	$('#divContentSertifikatLain').submit(function(e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('[name=_token]').val()
			}
		});
		$.ajax({
			type: 'post',
			url: $(this).attr("action"),
			data: $(this).serialize(),
			beforeSend: function() {
				sendAjax('#btnSubmitSertifLain', false)
			},
			success: function(data) {
				if (data.status == "ok") {
					showAlert(data.messages)
					setTimeout(() => {
						location.reload()
					}, 1000)
				}
			},
			error: function(data) {
				showAlert('Terdapat kesalahan pada saat proses tambah sertifikat', "error")
			},
			complete: function() {
				sendAjax('#btnSubmitSertifLain', true, 'Submit')
			}
		});
	});
	$('body').on('click', '[id=btnHapusSertifikatTambahan]', function() {
		let _id = $(this).attr('data-count')
		$(`[id=divCont${_id}]`).remove()
		let cekCont = $('[id^=divCont]').length
		console.log(cekCont)
		if (cekCont <= 1) {
			$('[id=btnSubmitSertifLain]').parent().remove()
		}
	})
	let idClickable = 0;
	$('#btnTambahSertifLainnya').click(function(){
		idClickable++
		let cont = `<div class="col-md-4" id="divCont${idClickable}">
		<div class="form-group">
		<label>No Sertifikat</label>
		<input type="text" name="no_sertifikat_tambahan[]" class="form-control" placeholder="Masukkan No Sertifikat ..." required>
		</div>
		</div>
		<div class="col-md-4" id="divCont${idClickable}">
		<div class="form-group">
		<label>Nama Sertifikat</label>
		<input type="text" name="nama_sertifikat_tambahan[]" class="form-control" placeholder="Masukkan Nama Sertifikat ..." required>
		</div>
		</div>
		<div class="col-md-4" id="divCont${idClickable}">
		<div class="form-group">
		<label>Tahun</label>
		<div class="input-group mb-3">
		<input type="number" class="form-control" name="tahun_sertifikat_tambahan[]" placeholder="Masukkan Tahun ..." required="">
		<div class="input-group-prepend" id="btnHapusSertifikatTambahan" data-count=${idClickable}>
		<span class="input-group-text" alt="Hapus Sertifikat">X</span>
		</div>
		</div>
		</div>
		</div>`		
		$('#divContentSertifikatLain').append(cont)
		let lastElement = $('[id^=divCont]').last()
		let cekBtn = $('#btnSubmitSertifLain').length
		if (cekBtn < 1) {
			let cont2 = $(`<div class="col-md-4">
				<button type="submit" class="btn btn-primary" id="btnSubmitSertifLain">Simpan</button>
				</div>`)
			cont2.insertAfter(lastElement)
		}else{
			$('[id=btnSubmitSertifLain]').parent().remove()
			let cont2 = $(`<div class="col-md-4">
				<button type="submit" class="btn btn-primary" id="btnSubmitSertifLain">Simpan</button>
				</div>`)
			cont2.insertAfter(lastElement)
		}
	})
</script>
@endsection
