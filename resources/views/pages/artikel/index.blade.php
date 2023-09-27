@include('template.head')
<title>Artikel</title>
    @include('member.layouts.navbar')
	<div class="container con_full mb-4">
		<div class="row mt-2 sm-reverse">
			<div class="col-md-8 mb-4 mb-md-0">
				<h1 class="h_artikel">List Artikel</h1>
				<hr class="h_line mt-0">
				<form action="">
					<div class="row align-items-center">
						<div class="col-12 col-sm-3 mb-2 mb-md-0">
							<input type="text" class="form-control" name="q" placeholder="Cari disini ..." value="{{\Request::get('q')}}">
						</div>
						<div class="col-6 col-sm-3">
							<select name="kategori" class="form-control">
								<option value="">Pilih Kategori</option>
							</select>
						</div>
						<div class="col-6 col-sm-3">
							<select name="tahun" class="form-control">
								<option value="">Pilih Tahun</option>
							</select>
						</div>
						<!-- <div class="col">
							<select name="kategori" class="form-control">
								<option value="">Pilih Bulan</option>
							</select>
						</div> -->
						<div class="col-12 col-sm-3 mt-2 mt-md-0">
							<button type="submit" class="btn btn-primary w-100">Tampilkan</button>
						</div>
					</div>
				</form>
				@foreach($data as $d)
				<div class="card mt-3">
					<div class="row" id="div-artikel">
						<div class="col-sm-4">
                            <span class="responsive">
                                <img class="d-block" src="{{\Helper::showImage($d->cover, 'artikel/cover')}}" alt="">
                            </span>
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
				<div class="float-right mt-3">
					{{$data->links()}}
				</div>
			</div>
		</div>
	</div>
	@include('Frontend.body.footer')
    @include('template.footer')
	<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
