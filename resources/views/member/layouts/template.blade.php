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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frontend/css/navbar.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?version=0">
    <link rel="stylesheet" href="{{asset('frontend/css/aside.css')}}?version=0">
	<title>Halaman Member</title>
</head>
<body>
	@include('member.layouts.navbar')
    <div class="container con_full mb-4">
		<div class="row mt-2">
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
								<b>Ikut Event</b> <a class="float-right">{{\Auth::user()->total_event}}</a>
							</li>
							<li class="list-group-item">
								<b>Data Sertifikat</b> <a class="float-right">{{\Auth::user()->total_sertifikat}}</a>
							</li>
						</ul>

						<a href="{{ route('member_profile.download_kta') }}" class="btn btn-primary btn-block"><b>Download KTA</b></a>
					</div>
					<!-- /.card-body -->
				</div>
				<div class="card card-primary mt-3">
					<div class="card-header">
						<h5 class="card-title">About Me</h5>
					</div>
					<div class="card-body">
						<strong><i class="fa fa-at mr-1"></i> Email</strong>
						<p class="text-muted">{{\Auth::user()->email}}</p>
						<hr>
						<strong><i class="fa fa-phone mr-1"></i> No. Tlp</strong>
						<p class="text-muted">{{\Auth::user()->member->no_hp ?? '-'}}</p>
						<hr>
						<strong><i class="fa fa-building mr-1"></i> Instansi</strong>
						<p class="text-muted">{{\Auth::user()->member->memberKantor->nama_instansi ?? '-'}}</p>
						<hr>
						<strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong>
						<p class="text-muted">{{\Auth::user()->member->alamat_lengkap ?? '-'}}
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="alert alert-info w-100">
					Jika terdapat ketidaksesuaian data, silakan melakukan <a href="{{route('member_profile.edit_profile')}}"><b>update profile</b></a>
				</div>
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
								<a class="nav-link {{$csegment > 1 && $segment[1] == 'edit_profile' ? 'active' : ''}}" href="{{route('member_profile.edit_profile')}}">Update Profile</a>
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
	@include('member.layouts.modals')
    @include('Frontend.body.footer')




	<!-- Optional JavaScript -->

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	@yield('scripts')
</body>
</html>
