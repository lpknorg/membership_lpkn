<hr>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<input type="hidden" name="jenis_pelatihan" value="{{$list_event['jenis_pelatihan']}}">
			<label class="form-label" for="nama_tanpa_gelar">Nama Lengkap (Tanpa Gelar):</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_tanpa_gelar"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">	
			<label class="form-label" for="nama_dengan_gelar">Nama Lengkap (Dengan Gelar): </label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_dengan_gelar"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="no_hp">No HP (Whatsapp):</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="no_hp"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="jenis_kelamin">Jenis Kelamin:</label><span class="text-danger"> *</span>
			<select class="form-control" name="jenis_kelamin">
				<option value="">Pilih Jenis Kelamin</option>
				<option value="P">Perempuan</option>
				<option value="L">Laki-Laki</option>
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="tempat_lahir">Tempat Lahir:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="tempat_lahir"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="tanggal_lahir">Tanggal Lahir:</label><span class="text-danger"> *</span>
			<input type="date" class="form-control" name="tanggal_lahir"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir:</label><span class="text-danger"> *</span>
			<select class="form-control" name="pendidikan_terakhir">
				<?php $arr = ['SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'Lainnya']; ?>
				<option value="">Pilih Pendidikan Terakhir</option>
				@foreach($arr as $k => $v)
				<option value="{{$v}}">{{$v}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="instansi">Instansi/Perusahaan:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_instansi"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nip">NIP:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nip"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nik">NIK:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="nik"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="status_kepegawaian">Status Kepegawaian:</label><span class="text-danger"> *</span>
			<select class="form-control" name="status_kepegawaian">
				<option value="">Pilih Status Kepegawaian</option>
				<option value="PNS">PNS</option>
				<option value="NON PNS">NON PNS</option>
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="unit_organisasi">Unit Organisasi:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="unit_organisasi"><br>
		</div>
	</div>
	<div class="col-md-9">
		<div class="form-group">
			<label class="form-label" for="alamat_kantor">Alamat Lengkap Kantor:</label><span class="text-danger"> *</span>
			<textarea class="form-control" name="alamat_kantor" rows="2" placeholder="Jawaban Anda" autocomplete="off"></textarea><br>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label" for="kode_pos">Kode Pos:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="kode_pos"><br>
		</div>
	</div>
	@if($list_event['jenis_pelatihan'] == "bnsp" || $list_event['jenis_pelatihan'] == "bimtek")
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label" for="alamat_rumah">Alamat Rumah:</label><span class="text-danger"> *</span>
			<textarea rows="3" placeholder="Jawaban Anda" class="form-control" name="alamat_rumah">{{$user->member->alamat_lengkap}}</textarea><br>
		</div>
	</div>
	@endif
	@if($list_event['jenis_pelatihan'] == "lkpp")
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="posisi_pengadaan">Posisi Pelaku Pengadaan:</label><span class="text-danger"> *</span>
			<select class="form-control" name="posisi_pengadaan">
				<?php $arr = ['PA (Pengguna Anggaran)','KPA (Kuasa Pengguna Anggaran)','PPK (Pejabat Pembuat Komitmen)','Pejabat Pengadaan','Unit Kerja Pengadaan Barang/Jasa (UKPBJ)','Pokja Pemilihan','Agen Pengadaan','Penyelenggara Swakelola','Penyedia','Lainnya']; ?>
				<option value="">Pilih Pelaku Pengadaan</option>
				@foreach($arr as $k => $v)
				<option value="{{$v}}">{{$v}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="jenis_jabatan">Jenis Jabatan:</label><span class="text-danger"> *</span>
			<select class="form-control" name="jenis_jabatan">
				<?php $arr = ['Fungsional Umum', 'Fungsional Tertentu', 'Struktural', 'Rangkap', 'Bukan PNS']; ?>
				<option value="">Pilih Jenis Jabatan</option>
				@foreach($arr as $k => $v)
				<option value="{{$v}}">{{$v}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	@endif
</div>
<div class="row mt-3">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nama_jabatan">Nama Jabatan:</label>
			<span class="text-info d-block" style="margin-top: -14px;">(jika Non PNS silahkan isi "-")<span class="text-danger"> *</span></span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_jabatan"><br>
		</div>
	</div>
</div>
<div class="row">
	@if($list_event['jenis_pelatihan'] == "lkpp")
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="golongan_terakhir">Golongan Terakhir:</label>
			<span class="text-info d-block" style="margin-top: -14px;">(jika Non PNS silahkan isi "-")<span class="text-danger"> *</span></span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="golongan_terakhir"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="konfirmasi_paket">Konfirmasi Paket Kontribusi:</label><span class="text-danger"> *</span>
			<select class="form-control" name="konfirmasi_paket">
				<option value="">Pilih Paket Kontribusi</option>
				<option value="Rp. 5.250.000,- (Tanpa Menginap)">Rp. 5.250.000,- (Tanpa Menginap)</option>
				<option value="Rp. 6.450.000,- (Menginap Twin Share)">Rp. 6.450.000,- (Menginap Twin Share (1 Kamar Berdua))</option>
				<option value="Rp. 7.050.000,- (Menginap Single)">Rp. 7.050.000,- (Menginap Single (1 Kamar Sendiri))</option>
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="foto_ktp">Upload Foto KTP:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="foto_ktp">
			<img src="" id="displayImageKtp" class="img-fluid mt-1 mb-3" alt="" style="width: 100px;display: none;border-radius: 5px;">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">                    
			<label class="form-label" for="sk_pengangkatan_asn">Upload SK Pengangkatan ASN:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="sk_pengangkatan_asn">
		</div>
	</div>
	@endif
	<div class="col-md-6 mt-3">
		<div class="form-group">
			<label class="form-label" for="pas_foto">Upload Pas Foto:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="pas_foto">
			<img src="" id="displayImagePasFoto" class="img-fluid mt-1 mb-3" alt="" style="width: 100px;display: none;border-radius: 5px;">
		</div>
	</div>
</div>