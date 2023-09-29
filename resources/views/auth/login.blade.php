@extends('auth.first')
@section('login_regis')
<div class="login-card">
  <div class="login-card-header">
    <h1 class="font-weight-bold text-white">Selamat Datang</h1>
  </div>
  <p class="text-muted">Dapatkan Ilmunya Raih Hadiahnya</p>
  <form method="POST" action="{{ route('login') }}" class="auth__form login-card-form">
    @csrf
    <input type="hidden" name="slug_log" value="{{\Request::get('slug')}}">
    <div class="input-group">
      <input type="text" id="email" placeholder="Masukkan email" name="email" value="{{ old('email') }}" autofocus>
      <i class="m-i fa-regular fa-envelope"></i>
    </div>
    <div class="input-group mb-1">
      <input id="password" type="password" name="password" placeholder="Masukkan Password">
      <i class="m-i far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
    </div>
    <div class="d-flex justify-content-end">
      <a href="" id="btnLupaPassword" class="btn-flat">Lupa password</a>
    </div>
    <div class="mt-4">
      <button type="submit" id="loginbtn" vlaue="Submit" class="btn btn-primary">Masuk</button>
    </div>
  </form>
  <a href="{{route('register')}}" class="btn-flat mt-4">
    Daftar
  </a>
  <div class="login-card-footer">
    <p class="text-muted">&copy; 2023 Copyright : LPKN Training Center</p>
  </div>
</div>

<div class="modal fade" id="modalLupaPassword" tabindex="-1" role="dialog" aria-labelledby="modalLupaPasswordLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-all">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="modalLupaPasswordLabel">Form Lupa Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;text-shadow: 0 1px 0 red;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('lupa_password.send_link')}}" id="formLupaPassword">
          <div class="input-group mb-4 mt-4">
            <input type="email" name="email" placeholder="Masukan email terdaftar" required>
            <i class="m-i fa-regular fa-envelope"></i>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('log_reg_js')
<script>
    // Set the options that I want
  $('.auth__form').submit(function(e) {
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
        sendAjax('#loginbtn', false)
      },
      success: function(data) {
        console.log(data)
        if (data.status == "ok") {
          showAlert(data.messages)
          setTimeout(function() {
            location.href = data.redirect_to            
          }, 1000);
        }
      },
      error: function(data) {
        var data = data.responseJSON;

        if (data.status == "fail") {
          showAlert(data.messages, "error")
        }
      },
      complete: function() {
        sendAjax('#loginbtn', true, 'Login')
      }
    });
  });
  $('#btnLupaPassword').click(function(e){
    e.preventDefault()
    $('#modalLupaPassword').modal('show')
  })
  @if(\Session::get('exception_resetp'))
  showAlert('{{\Session::get('exception_resetp')}}', "error")
  @endif
  @if(\Session::get('success_verify_email'))
  showAlert('{{\Session::get('success_verify_email')}}')
  @endif
  @if(\Session::get('exception_verify_password'))
  showAlert('{{\Session::get('exception_verify_password')}}', "error")
  @endif
  $('#modalLupaPassword #formLupaPassword').submit(function(e) {
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
        sendAjax('#modalLupaPassword button[type=submit]', false)
      },
      success: function(data) {
        console.log(data)
        if (data.status == "ok") {
          showAlert(data.messages)
          setTimeout(function() {
            window.location.reload()
          }, 1000);
        }
      },
      error: function(data) {
        var data = data.responseJSON;

        if (data.status == "fail") {
          showAlert(data.messages, "error")
        }
      },
      complete: function() {
        sendAjax('#modalLupaPassword button[type=submit]', true, 'Kirim link')
      }
    });
  });
</script>
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
        // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
@endsection

