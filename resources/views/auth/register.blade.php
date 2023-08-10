@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('api.daftar_member') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">No HP</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No HP">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="regisbtn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
    // Set the options that I want
    $('form').submit(function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('[name=_token]').val()
        }
      });

      $.ajax({
        type: 'post',
        url: $(this).attr("action"),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function() {
          sendAjax('#regisbtn', false)
        },
        success: function(data) {
          console.log(data)
          if (data.status == "ok") {
            showAlert(data.messages)
            setTimeout(function() {
              location.href = '/login'
            }, 1000);
          }
        },
        error: function(data) {
          var data = data.responseJSON;
          console.log(data.messages)

          if (data.status == "fail") {
            showAlert(data.messages, "error")
          }
        },
        complete: function() {
          sendAjax('#regisbtn', true, 'Register')
        }
      });
    });
  </script>
@endsection
