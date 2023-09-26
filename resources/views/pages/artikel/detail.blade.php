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
	<title>{{ucfirst($artikel->judul)}}</title>
	<style>
		#div-artikel_terbaru a{
			color: #fff;
			transition: 0.6s;
		}
	</style>
</head>
<body>
	@include('member.layouts.navbar')
	<div class="container con_full mb-4">
		<div class="row mt-3">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary card-outline">
							<div class="card-body">
								INI PROFIL PENULIS
							</div>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<div class="card card-primary card-outline">
							<div class="card-body">
								INI Iklan lagi
							</div>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<h3>{{ucfirst($artikel->judul)}}</h3>
						<p>icon </p>
						<p>{{\Helper::changeFormatDate($artikel->created_at, 'd-M-Y H:i:s')}} | Dibuat oleh : {{ucfirst($artikel->user->name)}}</p>
						@foreach($artikel->artikelTags as $t)
						<span class="badge badge-primary">{{$t->nama_tag}}</span>
						@endforeach
						<div class="alert alert-info">
							Ini adalah platform blog. Konten ini akan menjadi tanggung jawab blogger dan tidak mewakili pandangan dari <b>Lembaga Pengembangan dan Konsultasi Nasional(LPKN)</b>
						</div>
					</div>
					<div class="col-md-12 mt-3">
						<h5>ini images slider </h5>
						@foreach($artikel->artikelFoto as $f)
						<img class="d-block w-100" src="{{\Helper::showImage($f->file, 'artikel/gambar_slider')}}" alt="" style="min-height: 100px;max-height: 140px;">
						@endforeach
					</div>
					<div class="col-md-12 mt-3">
						{!! $artikel->deskripsi !!}
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati omnis deserunt porro asperiores a velit incidunt, iste. Nisi ab veritatis alias provident, repudiandae porro, exercitationem! Commodi recusandae adipisci optio, corporis.
						INI IKLAN NANTI		
					</div>
					<div class="col-md-12 mt-4" id="div-artikel_terbaru">
						<div class="card">
							<div class="card-body">
								<h5>Artikel Terbaru</h5>
								<ol>
									@foreach($artikel_terbaru as $tb)
									<li>
										<a href="{{route('artikel.detail', ['uname' => \Helper::getUname($tb->user) ,'slug' => $tb->slug])}}">
											<h6 class="mb-0">{{ucfirst($tb->judul)}}</h6>
										</a>
										<p class="mb-2">{{ucfirst($tb->user->name)}}</p>
									</li>
									@endforeach
								</ol>
								<a href="{{route('artikel.index')}}" class="btn btn-primary w-100">Lihat Semua</a>
							</div>
						</div>
					</div>
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
</body>
</html>
