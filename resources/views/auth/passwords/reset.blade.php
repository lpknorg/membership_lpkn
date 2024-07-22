<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Reset Password</title>
</head>
<style>
  @import url("https://fonts.googleapis.com/css?family=Roboto");
  body {
    font-family: "Roboto", sans-serif;
}

.auth__header {
    padding: 13vh 1rem calc(11vh + 35px);
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
    background-image: linear-gradient(#3280e4, #584dc3);
    background-size: cover;
    background-position: center center;
    position: relative;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
}
.auth__header:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
}
.auth__logo {
    position: relative;
    z-index: 18;
    background: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}
.auth__body {
    padding-bottom: 2rem;
}
.auth__form {
    min-width: 280px;
    max-width: 460px;
    margin: auto;
    margin-top: -40px;
    padding: 0 10px;
    position: relative;
    z-index: 9;
}
.auth__form_body {
    padding: 0.7rem 1.5rem 35px;
    border-radius: 0.5rem;
    background: #fff;
    border: 1px solid #eee;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}
.auth__form_title {
    font-size: 1.3rem;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
}
.auth__form_actions {
    text-align: center;
    padding: 0 2rem;
    margin-top: -25px;
}
.auth__form_actions .btn {
    border-radius: 30px;
    box-shadow: 0 2px 12px rgba(50, 128, 228, 0.5);
}
</style>
<body>
    <div class="auth">
        <div class="auth__header">
            <div class="auth__logo">
                <img height="90" src="{{asset('img/logolpkn.png')}}" alt="">
            </div>
        </div>
        <div class="auth__body">
            <form method="POST" action="{{ route('lupa_password.update_password') }}" class="auth__form">
                @csrf
                <div class="auth__form_body">
                    <h3 class="auth__form_title">Reset Password</h3>
                    <div>
                        <input type="hidden" value="{{$user->token_reset_password}}" name="user_id">
                        <div class="form-group">
                            <label class="text-uppercase small">Password Baru</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan Password">
                            <i class="m-i far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase small">Konfirmasi Password</label>
                            <input id="password_konfirmasi" type="password" class="form-control" name="password_konfirmasi" placeholder="Masukkan Password Konfirmasi">
                            <i class="m-i far fa-eye" id="togglePassword2" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <div class="auth__form_actions">
                    <button class="btn btn-primary btn-lg btn-block" id="resetbtn">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        if(password.getAttribute('type') === 'password'){
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        }else{
            this.classList.add('fa-eye');
            this.classList.remove('fa-eye-slash');
        }   
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);             
    });

    const togglePassword2 = document.querySelector('#togglePassword2');
    const password_k = document.querySelector('#password_konfirmasi');
    
    togglePassword2.addEventListener('click', function (e) {
        // toggle the type attribute
        if(password_k.getAttribute('type') === 'password'){
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        }else{
            this.classList.add('fa-eye');
            this.classList.remove('fa-eye-slash');
        }   
        const type = password_k.getAttribute('type') === 'password' ? 'text' : 'password';
        password_k.setAttribute('type', type);
              
    });
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
</html>