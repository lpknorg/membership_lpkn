<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('template/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset('frontend/css/navbar.css')}}?version=0">
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?version=0">
  <link rel="stylesheet" href="{{asset('frontend/css/artikel/list.css')}}?version=0">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/logo_icon.png')}}">
  <style>
    .fa-heart{
      transition: 0.6s;
    }
    .fa-heart:hover{
      cursor: pointer;
      color: #eb3e3e;
    }
  </style>
  <title>Artikel</title>
</head>
<body>

  @include('member.layouts.navbar')
  <div class="container con_full mb-4">
    <div class="row mt-2 sm-reverse">
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{ucfirst($curr_user->name)}}  </h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Total Artikel</b> <a class="float-right">{{$data->total()}}</a>
              </li>
              <li class="list-group-item">
                <b>Total Suka</b> <a class="float-right">{{$datalike}}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card card-primary mt-3">
          <div class="card-header">
            <h5 class="card-title">About Me</h5>
            <p>{{$curr_user->deskripsi_diri ?? '-'}} </p>
          </div>
          <div class="card-body">
            <strong><i class="fa fa-at mr-1"></i> Email</strong>
            <p class="text-muted">{{$curr_user->email}}</p>
            <p class="text-muted">Bergabung {{$curr_user->tgl_bergabung}}</p>
          </div>
        </div>
      </div>
      <div class="col-md-9 mb-4 mb-md-0">
        <h1 class="h_artikel">List Artikel</h1>
        <hr class="h_line mt-0">
        <form action="">
          @csrf
          <div class="row align-items-center">
            <div class="col-12 col-sm-3 mb-2 mb-md-0">
              <input type="text" class="form-control" name="q" placeholder="Cari disini ..." value="{{\Request::get('q')}}">
            </div>
            <div class="col-6 col-sm-3">
              <select name="kategori" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $a)
                <option value="{{$a->id}}">{{$a->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6 col-sm-3">
              <select name="tahun" class="form-control">
                <option value="">Pilih Tahun</option>
              </select>
            </div>
            <div class="col-12 col-sm-3 mt-2 mt-md-0">
              <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            </div>
          </div>
        </form>
        @foreach($data as $d)
        <div class="card mt-3">
          <div class="row list_artikel_card">
            <div class="col-sm-5">
              <div class="list_art_out_img">
                <img class="list_art_in_img position-relative" src="{{\Helper::showImage($d->cover, 'artikel/cover')}}" alt="">
                <div class="position-absolute" style="bottom: 20px;">
                  <span class="list_artikel_category">
                    {{$d->kategoris->nama ?? '-'}}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-sm-7">
              <div class="p-2 d-flex align-items-stretch flex-wrap list_artikel_sm_7">
                <div class="d-flex align-items-center">
                  <div>
                    <a class="list_artikel_out"><img class="list_artikel_in" src="{{\Helper::showImage($d->user->member->foto_profile, 'poto_profile')}}" alt="User profile picture"></a>
                  </div>
                  <div class="">
                    <div class="artikel_short_name px-2">{{$d->user->name}}</div>
                    <div class="artikel_short_date px-2">{{$d->created_at}} | {{$d->created_at->diffForHumans()}}</div>
                  </div>
                </div>
                <div class="">
                  <a class="list_artikel_title" href="{{route('artikel.detail', ['uname' => \Helper::getUname($d->user) ,'slug' => $d->slug])}}">
                    {{$d->judul}}
                  </a>
                </div>
                <div class="d-flex align-items-end ml-auto">
                  <div class="text-67"> <i class="fa-regular fa-eye"></i> 123</div>
                  <div class="text-67 mx-4">
                    @if($d->is_liked_artikel > 0)
                    <i class="fa-solid fa-heart" data-slug="{{$d->slug}}" style="color: #ff5f5f"></i>
                    @else
                    <i class="fa-solid fa-heart" data-slug="{{$d->slug}}"></i>
                    @endif
                    <span data-liketotal_slug="{{$d->slug}}">{{$d->artikelLikes->count()}}</span></div>
                    <div class="text-67"> <i class="fa-solid fa-message"></i> {{$d->artikelKomens->count()}}</div>
                  </div>
                </div>
                <!-- <a href="#" class="btn btn-primary btn-sm float-right">Read More</a> -->
              </div>
            </div>
          </div>
          @endforeach
          <div class="float-right mt-3">
            {{$data->links()}}
          </div>
        </div>
      </div>


      @include('Frontend.body.footer')
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <script src="{{asset('js/custom.js')}}"></script>
      <script>
        $(document).ready(function(){
          $('body').on('click', '.fa-heart', function(){
            let _slug = $(this).attr('data-slug')
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('[name=_token]').val()
              }
            });
            $.ajax({
              type: 'post',
              url: '{{route('artikel.like.store')}}',
              data: {
                slug: _slug
              },
              beforeSend: function() {

              },
              success: function(data) {
                $(`[data-liketotal_slug="${_slug}"]`).text(data.count_likes)
                if( $(`[data-slug="${_slug}"]`).css('color') == 'rgb(255, 95, 95)' ){
                  $(`[data-slug="${_slug}"]`).css('color', '#676767')
                }else{
                  $(`[data-slug="${_slug}"]`).css('color', '#ff5f5f')
                }
                showAlert(data.messages)
              },
              error: function(data) {
                var data = data.responseJSON;

                if (data.status == "fail") {
                  showAlert(data.messages, "error")
                }

              },
              complete: function() {
                // sendAjax('#btnKomentar', true, 'Simpan')
              }                
            });
          })
        })
      </script>
    </body>
    </html>
