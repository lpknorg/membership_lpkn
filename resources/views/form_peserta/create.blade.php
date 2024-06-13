<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata Pelatihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body{
            background-color: rgb(227, 217, 232);
        }
        .form-group{
            margin-bottom: 0;
        }
        .card{
            border-radius: 12px;            
        }
        .card #top{
            border-top: 15px solid rgb(70, 2, 101);
        }
        .card-body{            
            border-radius: 12px;            
        }
        .form-group label{
            font-weight: 600;
        }
        span.text-info{
            font-size: 15px;
            font-weight: 600;
        }
        span.text-danger{
            font-size: 17px;
            font-weight: 600;
        }
        button[type=submit]{
            color: #fff;
            border: none;
            background-color: rgb(70, 2, 101);
            transition: 0.6s;
        }
        button[type=submit]:hover{
            color: #fff;
            border: none;
            border-radius: 10px 20px 10px 20px;
            background-color: rgb(125 13 177);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row my-3">
            @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
            @endif
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body" id="top">
                        <h2>Biodata Peserta Pelatihan dan Ujian {{$list_event['judul']}}</h2>
                        <h6>Bapak/Ibu dimohon untuk mengisi dengan hati - hati agar tidak terjadi Kesalahan Data 🙏🏻</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('form_peserta_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_event" value="{{ $list_event['id'] }}">
                            <div class="form-group">
                                <label class="form-label" for="nama_tanpa_gelar">Nama Lengkap (Tanpa Gelar):</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_tanpa_gelar" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nama_dengan_gelar">Nama Lengkap (Dengan Gelar): </label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_dengan_gelar" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email Aktif:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="email" class="form-control" name="email" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="no_hp">No HP (Whatsapp):</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="no_hp" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tempat_lahir">Tempat Lahir:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="tempat_lahir" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir:</label><span class="text-danger"> *</span>
                                <input type="date" class="form-control" name="tanggal_lahir" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir:</label><span class="text-danger"> *</span>
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
                                <label class="form-label" for="instansi">Instansi/Perusahaan:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="instansi" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nip">NIP:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nip"><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nik">NIK:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="number" class="form-control" name="nik" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="status_kepegawaian">Status Kepegawaian:</label><span class="text-danger"> *</span>
                                <select class="form-control" name="status_kepegawaian" required>
                                    <option value="PNS">PNS</option>
                                    <option value="NON PNS">NON PNS</option>
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="alamat_kantor">Alamat Lengkap Kantor:</label><span class="text-danger"> *</span>
                                <textarea class="form-control" name="alamat_kantor" rows="3" required placeholder="Jawaban Anda" autocomplete="off"></textarea><br>
                            </div>
                            @if($list_event['jenis_pelatihan'] == "bnsp" || $list_event['jenis_pelatihan'] == "bimtek")
                            <div class="form-group">
                                <label class="form-label" for="alamat_rumah">Alamat Rumah:</label><span class="text-danger"> *</span>
                                <textarea class="form-control" name="alamat_rumah" required></textarea><br>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="form-label" for="kode_pos">Kode Pos:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="kode_pos" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="unit_organisasi">Unit Organisasi:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="unit_organisasi" required><br>
                            </div>
                            @if($list_event['jenis_pelatihan'] == "lkpp")
                            <div class="form-group">
                                <label class="form-label" for="posisi_pengadaan">Posisi Pelaku Pengadaan:</label><span class="text-danger"> *</span>
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
                                <label class="form-label" for="jenis_jabatan">Jenis Jabatan:</label><span class="text-danger"> *</span>
                                <select class="form-control" name="jenis_jabatan" required>
                                    <option value="Fungsional Umum">Fungsional Umum</option>
                                    <option value="Fungsional Tertentu">Fungsional Tertentu</option>
                                    <option value="Struktural">Struktural</option>
                                    <option value="Rangkap">Rangkap</option>
                                    <option value="Bukan PNS">Bukan PNS</option>
                                </select><br>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="form-label" for="nama_jabatan">Nama Jabatan:</label>
                                <span class="text-info">( jika Non PNS silahkan isi " - ")</span><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="nama_jabatan" required><br>
                            </div>
                            @if($list_event['jenis_pelatihan'] == "lkpp")
                            <div class="form-group">
                                <label class="form-label" for="golongan_terakhir">Golongan Terakhir:</label>
                                <span class="text-info">( jika Non PNS silahkan isi " - ")</span><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="text" class="form-control" name="golongan_terakhir" required><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="konfirmasi_paket">Konfirmasi Paket Kontribusi:</label><span class="text-danger"> *</span>
                                <select class="form-control" name="konfirmasi_paket" required>
                                    <option value="Rp. 5.250.000,- (Tanpa Menginap)">Rp. 5.250.000,- (Tanpa Menginap)</option>
                                    <option value="Rp. 6.450.000,- (Menginap Twin Share)">Rp. 6.450.000,- (Menginap Twin Share (1 Kamar Berdua))</option>
                                    <option value="Rp. 7.050.000,- (Menginap Single)">Rp. 7.050.000,- (Menginap Single (1 Kamar Sendiri))</option>
                                </select><br>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin:</label><span class="text-danger"> *</span>
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select><br>
                            </div>
                            @if($list_event['jenis_pelatihan'] == "lkpp")
                            <div class="form-group">
                                <label class="form-label" for="foto_ktp">Upload Foto KTP:</label><span class="text-danger"> *</span>
                                <input type="file" class="form-control" name="foto_ktp" required><br>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="form-label" for="pas_foto">Upload Pas Foto:</label><span class="text-danger"> *</span>
                                <input type="file" class="form-control" name="pas_foto" required><br>
                            </div>
                            @if($list_event['jenis_pelatihan'] == "lkpp")
                            <div class="form-group">                    
                                <label class="form-label" for="sk_pengangkatan_asn">Upload SK Pengangkatan ASN:</label><span class="text-danger"> *</span>
                                <input type="file" class="form-control" name="sk_pengangkatan_asn" required><br>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary w-25">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>
