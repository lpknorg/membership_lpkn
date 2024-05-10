<table>
    <tr>
        <th>Judul : </th>
        <th>{{$data[0]['judul']}}</th>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>Instansi</th>
            <th>Unit Organisasi</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1; ?>
        @foreach($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$d['nama_lengkap']}}</td>
            <td>{{$d['no_hp']}}</td>
            <td>{{$d['email']}}</td>
            <td>{{$d['instansi']}}</td>
            <td>{{isset($d['unit_organisasi']) ? $d['unit_organisasi'] : '-'}}</td>
            <td>
                <?php
                if ($d['status_pembayaran'] == 1) {
                    $stat = 'Terverifikasi';
                }elseif ($d['status_pembayaran'] == 0 && $d['bukti_bayar']) {
                    $stat = 'Pending';
                }else{
                    $stat = 'Belum Bayar';
                }
                ?>
                {{$stat}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>