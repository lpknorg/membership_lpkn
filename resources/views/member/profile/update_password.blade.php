@extends('member.layouts.template')
@section('content')
<style>
	.text-warning{
		color: #f5943d!important;
	}
</style>
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Update Password
	</h5>
	<form method="POST" action="{{route('member_profile.update_password')}}" id="formUpdatePassword">
		@csrf
		<input type="hidden" value="{{$user->id}}" name="id_user">
		<hr class="mb-2 mt-0">
		<div class="row">
            <div class="col-sm-7 mb-4">
                <label>Password lama</label>
                <div class="input-group">
                    <input id="pass_old" class="form-control" type="password" placeholder="Masukan password lama" name="password_lama">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white">
                            <i id="eye" class="fa fa-eye-slash" onclick="oldPass()"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 mb-4">
                <label>Password baru</label>
                <div class="input-group">
                    <input id="pass_new" class="form-control" type="password" placeholder="Masukan password baru" name="password_baru">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white">
                            <i id="eye" class="fa fa-eye-slash" onclick="newPass()"></i>
                        </span>
                    </div>
                </div>
                    <span class="text-warning" style="font-size: 14px;">Password minimal memiliki 8 karakter</span>
            </div>
            <div class="col-sm-7 mb-4">
                <label>Konfirmasi password baru</label>
                <div class="input-group">
                    <input id="pass_con" class="form-control" type="password" placeholder="Masukan konfirmasi password baru" name="password_konfirmasi">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white">
                            <i id="eye" class="fa fa-eye-slash" onclick="conPass()"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="btnsubmit">Update Password</button>
    </form>

</div>
@endsection
@section('scripts')
<script>
    $('#formUpdatePassword').submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name=_token]').val()
            }
        });

        var form_data = new FormData($(this)[0]);
        $.ajax({
            type: 'post',
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                sendAjax('#btnsubmit', false)
            },
            success: function(data) {
                console.log(data)
                if (data.status == "ok") {
                    showAlert(data.messages)
                    setTimeout(function() {
                        location.reload()
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
                sendAjax('#btnsubmit', true, 'Update Password')
            }
        });
    });
    function oldPass() {
        var input = document.getElementById("pass_old");
        if (input.type === "password") {
            input.type = "text";
            document.getElementById("eye").className = "fa fa-eye";
        } else {
            input.type = "password";
            document.getElementById("eye").className = "fa fa-eye-slash";
        }
    }
    function newPass() {
        var input = document.getElementById("pass_new");
        if (input.type === "password") {
            input.type = "text";
            document.getElementById("eye").className = "fa fa-eye";
        } else {
            input.type = "password";
            document.getElementById("eye").className = "fa fa-eye-slash";
        }
    }
    function conPass() {
        var input = document.getElementById("pass_con");
        if (input.type === "password") {
            input.type = "text";
            document.getElementById("eye").className = "fa fa-eye";
        } else {
            input.type = "password";
            document.getElementById("eye").className = "fa fa-eye-slash";
        }
    }
</script>
@endsection