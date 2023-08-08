@extends('member.layouts.template')
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Update Profile Member
	</h5>
	<form method="POST" action="{{route('api.daftar_member')}}">
		@csrf
		<h4><b> Data Pribadi</b></h4>
		<hr class="mb-2 mt-0">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>No HP</label>
					<input type="number" class="form-control" name="no_hp" placeholder="Masukkan No Handphone">
					<span><small class="text-warning">Pastikan No Hp memiliki whatsapp</small></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" placeholder="Masukkan Email">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" placeholder="Masukkan Password">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" id="btnsubmit">Daftar</button>

	</form>
	
</div>
@endsection
@section('scripts')
@include('js/custom_script')
<script>
	$(document).ready(function(){
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
				beforeSend: function() {
					sendAjax('#btnsubmit', false)
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						showAlert(data.messages)
						setTimeout(function() {
							location.href = '/'
						}, 1000);
					}
				},
				error: function(data) {
					console.log(data)
					var data = data.responseJSON;

					if (data.status == "fail") {
						showAlert(data.messages, "error")
					}
				},
				complete: function() {
					sendAjax('#btnsubmit', true, 'Daftar')
				}
			});
		});
	})
</script>
@endsection