<hr>
@if($list_event['event']['jenis_kelas'] == "0")
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<input type="hidden" name="jenis_pelatihan" value="{{$list_event['event']['jenis_pelatihan']}}">
			<input type="hidden" name="jenis_kelas" value="{{$list_event['event']['jenis_kelas']}}">
			<input type="hidden" name="konfirmasi_paket" value="{{\Helper::showNominal($list_event['biaya'][0]['nominal_biaya']).',- ('.$list_event['biaya'][0]['nama_biaya'].')'}}">
			<label class="form-label" for="nama_tanpa_gelar">Nama Lengkap (Tanpa Gelar):</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_tanpa_gelar">
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">	
			<label class="form-label" for="nama_dengan_gelar">Nama Lengkap (Dengan Gelar): </label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_dengan_gelar">
			
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nik">NIK:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16"><br>
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
			<label class="form-label" for="instansi">Nama Instansi Lengkap</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_instansi">
			<span class="text-info d-block" id="span-instansi"> contoh : Dinas Sosial Provinsi Jawa Barat, Dinas Sosial Kabupaten Bogor, dsb</span><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Provinsi:</label><span class="text-danger"> *</span>
			<select class="form-control" name="provinsi">
				<option value="">Pilih Provinsi</option>
				@foreach($provinsi as $v)
				<option value="{{$v->id}}">{{$v->nama}}</option>
				@endforeach
			</select>
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Kota/Kabupaten</label><span class="text-danger"> *</span>
			<select class="form-control" name="kota" disabled>
				<option value="">Pilih Kota</option>
			</select>
			<br>
		</div>
	</div>
	<div class="col-md-6 mt-2">
		<div class="form-group">
			<label class="form-label" for="no_hp">No Whatsapp:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="no_hp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14"><br>
		</div>
	</div>
	<div class="col-md-6 mt-2">
		<div class="form-group">
			<label class="form-label" for="pas_foto">Upload Pas Foto:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="pas_foto" accept=".jpeg, .png, .jpg">
			<img src="" id="displayImagePasFoto" class="img-fluid mt-1 mb-3" alt="" style="width: 100px;display: none;border-radius: 5px;">
		</div>
	</div>
	@if($list_event['event']['jenis_pelatihan'] == "bnsp" || $list_event['event']['jenis_pelatihan'] == "bimtek")
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nip">NIP:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" required class="form-control" name="nip" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="18"><br>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label" for="alamat_rumah">Alamat Pengiriman Sertifikat:</label><span class="text-danger"> *</span>
			<textarea rows="3" placeholder="Jawaban Anda" class="form-control" name="alamat_rumah" required></textarea><br>
		</div>
	</div>
	@endif
