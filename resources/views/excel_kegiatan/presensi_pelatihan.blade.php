<img src="{{$imgKop}}" style="height: 130px;">
<table style="width:100%">
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="{{$colJudul}}">
                DAFTAR HADIR PESERTA PELATIHAN
            </td>            
        </tr>
        <tr>
            <td colspan="{{$colJudul}}">
                Pelatihan dan Seritifikasi Kompetensi
            </td>            
        </tr>
        <tr>
            <td colspan="{{$colJudul}}">
                PENGADAAN BARANG / JASA PEMERINTAH (PBJP) LEVEL - 1
            </td>            
        </tr>
        <tr>
            <td colspan="{{$colJudul}}">
                (48 JP Model Pembelajaran Blended Learning)
            </td>
        </tr>
        <tr>
            <td>TANGGAL</td>
            <td>: {{$tglPelaksanaan}}</td>
        </tr>
        <tr>
            <td>LOKASI</td>
            <td>: INI LOKASI GES</td>
        </tr>
        <tr>
            <td>LPP</td>
            <td>: Lembaga Pengembangan dan Konsultasi Nasional</td>
        </tr>
        <tr>
            <td>JML PESERTA</td>
            <td>: {{count($data)}} Peserta</td>
        </tr>
        <tr>
            <th style="border: 1px solid #000;" rowspan="3">NO</th>
            <th style="border: 1px solid #000;" rowspan="3">PESERTA</th>
            <th colspan="{{$colPresensi}}" style="border: 1px solid #000;">PRESENSI</th>
        </tr>
        <tr>
            @foreach($range_tgl as $r => $val)
            <th style="border: 1px solid #000;" colspan="2">{{$val['tanggal_penuh']}}</th>
            @endforeach
        </tr>
        <tr>
            @foreach($range_tgl as $r => $val)
            <td style="border: 1px solid #000;">Sesi Pagi</td>
            <td style="border: 1px solid #000;">Sesi Siang</td>
            @endforeach
        </tr>
    </thead>
    <tbody>   
        <?php $no = 1;        
        ?>  
        @foreach($data as $u)  
        <tr>
            <td style="border: 1px solid #000;" rowspan="4">{{ $no++ }}</td> 
            <td style="border: 1px solid #000;"></td>            
        </tr>
        <tr>
            <td style="border: 1px solid #000;">{{ $u->nama }}</td>            
        </tr>
        <tr>
            <td style="border: 1px solid #000;">{{"'".$u->nik}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">{{$u->asal_instansi}}</td>
        </tr>
        @endforeach
    </tbody>
</table>