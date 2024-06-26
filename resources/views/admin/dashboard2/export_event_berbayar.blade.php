<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tgl Start</th>
            <th>Tgl End</th>
            
            <th>Nama Panitia</th>
            <th>Link</th>
            <th>Lokasi Event</th>
            <th>Jumlah Peserta</th>
            <th>Status Event</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1; ?>
        @foreach($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$d['jenis']}}</td>
            <td>{{$d['judul']}}</td>
            <td>{{$d['jenis_kelas'] == 1 ? 'Tatap Muka' : 'Online'}}</td>
            <td>{{\Helper::changeFormatDate($d['tgl_start'])}}</td>
            <td>{{\Helper::changeFormatDate($d['tgl_end'])}}</td>
            <td>{{$d['nama_panitia']}}</td>
            <td><a href="{{$d['link_slugg']}}">Menuju Link</a></td>
            <td>{{$d['lokasi_event'] ?: '-'}}</td>
            <td>{{$d['jumlah_peserta']}}</td>
            <td>
                @if($d['status'] == '0')
                Proses
                @elseif($d['status'] == '1')
                Aktif
                @elseif($d['status'] == '2')
                Tidak Aktif
                @elseif($d['status'] == '3')
                Batal
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>