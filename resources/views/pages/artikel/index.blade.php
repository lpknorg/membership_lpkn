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
	<title>Artikel Member</title>
	<style>
		#div-artikel{
			transition: 0.6s;
		}
		#div-artikel:hover{
			background-color: #515252;
			cursor: pointer;
		}
		#div-artikel a{
			color: #fff;
			transition: 0.6s;
		}
	</style>
</head>
<body>
	@include('member.layouts.navbar')
	<div class="container con_full mb-4">
		<div class="row mt-2 sm-reverse">
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="out_img mb-2" style="padding: 0px; margin: 0 auto">
							<img class="in_img" src="{{\Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile')}}" alt="User profile picture">
						</div>
						<div class="text-center">
							<button type="button" class="text-dark btn btn-transparent btn-sm" data-toggle="modal" data-target="#update_foto">
								<i class="fa fa-camera"></i> Ganti foto
							</button>
						</div>

						<h3 class="profile-username text-center">{{\Auth::user()->name}}  </h3>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Total Artikel</b> <a class="float-right">0</a>
							</li>
							<li class="list-group-item">
								<b>Total Pengikut</b> <a class="float-right">0</a>
							</li>
						</ul>
					</div>
					<!-- /.card-body -->
				</div>
				<div class="card card-primary mt-3">
					<div class="card-header">
						<h5 class="card-title">About Me</h5>
						<p>Saya menyukai ..... .... .... </p>
					</div>
					<div class="card-body">
						<strong><i class="fa fa-at mr-1"></i> Email</strong>
						<p class="text-muted">{{\Auth::user()->email}}</p>
						<hr>
						<strong><i class="fa fa-phone mr-1"></i> No. Tlp</strong>
						<p class="text-muted">{{\Auth::user()->member->no_hp ?? '-'}}</p>
						<hr>
						
					</div>
				</div>
			</div>
			<div class="col-md-9 mb-4 mb-md-0">
				<div class="row">
					<div class="col">
						<select name="kategori" class="form-control">
							<option value="">Pilih Kategori</option>
						</select>
					</div>
					<div class="col">
						<select name="kategori" class="form-control">
							<option value="">Pilih Tahun</option>
						</select>
					</div>
					<div class="col">
						<select name="kategori" class="form-control">
							<option value="">Pilih Bulan</option>
						</select>
					</div>
					<div class="col">
						<button class="btn btn-outline-primary btn-sm w-100">Tampilkan</button>
					</div>
				</div>
				@foreach($data as $d)
				<div class="card mt-3" style="width: 100%;min-height: 100px;max-height: 140px;">
					<div class="row" id="div-artikel" style="border-radius: 15px;">
						<div class="col-sm-4 p-0">
							<img class="d-block w-100" src="{{\Helper::showImage($d->cover, 'artikel/cover')}}" alt="" style="min-height: 100px;max-height: 140px;">
						</div>
						<div class="col-sm-8">
							<div class="card-body">
								<a href="{{route('artikel.detail', ['uname' => \Helper::getUname($d->user) ,'slug' => $d->slug])}}">
									<h4>{{$d->judul}}</h4>
								</a>
								<!-- <a href="#" class="btn btn-primary btn-sm float-right">Read More</a> -->
							</div>
							
						</div>

					</div>
				</div>
				@endforeach
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
</body>
</html>
