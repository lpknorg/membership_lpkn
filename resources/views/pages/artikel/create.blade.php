<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="{{ asset('template/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{asset('frontend/css/navbar.css')}}?version=0">
	<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?version=0">
	<link rel="stylesheet" href="{{asset('frontend/css/aside.css')}}?version=0">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/logo_icon.png')}}">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="{{asset('pckg/tagsjs/dist/use-bootstrap-tag.min.css')}}" />
	<script src="{{asset('pckg/tagsjs/dist/use-bootstrap-tag.min.js')}}"></script>   
	<title>Halaman Member</title>
	<style>
		.use-bootstrap-tag button{
			margin-right: 5px;
			border-radius: 5px;
		}
		input[name=tag] {
			background-color: lightblue !important;
			color: red;
		}
	</style>
</head>
<body>
	@include('member.layouts.navbar')
	<div class="container con_full mb-4">
		<div class="row mt-2 sm-reverse">
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<div class="card-body">
						<h3>Tulis Artikel</h3>
						<hr style="border: 1px solid #c1c1c1;">
						<form method="POST" action="{{route('artikel.store')}}" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
								<label for="staticEmail" class="col-sm-2 col-form-label">Cover Artikel</label>
								<div class="col-sm-4">
									<input type="file" class="form-control" name="cover" accept="image/png, image/jpeg">
								</div>
								<div class="view-cover mt-3"></div>
							</div>
							<div class="form-group row">
								<label for="staticEmail" class="col-sm-2 col-form-label">Gambar Slider</label>
								<div class="col-sm-4">
									<input type="file" class="form-control" name="gambar_slider" accept="image/png, image/jpeg" multiple id="gambar_slider">
								</div>
								<div class="view-slider mt-3"></div>
							</div>
							<div class="form-group row">
								<label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
								<div class="col-sm-4">
									<select name="kategori" class="form-control">
										<option value="1">Pilih Kategori</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Judul</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" placeholder="Judul" name="judul">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Deskripsi</label>
								<div class="col-sm-8">
									<textarea class="form-control" name="deskripsi" cols="10"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Tag</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" placeholder="Tambahkan tag ..." name="tag" id="example" data-ub-tag-max="5">
								<span class="text-warning" style="font-size: 15px;">Tekan <i>Enter</i> untuk memisahkan Tag, gunakan maksimal 5 Tag</span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-8">
									<button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
								</div>
							</div>
						</form>
					</div>
					<!-- /.card-body -->
				</div>
			</div>
		</div>
	</div>
	@include('Frontend.body.footer')




	<!-- Optional JavaScript -->

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
	<script>
		$(document).ready(function(){
			const example = UseBootstrapTag(document.getElementById('example'))
			$('[name=deskripsi]').summernote({
				height: 100,
				placeholder: 'Mulai tulis disini...'
			});

			$('body').on('change', '[name=cover]', function() {
				imagesPreview(this, `div.view-cover`);
			});
			$('body').on('change', '[name=gambar_slider]', function() {
				imagesPreview(this, `div.view-slider`);
			});
			$('form').submit(function(e) {
				e.preventDefault();
				var filesLength=document.getElementById('gambar_slider').files.length;
				var form_data = new FormData($(this)[0]);
				form_data.append('cover', $('[name=cover]').prop('files')[0]);
				for(var i=0;i<filesLength;i++){
					form_data.append("gambar_slider[]", document.getElementById('gambar_slider').files[i]);
				}
				
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});

				$.ajax({
					type: 'post',
					url: $(this).attr("action"),
					data: form_data,
					dataType: 'json',
					processData: false,
					contentType: false,
					beforeSend: function() {
						sendAjax('#btnSimpan', false)
					},
					success: function(data) {
						console.log(data)
						if (data.status == "ok") {
							showAlert(data.messages)
							setTimeout(function() {
								
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
						sendAjax('#btnSimpan', true, 'Simpan')
					}
				});
			});
		})
	</script>
</body>
</html>