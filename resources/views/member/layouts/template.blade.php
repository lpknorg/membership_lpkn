<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="{{ asset('template/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<title>Hello, world!</title>
	<style>
		.card-special {
		z-index: 1;
		border-radius: 6px 6px 6px 6px;
		border: 1;
		transition: 0.4s;
	}
	.card-wrapper-special {
		padding: 6px;
		/*box-shadow: 0 10px 60px 0 rgba(0, 0, 0, 0.2);*/
	}
	.card-special:hover {
		transform: scale(1.1);
		box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.4);
		z-index: 2;
	}
	.card-text-special {
		color: #fea200;
		font-weight: 500;
	}
	.card-img-top-special {
		/*border-radius: unset;*/
		border-radius: 5px 5px 5px 5px;
	}

	.img__description_layer {
		font-size: 14px;
		/*font-weight: bold;*/
		position: absolute;
		text-align: center;
		padding: 6px
		top: auto;
		/*top: 100px;*/
		width: 100%;
		bottom: 0;
		left: 0;
		right: 0;
		border-radius: 0px 0px 5px 5px;
		/*background: rgba(0 0 0 / 85%);*/
		color: white;
		visibility: hidden;
		opacity: 0;
		/*display: flex;*/
		align-items: center;
		justify-content: bottom;

		/* transition effect. not necessary */
		transition: opacity .2s, visibility .2s;
	}
	.img__wrap:hover .img__description_layer {
		visibility: visible;
		opacity: 1;
	}

	/*button load_more*/
	@media only screen and (min-width: 767px) {
	.show-large {
		display: block;
	}
	.show-mobile {
		display: none;
	}
	}
	</style>
</head>
<body>
	@include('member.layouts.navbar')
	<div class="px-2 py-2">
		<div class="row" style="width: 100%;">
			<div class="col-md-3">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="parent_pp profile-user-img img-circle" style="padding: 0px;">
							<img class="pp" style="margin: 0 auto 10px auto;display: block; height: 50%;width: 60%;border-radius: 50%;" src="http://localhost/member.lpkn.id/uploads/foto_profile/20230331-6426baee7b4d8.jpg" alt="User profile picture">
						</div>
						<div class="text-center">
							<button type="button" class="text-dark btn btn-transparent btn-sm" data-toggle="modal" data-target="#update_foto">
								<i class="fa fa-camera"></i> Update foto
							</button>
						</div>

						<h3 class="profile-username text-center">{{\Auth::user()->name}}  </h3>

						<p class="text-muted text-center">-</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Ikut Event</b> <a class="float-right">2</a>
							</li>
							<li class="list-group-item">
								<b>Data Sertifikat</b> <a class="float-right">1</a>
							</li>
						</ul>

						<a href="http://localhost/member.lpkn.id/page/kta" class="btn btn-primary btn-block"><b>Download KTA</b></a> 
					</div>
					<!-- /.card-body -->
				</div>
				<div class="card card-primary mt-3">
					<div class="card-header">
						<h5 class="card-title">About Me</h5>
					</div>
					<div class="card-body">
						<strong><i class="fas fa-at mr-1"></i> Email</strong>
						<p class="text-muted">{{\Auth::user()->email}}</p>
						<hr>
						<strong><i class="fas fa-phone mr-1"></i> No. Tlp</strong>
						<p class="text-muted">{{\Auth::user()->member->no_hp ?? '-'}}</p>
						<hr>
						<strong><i class="fas fa-map-marker-alt mr-1">Instansi</i></strong>
						<p class="text-muted">{{\Auth::user()->member->instansi->nama ?? '-'}}</p>
						<hr>
						<strong><i class="fas fa-map-marker-alt mr-1">Alamat</i></strong>
						<p class="text-muted">{{\Auth::user()->member->alamat_lengkap ?? '-'}}
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card card-primary card-outline">
					<?php $segment = \Request::segments(); $csegment = count($segment); ?>
					<div class="card-header" style="padding: 10px;">
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link {{$csegment == 1 ? 'active' : ''}}" href="{{route('member_profile.index')}}">Rekomendasi Event</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'menunggu_pembayaran' ? 'active' : ''}}" href="{{route('member_profile.menunggu_pembayaran.index')}}">Menunggu Pembayaran</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'event_kamu' ? 'active' : ''}}" href="{{route('member_profile.event_kamu.index')}}">Event Kamu</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'sertifikat_kamu' ? 'active' : ''}}" href="{{route('member_profile.sertifikat_kamu.index')}}">Sertifikat Kamu</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'update_profile' ? 'active' : ''}}" href="{{route('member_profile.update_profile.index')}}">Update Profile</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'dokumentasi' ? 'active' : ''}}" href="{{route('member_profile.dokumentasi.index')}}">Dokumentasi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'voucher' ? 'active' : ''}}" href="{{route('member_profile.voucher.index')}}">Voucher</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content" id="pills-tabContent">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>