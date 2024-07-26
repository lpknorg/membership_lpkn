@extends('auth.first')
@section('login_regis')
    <div class="login-card">
        <div class="login-card-header">
          <h1 class="font-weight-bold text-white">Reset Password</h1>
        </div>
        {{-- <p class="text-muted">Dapatkan Ilmunya Raih Hadiahnya</p> --}}
        <form method="POST" action="{{ route('lupa_password.update_password') }}" class="auth__form login-card-form">
          @csrf
		<input type="hidden" value="{{$user->token_reset_password}}" name="user_id">
          <div class="input-group">
            <input type="password" id="password" placeholder="Password Baru" name="password">
            <i class="m-i far fa-eye" id="togglePassword1" style="cursor: pointer;"></i>
          </div>
          <div class="input-group mb-1">
            <input id="password_konfirmasi" type="password" name="password_konfirmasi" placeholder="Konfirmasi Password">
            <i class="m-i far fa-eye" id="togglePassword2" style="cursor: pointer;"></i>
          </div>
          <div class="mt-4">
            <button type="submit" id="resetbtn" value="Submit" class="btn btn-primary">Kirim</button>
          </div>
        </form> 
        <div class="login-card-footer">
          <p class="text-muted">&copy; {{date('Y')}} Copyright : LPKN Training Center</p>
        </div>
      </div>
    </div>
@endsection
@section('log_reg_js')
<script>
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password = document.querySelector('#password');
  
    togglePassword1.addEventListener('click', function (e) {
          // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
          // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
    // 
    const togglePassword2 = document.querySelector('#togglePassword2');
    const password_k = document.querySelector('#password_konfirmasi');
  
    togglePassword2.addEventListener('click', function (e) {
          // toggle the type attribute
      const type = password_k.getAttribute('type') === 'password' ? 'text' : 'password';
      password_k.setAttribute('type', type);
          // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
<script>
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
                sendAjax('#resetbtn', false)
            },
            success: function(data) {
                console.log(data)
                if (data.status == "ok") {
                    showAlert(data.messages)
                    setTimeout(function() {
                        location.href = '/login'
                    }, 2000);
                }
            },
            error: function(data) {
                var data = data.responseJSON;

                if (data.status == "fail") {
                    showAlert(data.messages, "error")
                }
            },
            complete: function() {
                sendAjax('#resetbtn', true, 'Submit')
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
</script>

@endsection