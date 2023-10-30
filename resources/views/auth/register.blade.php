@extends('auth.first')
@section('login_regis')
<div class="login-card">
    <div class="login-card-header">
        <h1 class="font-weight-bold text-white">Buat Akunmu</h1>
    </div>
    <p class="text-muted">Daftar & mulai sekarang</p>
    <a class="mt-1" href="{{route('downloadFile', ['file' => 'manual-book.pdf', 'folder' => 'modul'])}}">Download Manual Book</a>
    <form method="POST" action="{{ route('api.daftar_member') }}" class="auth__form login-card-form" autocomplete="off">
        @csrf
        <div class="input-group">
            <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" autofocus>
            <i class="m-i fa fa-user"></i>
        </div>
        <div class="input-group mb-0">
            <input type="number" placeholder="No Hp (co: 08146728112)" name="no_hp">
            <i class="m-i fa-brands fa-whatsapp"></i>
        </div>
        <div class="text-left mb-2">
            <small class="text-warning">Nomor harus memiliki Whatsapp</small>
        </div>
        <div class="input-group">
            <input id="email" type="email"  placeholder="email" name="email">
            <i class="m-i fa-regular fa-envelope"></i>
        </div>
        <div class="input-group">
            <input id="password" type="password" name="password" placeholder="Password">
            <i class="m-i far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
        </div>

        <div class="mt-4">
            <button type="submit" id="loginbtn" vlaue="Submit" class="btn btn-primary">Daftar</button>
        </div>
    </form>
    <a href="{{route('login')}}" class="btn-flat mt-4">
        Login
    </a>    
    <div class="login-card-footer">
        <p class="text-muted">&copy; 2023 Copyright : LPKN Training Center</p>
    </div>
</div>


@endsection
@section('log_reg_js')
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
    sendAjax('#loginbtn', false)
    },
    success: function(data) {
    console.log(data)
    if (data.status == "ok") {
        showAlert(data.messages)
        setTimeout(function() {
        if (data.role == 'admin') {
            location.href = '/dashboard'
        }else{
            location.href = '/member_profile'
        }
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
    sendAjax('#loginbtn', true, 'Daftar')
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
