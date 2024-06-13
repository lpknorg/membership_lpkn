<!DOCTYPE html>
<html>
<head>
    <title>CRUD Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            @if(session('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>Biodata Peserta Pelatihan dan Ujian {{$list_event['judul']}}</h2>
                <hr>
                <form action="{{ route('form_peserta_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_event" value="{{ $list_event['id'] }}">
                    <div class="form-group">
                        <label class="form-label" for="nama_tanpa_gelar">Nama Lengkap (Tanpa Gelar):</label>
                        <input type="text" class="form-control" name="nama_tanpa_gelar" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nama_dengan_gelar">Nama Lengkap (Dengan Gelar):</label>
                        <input type="text" class="form-control" name="nama_dengan_gelar" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email Aktif:</label>
                        <input type="email" class="form-control" name="email" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="no_hp">No HP (Whatsapp):</label>
                        <input type="text" class="form-control" name="no_hp" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" class="form-control" name="tempat_lahir" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir:</label>
                        <select class="form-control" name="pendidikan_terakhir" required>
                        <option value="SMA">SMA</option>
                        <option value="D1">D1</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="Yang lain">Yang lain</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="instansi">Instansi/Perusahaan:</label>
                        <input type="text" class="form-control" name="instansi" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nip">NIP:</label>
                        <input type="text" class="form-control" name="nip"><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nik">NIK:</label>
                        <input type="text" class="form-control" name="nik" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status_kepegawaian">Status Kepegawaian:</label>
                        <select class="form-control" name="status_kepegawaian" required>
                            <option value="PNS">PNS</option>
                            <option value="NON PNS">NON PNS</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="alamat_kantor">Alamat Lengkap Kantor:</label>
                        <textarea class="form-control" name="alamat_kantor" required></textarea><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="kode_pos">Kode Pos:</label>
                        <input type="text" class="form-control" name="kode_pos" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="unit_organisasi">Unit Organisasi:</label>
                        <input type="text" class="form-control" name="unit_organisasi" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="posisi_pengadaan">Posisi Pelaku Pengadaan:</label>
                        <select class="form-control" name="posisi_pengadaan" required>
                            <option value="PA">PA</option>
                            <option value="KPA">KPA</option>
                            <option value="PPK">PPK</option>
                            <option value="PP">PP</option>
                            <option value="POKJA PEMILIHAN">POKJA PEMILIHAN</option>
                            <option value="PENYELENGGARA SWAKELOLA">PENYELENGGARA SWAKELOLA</option>
                            <option value="AGEN PENGADAAN">AGEN PENGADAAN</option>
                            <option value="PENYEDIA">PENYEDIA</option>
                            <option value="LAINNYA">LAINNYA</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="jenis_jabatan">Jenis Jabatan:</label>
                        <select class="form-control" name="jenis_jabatan" required>
                            <option value="Fungsional Umum">Fungsional Umum</option>
                            <option value="Fungsional Tertentu">Fungsional Tertentu</option>
                            <option value="Struktural">Struktural</option>
                            <option value="Rangkap">Rangkap</option>
                            <option value="Bukan PNS">Bukan PNS</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nama_jabatan">Nama Jabatan:</label>
                        <input type="text" class="form-control" name="nama_jabatan" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="golongan_terakhir">Golongan Terakhir:</label>
                        <input type="text" class="form-control" name="golongan_terakhir" required><br>
                    </div>
                    <div class="form-group">
                    <label class="form-label" for="konfirmasi_paket">Konfirmasi Paket Kontribusi:</label>
                        <select class="form-control" name="konfirmasi_paket" required>
                            <option value="Rp. 5.250.000,- (Tanpa Menginap)">Rp. 5.250.000,- (Tanpa Menginap)</option>
                            <option value="Rp. 6.450.000,- (Menginap Twin Share)">Rp. 6.450.000,- (Menginap Twin Share (1 Kamar Berdua))</option>
                            <option value="Rp. 7.050.000,- (Menginap Single)">Rp. 7.050.000,- (Menginap Single (1 Kamar Sendiri))</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin:</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="foto_ktp">Upload Foto KTP:</label>
                        <input type="file" class="form-control" name="foto_ktp" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pas_foto">Upload Pas Foto 3x4:</label>
                        <input type="file" class="form-control" name="pas_foto" required><br>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="sk_pengangkatan_asn">Upload SK Pengangkatan ASN:</label>
                        <input type="file" class="form-control" name="sk_pengangkatan_asn" required><br>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-2"></div>
            
             
        </div>
    </div>
  

</body>
</html>
