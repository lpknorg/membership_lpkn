<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Password LKPP</th>
            <th width="20%">Nama Lengkap(tanpa gelar)</th>
            <th>Nama Lengkap(dengan gelar)</th>
            <th>NIK</th>
            <th>Email Aktif</th>
            <th>No Whatsapp</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>Pendidikan Terakhir</th>
            <th>Nama Pendidikan Terakhir</th>
            <th>Status Kepegawaian</th>
            <th>Posisi Pelaku Pengadaan</th>
            <th>Jenis Jabatan</th>
            <th>Nama Jabatan</th>
            <th>Golongan Terakhir</th>
            <th>NIP</th>
            <th>NRP</th>
            <th>Nama Instansi Lengkap</th>
            <th>Unit Organisasi</th>
            <th>Alamat Lengkap Kantor</th>
            <th>Kode Pos</th>
            <th>Paket Kontribusi</th>
            <th>Pas Foto</th>
            <th>KTP</th>
            <th>SK ASN</th>
            <th>Waktu Dibuat</th>
        </tr>
    </thead>
    <tbody>       
        <?php $no = 1;        
        ?>
        @foreach($data as $u)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{\Helper::passHashedDecrypt($u->userDetail->password_lkpp)}}</td>
            <td>{{$u->userDetail->name}}</td>
            <td>{{$u->userDetail->member->nama_lengkap_gelar}}</td>
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
            <td>{{$u->userDetail->member->pendidikan_terakhir}}</td>
            <td>{{$u->userDetail->member->nama_pendidikan_terakhir}}</td>
            <td>{{$u->userDetail->member->memberKantor->status_kepegawaian}}</td>
            <td>{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</td>
            <td>{{$u->userDetail->member->memberKantor->jenis_jabatan}}</td>
            <td>{{$u->userDetail->member->memberKantor->nama_jabatan}}</td>
            <td>{{$u->userDetail->member->memberKantor->golongan_terakhir}}</td>
            <td>{{ $u->userDetail->nip ? "'".$u->userDetail->nip : '-'}}</td>
            <td>{{ $u->userDetail->nrp ? "'".$u->userDetail->nrp : '-'}}</td>
            <td>{{$u->userDetail->member->memberKantor->nama_instansi}}</td>
            <td>{{$u->userDetail->member->memberKantor->unit_organisasi}}</td>
            <td>{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}</td>
            <td>{{$u->userDetail->member->memberKantor->kode_pos}}</td>
            <td>{{$u->paket_kontribusi}}</td>
            <td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>
            <td>
                @if($u->userDetail->member->foto_ktp)   
                <a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
                @else
                -
                @endif
            </td>
            <td>
                @if($u->userDetail->member->file_sk_pengangkatan_asn)
                <a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
                @else
                -
                @endif
            </td>
            <td>{{\Helper::changeFormatDate($u->created_at, 'd-m-Y H:i:s')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>