</div>
@else
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<input type="hidden" name="jenis_pelatihan" value="{{$list_event['event']['jenis_pelatihan']}}">
			<input type="hidden" name="jenis_kelas" value="{{$list_event['event']['jenis_kelas']}}">
			<label class="form-label" for="nama_tanpa_gelar">Nama Lengkap (Tanpa Gelar):</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_tanpa_gelar">
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">	
			<label class="form-label" for="nama_dengan_gelar">Nama Lengkap (Dengan Gelar): </label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_dengan_gelar">
			
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nik">NIK:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="nik" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16"><br>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label class="form-label" for="no_hp">No Whatsapp:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="no_hp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="14"><br>
		</div>
	</div>
	<div class="col-md-3">
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
			<input type="text" class="form-control" name="tanggal_lahir">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="pas_foto">Upload Pas Foto:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="pas_foto" accept=".jpeg, .png, .jpg">
			<img src="" id="displayImagePasFoto" class="img-fluid mt-1 mb-3" alt="" style="width: 100px;display: none;border-radius: 5px;">
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir:</label><span class="text-danger"> *</span>
			<select class="form-control" name="pendidikan_terakhir">
				<?php $arr = ['SD', 'SLTP', 'SLTA', 'Diploma I', 'Diploma II', 'Diploma III', 'Diploma IV', 'S1', 'S2', 'S3']; ?>
				<option value="">Pilih Pendidikan Terakhir</option>
				@foreach($arr as $k => $v)
				<option value="{{$v}}">{{$v}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Nama Pendidikan Terakhir:</label><span class="text-danger"> *</span>
			<input type="text" class="form-control" name="nama_pendidikan_terakhir" placeholder="contoh: Manajemen, ekonomi, ..."><br>
		</div>
	</div>
</div>
<div class="row">
	
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="status_kepegawaian">Status Kepegawaian:</label><span class="text-danger"> *</span>
			<?php $arr = ['PNS/PPPK', 'POLRI', 'TNI AL', 'TNI AD', 'TNI AU', 'BUMN/BUMD', 'SWASTA', 'HONORER / KONTRAK', 'PRIBADI/INDIVIDU', 'PEGAWAI PEMERINTAH NON ASN']; ?>
			<select class="form-control" name="status_kepegawaian">
				<option value="">Pilih Status Kepegawaian</option>
				@foreach($arr as $k => $v)
				@if($v == 'PNS/PPPK')
				<option value="PNS">{{$v}}</option>
				@else
				<option value="{{$v}}">{{$v}}</option>
				@endif
				@endforeach
			</select>
			<br>
		</div>
	</div>
</div>
<div class="row" id="divPns" style="display: none">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nip">NIP:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="nip" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="18"><br>
		</div>
	</div>
	@if($list_event['event']['jenis_pelatihan'] != "bimtek")
	<div class="col-md-6">
		<div class="form-group">                    
			<label class="form-label" for="sk_pengangkatan_asn">Upload SK Pengangkatan ASN:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="sk_pengangkatan_asn" accept=".pdf, .jpeg, .png, .jpg">
		</div>
		<br>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="nama_jabatan">Nama Jabatan:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_jabatan"><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="golongan_terakhir">Golongan Terakhir:</label><span class="text-danger"> *</span>
			<select class="form-control" name="golongan_terakhir">
				<option value="">Pilih Golongan</option>
				@foreach($golongan as $k => $val)
				<option value="{{$val}}">{{$val}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	@endif
</div>
<div class="row" id="divPolriTni" style="display:none;">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">NRP:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nrp"><br>
		</div>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="instansi">Nama Instansi Lengkap</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_instansi">
			<span class="text-info d-block" id="span-instansi"> contoh : Dinas Sosial Provinsi Jawa Barat, Dinas Sosial Kabupaten Bogor, dsb</span><br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Provinsi:</label><span class="text-danger"> *</span>
			<select class="form-control" name="provinsi">
				<option value="">Pilih Provinsi</option>
				@foreach($provinsi as $v)
				<option value="{{$v->id}}">{{$v->nama}}</option>
				@endforeach
			</select>
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label">Kota/Kabupaten</label><span class="text-danger"> *</span>
			<select class="form-control" name="kota" disabled>
				<option value="">Pilih Kota</option>
			</select>
			<br>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="kode_pos">Kode Pos:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="kode_pos" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5"><br>
		</div>
	</div>	
	<div class="col-md-7">
		<div class="form-group">
			<label class="form-label" for="alamat_kantor">Alamat Lengkap Kantor:</label><span class="text-danger"> *</span>
			<textarea class="form-control" name="alamat_kantor" rows="3" placeholder="Jawaban Anda" autocomplete="off"></textarea><br>
		</div>
	</div>
	<div class="col-md-5">
		<div class="form-group">
			<label class="form-label" for="unit_organisasi">Unit Organisasi:</label><span class="text-danger"> *</span>
			<input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="unit_organisasi"><br>
		</div>
	</div>
	
	@if($list_event['event']['jenis_pelatihan'] == "bnsp" || $list_event['event']['jenis_pelatihan'] == "bimtek")
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-label" for="alamat_rumah">Alamat Rumah:</label><span class="text-danger"> *</span>
			<textarea rows="3" placeholder="Jawaban Anda" class="form-control" name="alamat_rumah"></textarea><br>
		</div>
	</div>
	@endif
	@if($list_event['event']['jenis_pelatihan'] == "lkpp")
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="posisi_pengadaan">Posisi Pelaku Pengadaan:</label><span class="text-danger"> *</span>
			<select class="form-control" name="posisi_pengadaan">
				<?php $arr = ['PA (Pengguna Anggaran)','KPA (Kuasa Pengguna Anggaran)','PPK (Pejabat Pembuat Komitmen)','Pejabat Pengadaan','Unit Kerja Pengadaan Barang/Jasa (UKPBJ)','Pokja Pemilihan','Agen Pengadaan','Penyelenggara Swakelola','Penyedia','Lainnya']; ?>
				<option value="">Pilih Pelaku Pengadaan</option>
				@foreach($arr as $k => $v)
				<option value="{{$v}}">{{$v}}</option>
				@endforeach
			</select>
		</div>
		<br>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="jenis_jabatan">Jenis Jabatan:</label><span class="text-danger"> *</span>
			<select class="form-control" name="jenis_jabatan" required>
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
<div class="row">
	@if($list_event['event']['inhouse'] == "0")
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="konfirmasi_paket">Konfirmasi Paket Kontribusi:</label><span class="text-danger"> *</span>
			<select class="form-control" name="konfirmasi_paket" required>
				<option value="">Pilih Paket Kontribusi</option>
				@foreach($list_event['biaya'] as $b)
				<option value="{{\Helper::showNominal($b['nominal_biaya']).',- ('.$b['nama_biaya'].')'}}">{{\Helper::showNominal($b['nominal_biaya']).',- ('.$b['nama_biaya'].')'}}</option>
				@endforeach
			</select><br>
		</div>
	</div>
	@endif
	@if($list_event['event']['jenis_pelatihan'] == "lkpp")	
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="foto_ktp">Upload Foto KTP:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="foto_ktp" accept=".jpeg, .png, .jpg">
			<img src="" id="displayImageKtp" class="img-fluid mt-1 mb-3" alt="" style="width: 100px;display: none;border-radius: 5px;">
			<br>
		</div>
	</div>
	
	@endif
	
</div>
@if(strtolower(substr($list_event['event']['judul'], 0, 18)) == 'jabatan fungsional')
<hr>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="tmt_pangkat_pns_terakhir">TMT Pangkat PNS Terakhir:</label><span class="text-danger"> *</span>
			<input type="date" class="form-control" required name="tmt_pangkat_pns_terakhir">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-label" for="tmt_sk_jf_pbj_terakhir">TMT SK JF PPBJ Terakhir:</label><span class="text-danger"> *</span>
			<input type="date" class="form-control" required name="tmt_sk_jf_pbj_terakhir">
		</div>
	</div>
	<div class="col-md-12 mt-3">
		<div class="form-group">                    
			<label class="form-label" for="file_penilaian_angka_kredit_terakhir">Upload Melampirkan dokumen Penilaian Angka Kredit (PAK) Terakhir:</label><span class="text-danger"> *</span>
			<input type="file" class="form-control" name="file_penilaian_angka_kredit_terakhir" accept=".pdf, .jpeg, .png, .jpg">
		</div>
	</div>
</div>
@endif
@if($list_event['event']['judul_pelatihan'] == "ppk_tipe_c")
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">                    
			<label class="form-label" for="file_sertifikat_pbj_level1">Upload Sertifikat PBJ Level 1:</label>
			<input type="file" class="form-control" name="file_sertifikat_pbj_level1" accept=".pdf, .jpeg, .png, .jpg">
		</div>
	</div>
</div>
@endif
@endif
<button type="submit" class="btn btn-primary w-100 mt-2">Kirim</button>