<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset('frontend/css/login.css')}}?version=0">
  @include('meta')
</head>
<body class="bg-all">
    <div class="login-wrap">
        <div class="login-image">
            <nav class="login-image-nav">
                <ul>
                    <li><a class="logo" href="{{url('/')}}"><img src="https://event.lpkn.id/assets_page/images/logo/logolpkn_putih.png" alt=""></a></li>
                </ul>
            </nav>
            <div class="login-image-text">
                <p class="text-lg text-white roboto"><span class="mantap"> L<span class="warna-merah">P</span>KN</span></p>
                <br>
                <h4 class="text-white w-70">
                    Lembaga pendidikan resmi yang memiliki
                    sejumlah identitas dan legalitas sesuai
                    dengan bidang usaha.
                </h4>
            </div>
            <nav class="login-image-footer">
                <ul>
                    <li>
                        <a href="https://wa.me/628111464659?text=Hallo%20Admin.">
                            <span class="text-white">Admin 1: </span><span class="warna-biru font-weight-semi-bold">0811-1464-659</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/628119523022?text=Hallo%20Admin.">
                            <span class="text-white">Admin 2: </span><span class="warna-biru font-weight-semi-bold">0811-9523-022</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('login_regis')
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
    @yield('log_reg_js')
</html>
