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
	<form method="POST" action="{{route('member_profile.update_profile')}}" id="formUpdateProfile">
		@csrf
		<input type="hidden" value="{{$user->id}}" name="id_user">
		<hr class="mb-2 mt-0">
		<div class="row">
            <div class="col-sm-7 mb-4">
                <label>Password lama</label>
                <div class="input-group">
                    <input id="pass_old" class="form-control" type="password" placeholder="Masukan password lama">
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
                    <input id="pass_new" class="form-control" type="password" placeholder="Masukan password baru">
                    <div class="input-group-append">
                        <span class="input-group-text bg-white">
                        <i id="eye" class="fa fa-eye-slash" onclick="newPass()"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 mb-4">
                <label>Konfirmasi password baru</label>
                <div class="input-group">
                    <input id="pass_con" class="form-control" type="password" placeholder="Masukan konfirmasi password baru">
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
<script>
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
@section('scripts')
@endsection
