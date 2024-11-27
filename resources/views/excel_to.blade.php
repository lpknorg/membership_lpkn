<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20%">Nama Lengkap</th>
            <th>NIK</th>
            <th>Email Aktif</th>
            <th>No Whatsapp</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>NIP</th>
            <th>Nama Instansi Lengkap</th>
            <th>Unit Organisasi</th>
            <th>Alamat Lengkap Kantor</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1;        
        ?>
        @foreach($data as $u)
        <tr style="background-color: #ef838a !important;">
            <td>{{ $no++ }}</td>
            <td>{{$u->userDetail->name}}</td>
            <td>{{"'".$u->userDetail->nik}}</td>
            <td>{{$u->userDetail->email}}</td>
            <td>
                @if(substr($u->userDetail->member->no_hp, 0, 1) != 0)
                {{'0'.$u->userDetail->member->no_hp}}
                @else
                {{$u->userDetail->member->no_hp}}
                @endif
            </td>
            <td>{{$u->userDetail->member->tempat_lahir}}</td>
            <td>
                <?php
                $bulan = \Helper::changeFormatDate($u->userDetail->member->tgl_lahir, 'n');
                $expl = explode("-", $u->userDetail->member->tgl_lahir);
                if(count($expl) > 1){
                    $content = $expl[2].' '.\Helper::bulanIndo($bulan).' '.$expl[0];
                }else{
                    $content = $u->userDetail->member->tgl_lahir;
                }
                ?>
                {{$content}}
            </td>
            <td>{{ $u->userDetail->nip ? "'".$u->userDetail->nip : '-'}}</td>
            <td>{{$u->userDetail->member->memberKantor->nama_instansi}}</td>
            <td>{{$u->userDetail->member->memberKantor->unit_organisasi}}</td>
            <td>{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</td>
        </tr>
        @endforeach
    </tbody>
</table>