<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>NIK</th>
            <th>NIP</th>
            <th>Pendidikan Terakhir</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat Lengkap</th>
            <th>Detail</th>
            <th>Status Kepegawaian</th>
            <th>Posisi Pelaku Pengadaan</th>
            <th>Jenis Jabatan</th>
            <th>Nama Jabatan</th>
            <th>Golongan Terakhir</th>
            <th>Tempat Kerja/Instansi</th>
            <th>Pemerintah (Kota/Kabupaten)</th>
            <th>Alamat Lengkap Kantor</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1; ?>
        @foreach($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->member->no_hp}}</td>
            <td>{{$d->email}}</td>
            <td>{{$d->nik ? "'".$d->nik : '-'}}</td>
            <td>{{$d->nip ? "'".$d->nip : '-'}}</td>
            <td>{{$d->member->pendidikan_terakhir}}</td>
            <td>{{$d->member->tempat_lahir}}</td>
            <td>{{$d->member->tgl_lahir}}</td>
            <td>{{$d->member->alamat_lengkap}}</td>
            <?php            
            if ($d->member->alamatProvinsi) {
                $formatDetail = 'Provinsi : '.$d->member->alamatProvinsi->nama;
            }else{
                $formatDetail = '';
            }
            if ($d->member->alamatKota) {
                $formatDetail .= 'Kota : ' .$d->member->alamatKota->kota;
            }
            if ($d->member->alamatKecamatan) {
                $formatDetail .= 'Kecamatan : ' .$d->member->alamatKecamatan->kecamatan;
            }
            if ($d->member->alamatKelurahan) {
                $formatDetail .= 'Kelurahan : ' .$d->member->alamatKelurahan->kelurahan;
            }
            ?>
            <td>{{$formatDetail}}</td>
            <td>{{$d->member->memberKantor->status_kepegawaian}}</td>
            <td>{{$d->member->memberKantor->posisi_pelaku_pengadaan}}</td>
            <td>{{$d->member->memberKantor->jenis_jabatan}}</td>
            <td>{{$d->member->memberKantor->nama_jabatan}}</td>
            <td>{{$d->member->memberKantor->golongan_terakhir}}</td>
            <td>{{$d->member->memberKantor->nama_instansi}}</td>
            <td>{{$d->member->memberKantor->pemerintah_instansi}}</td>
            <td>{{$d->member->memberKantor->alamat_kantor_lengkap}}</td>
        </tr>
        @endforeach
    </tbody>
</table>