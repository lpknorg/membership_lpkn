<div class="modal-header">
	<h5 class="modal-title">Lihat Data Member</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<form method="POST" action="{{route('member_profile.update_profile')}}">
		@csrf
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>NIP/NRP</label>
					<input type="number" class="form-control" name="nip" value="{{$user->nip}}">
					<span><small class="text-warning">Non PNS siliahkan isi -</small></span>
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
			<div class="col-sm-4">
				<div class="form-group">
					<label>Tempat dan Tanggal Lahir</label>
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