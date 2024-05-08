<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Link Sertifikat</th>
            <th>Waktu Pelaksaan</th>
            <th>Panitia</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1; ?>
        @foreach($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$d['judul']}}</td>
            <td><a href="{{$d['link']}}">Menuju Link</a></td>
            <td>{{\Helper::changeFormatDate($d['created_at'], 'd-M-Y')}}</td>
            <td>{{$d['panitia']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>