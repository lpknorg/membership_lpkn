@include('template.head')
    <style>
		#div-artikel_terbaru a{
			color: #fff;
			transition: 0.6s;
		}
	</style>
	<title>{{ucfirst($artikel->judul)}}</title>
	@include('member.layouts.navbar')
	<div class="container con_full mb-4">
		<div class="row mt-3">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<h1 class="h_artikel">Ini Profil Penulis</h1>
				        <hr class="h_line mt-0">
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
    @include('template.footer')
	<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
