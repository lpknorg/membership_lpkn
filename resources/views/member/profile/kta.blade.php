
<style>
    .kta-depan{
        background-image: url("{{public_path('img/kta_front.jpg')}}");
        background-repeat: repeat-x;
        object-fit: contain;
        background-size: contain;
        background-repeat: no-repeat;
    }
</style>

<?php
$str = $users[0]->created_at;
$date  = strtotime($str);
$nomor_kta = "LPKN-".$users[0]->id.date('d',$date).date('m',$date).date('Y',$date)
?>
   <body>
        <table width="100%" style="margin-left: 0px;">
            <tr>
                <td width="50%">
                    <table >
                        <tr>
                            <td  class="kta-depan">
                                <table width="100%" style="padding-top: 22px;">
                                    <tr>
                                        <td width="50%">
                                            <h1 style="color: #031d47;padding-top:10px;padding-left:13px;font-size:11px;font-weight: bold;font-family: , sans-serif;">
                                                NO KTA : {{ $nomor_kta }}
                                            </h1>
                                            <h1 style="color: #031d47;padding-left:13px;font-size:14px;font-weight: bold;font-family: 'Gill Sans Extrabold',sans-serif;">{{strtoupper($users[0]->nama_member)}}</h1>
                                            <h1 style="color: #031d47;padding-left:13px;font-size:11px;font-weight: bold;font-family: 'Gill Sans Extrabold',sans-serif;text-align: justify;">{{strtoupper($users[0]->nama_instansi)}}</h1>
                                            <h1 style="color: #031d47;padding-left:13px;font-size:11px;font-weight: bold;font-family: 'Gill Sans Extrabold',sans-serif;text-align: justify;">{{strtoupper('anggota')}}</h1>
                                        </td>
                                        <td width="50%">
                                            <table width="100%" tyle="padding-top: 22px;" >
                                                <tr>
                                                    <td width="30%">
                                                    </td>
                                                    @if($users[0]->foto_profile)
                                                    <td width="70%">
                                                        <img src="{{public_path('uploaded_files/poto_profile/'.$users[0]->foto_profile)}}" alt="foto_profile" style="width:71px;height:90px;padding-left:8px;padding-top:45px;">
                                                    </td>
                                                    @else
                                                    <td width="70%">
                                                        <img src="{{public_path('default.png')}}" style="width:71px;height:90px;padding-left:8px;padding-top:45px;">
                                                    </td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td width="50%">
                                                    </td>
                                                    <td width="50%">
                                                        <table>
                                                            <tr>
                                                                <td width="230%"></td>
                                                                <td width="60%">
                                                                    <div style="padding: 5px 0 0 10px;">
                                                                        <div style="padding: 3px;background:#fff;border-style: solid;">
                                                                                {!! DNS2D::getBarcodeHTML($users[0]->nama_member, 'QRCODE',1.5, 1.5) !!}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="10%"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td  width="50%">
                </td>
            </tr>
            <tr>

            </tr>
        </table>
        <table >
            <tr>
                <td  width="50%">
                    <img src="{{public_path('img/kta_belakang.jpg')}}" width="100%" >
                </td>
                <td  width="50%">
                </td>
            </tr>
        </table>
   </body>
