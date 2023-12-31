<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- start testimoni -->
    <!-- MAGNIFIC POPUP-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <!-- jQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- DATATABLES BS 4-->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP 4-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <!-- end testimoni -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('template/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frontend/css/navbar.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/testimoni.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/artikel/list.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/artikel/detail.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/aside.css')}}?version=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/logo_icon.png')}}">
    <!-- start slick -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>
    <!-- end slick -->
    <title>{{ucfirst($artikel->judul)}}</title>
</head>
<body>

    @include('member.layouts.navbar')
    <div class="container con_full mb-4">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="h_artikel">  </h1>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <b>Ini adalah halaman preview artikel</b>
                       </div>
                   </div>
                   <div class="col-md-12 mt-3">
                      <span class="detail_artikel_title">{{ucfirst($artikel->judul)}}</span>
                    <div class="d-flex justify-content-between flex-wrap mt-2">
                        <p class="small">{{\Helper::changeFormatDate($artikel->created_at, 'd-M-Y H:i:s')}} |
                            Dibuat oleh : {{ucfirst($artikel->user->name)}}
                        </p>
                        <p class="small">
                            <span class="mr-2"><i class="fa-regular fa-eye"></i> {{$artikel->views}}</span>
                            <a href="#add_comment" class="text-decoration-none"><i class="fa-solid fa-message"></i><span id="countKomentar">&nbsp;{{$artikel->artikelKomens->count()}}</span></a>
                            <span class="ml-1"><i class="fa-regular fa-heart">&nbsp;</i>{{$artikel->artikelLikes->count()}}</span>
                        </p>
                    </div>
                    @foreach($artikel->artikelTags as $t)
                    <a href="" class="badge badge-secondary px-4 rounded-0 py-2 mb-2">{{$t->nama_tag}}</a>
                    @endforeach                    
                </div>
                <div class="col-md-12 mt-3">
                  <div id="carouselTesti" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($artikel->artikelFoto as $k => $f)
                        <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                            <a href="{{\Helper::showImage($f->file, 'artikel/gambar_slider')}}" class="testimoni-popup artikel_detail_out_slider">
                                <img class="testi_img d-block w-100 artikel_detail_in_slider" src="{{\Helper::showImage($f->file, 'artikel/gambar_slider')}}" alt="Image 1">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselTesti" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselTesti" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
                {{-- @foreach($artikel->artikelFoto as $f)
                <img class="d-block w-100" src="{{\Helper::showImage($f->file, 'artikel/gambar_slider')}}" alt="" style="min-height: 100px;max-height: 140px;">
                @endforeach --}}
            </div>
            <div class="col-md-12 mt-3">
              {!! $artikel->deskripsi !!}
          </div>
      </div>
  </div>
  <div class="col-md-4">
    <div class="row">
     <div class="col-md-12">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati omnis deserunt porro asperiores a velit incidunt, iste. Nisi ab veritatis alias provident, repudiandae porro, exercitationem! Commodi recusandae adipisci optio, corporis.
      INI IKLAN NANTI
  </div>
</div>

</div>
</div>
</div>
@include('Frontend.body.footer')
<!-- Optional JavaScript -->
<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- start slick --}}
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<!-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
{{-- end slick --}}

<script src="{{asset('js/custom.js')}}"></script>
<script  src="{{asset('frontend/js/testimoni.js')}}"></script>

</body>
</html>