<table style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>PESERTA</th>
        </tr>
    </thead>
    <tbody>   
        <?php $no = 1;        
        ?>  
        @foreach($data as $u)  
        <tr>
            <td rowspan="4">{{ $no++ }}</td>             
            <td></td>
        </tr>
        <tr>
            <td>{{ $u->userDetail->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
        </tr>
        <tr>
            <td>{{$u->nama_instansi}}</td>
        </tr>
        @endforeach
    </tbody>
</table>