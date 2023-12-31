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
  @include('pages.artikel.list_artikel')

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
