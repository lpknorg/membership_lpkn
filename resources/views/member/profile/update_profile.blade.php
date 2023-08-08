@extends('member.layouts.template')
@section('content')
<style>
	.text-warning{
		color: #f5943d!important;
	}
</style>
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Update Profile Member
	</h5>
	<form method="POST" action="{{route('member_profile.update_profile')}}">
		@csrf
		<h4><b> Data Pribadi</b></h4>
		<hr class="mb-2 mt-0">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>NIP/NRP</label>
					<input type="number" class="form-control" name="nip" value="{{$user->member->nip}}">
					<span><small class="text-warning">Non PNS siliahkan isi -</small></span>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>NIK</label>
					<input type="number" class="form-control" name="nik" value="{{$user->member->nik}}">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{$user->email}}">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Pendidikan Terakhir</label>
					<select class="form-control" name="pendidikan_terakhir">
						<?php $arr = ['SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2']; ?>
						<option value="">Pilih Pendidikan Terakhir</option>
						@foreach($arr as $k => $v)
						<option value="{{$k}}" {{$k == $user->member->pendidikan_terakhir ? 'selected' : ''}}>{{$v}}</option>
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
			<div class="col-sm-4">
				<div class="form-group">
					<label>Tempat dan Lahir</label>
					<input type="text" class="form-control" name="tempat_dan_tgl_lahir" value="{{$user->member->tempat_dan_tgl_lahir}}">
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
		</div>
		<br>
		<h4><b> Data Kantor</b></h4>
		<hr class="mb-2 mt-0">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>Status Kepegawaian</label>
					<?php $arr = ['PNS', 'SWASTA', 'TNI/POLRI', 'BUMN/BUMD', 'HONORER / KONTRAK', 'ASN', 'Swasta', 'Lainnya']; ?>
					<select class="form-control" name="status_kepegawaian">
						<option value="">Pilih Status Kepegawaian</option>
						@foreach($arr as $k => $v)
						<option value="{{$k}}" {{$k == $user->member->memberKantor->status_kepegawaian ? 'selected' : ''}}>{{$v}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-4" id="div-bumn" style="display: {{$user->member->memberKantor->status_kepegawaian == 0 ? 'block' : 'none';}};">
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
			<div class="col-sm-4" id="div-bumn" style="display: {{$user->member->memberKantor->status_kepegawaian == 0 ? 'block' : 'none';}};">
				<div class="form-group">
					<label>Lembaga Pemerintahan</label>
					<select name="lembaga_pemerintahan" class="form-control">
						<option value="">Pilih Lembaga Pemerintahan</option>
					</select>
				</div>
			</div>
			<div class="col-sm-4" id="div-dll" style="display: {{$user->member->memberKantor->status_kepegawaian == 7 ? 'block' : 'none';}};">
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
						<option value="{{$k}}" {{$user->member->memberKantor->posisi_pelaku_pengadaan && $k == $user->member->memberKantor->posisi_pelaku_pengadaan ? 'selected' : ''}}>{{$v}}</option>
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
						<option value="{{$k}}" {{$k == $user->member->memberKantor->jenis_jabatan ? 'selected' : ''}}>{{$v}}</option>
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
			<div class="col-sm-4">
				<div class="form-group">
					<label>Upload Pas Foto Resmi 3x4</label>
					<input type="file" name="pas_foto">
					@if($user->member->pas_foto3x4)
					<img src="{{\Helper::showImage($user->member->pas_foto3x4, 'pas_foto')}}" class="img-fluid mt-2" alt="">
					@endif
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>Upload Foto KTP</label>
					<input type="file" name="foto_ktp">
					@if($user->member->foto_ktp)
					<img src="{{\Helper::showImage($user->member->foto_ktp, 'foto_ktp')}}" class="img-fluid mt-2" alt="">
					@endif
				</div>
			</div>
			<div class="col-sm-4">
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
	
</div>
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		getProvinsi('rumah_provinsi')
		getKota('{{$user->member->prov_id}}', 'rumah_kota')
		getKecamatan('{{$user->member->kota_id}}', 'rumah_kecamatan')
		getKelurahan('{{$user->member->kecamatan_id}}', 'rumah_kelurahan')

		getProvinsi('kantor_provinsi', '{{$user->member->memberKantor->kantor_prov_id}}')
		getKota('{{$user->member->memberKantor->kantor_prov_id}}', 'kantor_kota', '{{$user->member->memberKantor->kantor_kota_id}}')
		getKecamatan('{{$user->member->memberKantor->kantor_kota_id}}', 'kantor_kecamatan', '{{$user->member->memberKantor->kantor_kecamatan_id}}')
		getKelurahan('{{$user->member->memberKantor->kantor_kecamatan_id}}', 'kantor_kelurahan', '{{$user->member->memberKantor->kantor_kelurahan_id}}')
		getLembagaPemerintahan('{{$user->member->memberKantor->instansi_id}}', 'lembaga_pemerintahan')

		function getProvinsi(selector, selected_id='{{$user->member->prov_id}}'){
			$.ajax({
				type: 'GET',
				url: '{{route('api.get.provinsi')}}',
				success: function(data) {
					let provinsi = '<option value="">-- Pilih Provinsi --</option>'
					$.each(data.data, function(k, v){
						provinsi += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.nama}</option>`
					})
					$(`[name=${selector}]`).attr('disabled', false).html(provinsi)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data provinsi", "error")                     
				},
				complete: function() {

				}
			});     
		}
		function getKota(_val, selector, selected_id='{{$user->member->kota_id}}'){
			$.ajax({
				type: 'GET',
				url: '{{route('api.get.kota')}}',
				data: {
					id_provinsi: _val
				},
				success: function(data) {
					let kota = '<option value="">-- Pilih Kota --</option>'
					$.each(data.data, function(k, v){
						kota += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kota}</option>`
					})
					$(`[name=${selector}]`).attr('disabled', false).html(kota)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data kota", "error")                     
				},
				complete: function() {

				}
			});     
		}
		function getKecamatan(_val, selector, selected_id='{{$user->member->kecamatan_id}}'){
			$.ajax({
				type: 'get',
				url: "{{ url('api/general/kecamatan') }}",
				data: {
					id_kota: _val
				},
				success: function(data) {
					let opt = '<option value="">Pilih Kecamatan</option>'
					$.each(data.data, function(k, v) {
						opt +=
						`<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kecamatan}</option>`
					})
					$(`[name=${selector}]`).prop('disabled', false).html(opt)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data kecamatan", "error")
				}
			});
		}
		function getKelurahan(_val, selector, selected_id='{{$user->member->kelurahan_id}}'){
			$.ajax({
				type: 'get',
				url: "{{ url('api/general/kelurahan') }}",
				data: {
					id_kecamatan: _val
				},
				success: function(data) {
					console.log(data)
					let opt = '<option value="">Pilih Kelurahan</option>'
					$.each(data.data, function(k, v) {
						opt +=
						`<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kelurahan} - ${v.kode_pos.kode_pos}</option>`
					})
					$(`[name=${selector}]`).prop('disabled', false).html(opt)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data kelurahan", "error")
				}
			});
		}
		function getLembagaPemerintahan(_val, selector, selected_id='{{$user->member->memberKantor->lembaga_pemerintahan_id}}'){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});
			$.ajax({
				url : "{{route('api.get.lembaga_pemerintahan')}}",
				method : "post",
				data : {instansi_id:_val},
				dataType : 'json',
				success: function(data) {
					let lp = '<option value="">-- Pilih Lembaga Pemerintahan --</option>'
					$.each(data, function(k, v){
						lp += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.nama}</option>`
					})
					$(`[name=${selector}]`).html(lp)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data lembaga pemerintahan", "error")
				}
			});
		}
		$('[name=rumah_provinsi]').change(function(){
			let _val = $(this).find(":selected").val()
			getKota(_val, 'rumah_kota')
		})
		$('[name=rumah_kota]').change(function(){
			let _val = $(this).find(":selected").val()
			getKecamatan(_val, 'rumah_kecamatan')
		})

		$('[name=rumah_kecamatan]').change(function(){
			let _val = $(this).find(":selected").val()
			getKelurahan(_val, 'rumah_kelurahan')
		})

		$('[name=kantor_provinsi]').change(function(){
			let _val = $(this).find(":selected").val()
			getKota(_val, 'kantor_kota')
		})
		$('[name=kantor_kota]').change(function(){
			let _val = $(this).find(":selected").val()
			getKecamatan(_val, 'kantor_kecamatan')
		})

		$('[name=kantor_kecamatan]').change(function(){
			let _val = $(this).find(":selected").val()
			getKelurahan(_val, 'kantor_kelurahan')
		})
		$('[name=instansi]').change(function(){
			let _val = $(this).find(":selected").val()
			getLembagaPemerintahan(_val, 'lembaga_pemerintahan')
		})
		$('body').on('change', '[name=status_kepegawaian]', function() {
			let val = parseInt($(this).find(':selected').val())
			if (val == 0) {
				$('[id=div-dll]').hide(300)
				$('[id=div-bumn]').show(300)
			}else if (val == 7) {
				$('[id=div-bumn]').hide(300)
				$('[id=div-dll]').show(300)
			}else{
				$('[id=div-bumn]').hide(300)
				$('[id=div-dll]').hide(300)
			}
		})
		$('form').submit(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});

			var form_data = new FormData($(this)[0]);
			form_data.append('pas_foto', $('[name=pas_foto]').prop('files')[0]);
			form_data.append('foto_ktp', $('[name=foto_ktp]').prop('files')[0]);
			form_data.append('sk_pengangkatan_asn', $('[name=sk_pengangkatan_asn]').prop('files')[0]);

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				beforeSend: function() {
					sendAjax('#btnsubmit', false)
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						showAlert(data.messages)
						setTimeout(function() {
							location.href = '/member_profile/edit_profile'
						}, 1000);
					}
				},
				error: function(data) {
					var data = data.responseJSON;

					if (data.status == "fail") {
						showAlert(data.messages, "error")
					}
				},
				complete: function() {
					sendAjax('#btnsubmit', true, 'Update Profile')
				}
			});
		});
	})
</script>
@endsection