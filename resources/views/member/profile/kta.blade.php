
<style>
    body{
        background-image: url("{{public_path('img/depan_cetak.jpg')}}");
        background-repeat: repeat-x;
        object-fit: contain;
        background-size: contain;
        background-repeat: no-repeat;
        max-width: 100%;
    }
</style>
   <body>
        <div>
            <table width="49%">
                <tr>
                    <td>
                    <table width="49%">
                        <tr>
                            <td>
                                @if($user->member->pas_foto3x4)
                                <img src="{{public_path('uploaded_files/pas_foto/'.$user->member->pas_foto3x4)}}" alt="depan_cetak" style="width:60px;height:82px;padding-left:27px;padding-top:77px;">
                                @else
                                <img src="{{public_path('default.png')}}" alt="depan_cetak" style="width:60px;height:82px;padding-left:27px;padding-top:77px;">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 5px; padding-left:25px;">
                                {!! DNS2D::getBarcodeHTML("$user->name", 'QRCODE',2.7,1.8) !!}
                            </td>
                        </tr>
                    </table>
                    </td>
                    <td>
                        <table width="100%">
                            <tr>                    
                                <td colspan="2">
                                    <h6 style="padding-left:80px;padding-top:35px;color:#FFF;">{{$user->email}}</h6>
                                    <h6 style="padding-left:100px;padding-bottom:50px;color:#FFF;">LPKN-1234</h6>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                       
                    </td>
                </tr>
            </table> 
        </div>
   </body>
