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
					<div class="row list_artikel_card">
						<div class="col-sm-5">
                            <div class="list_art_out_img">
                                <img class="list_art_in_img" src="{{\Helper::showImage($d->cover, 'artikel/cover')}}" alt="">
                            </div>
						</div>
						<div class="col-sm-7">
                            <div class="p-2 d-flex align-items-stretch flex-wrap list_artikel_sm_7">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <a class="list_artikel_out"><img class="list_artikel_in" src="https://www.saveseva.com/wp-content/uploads/2015/06/Landscape.jpg" alt="User profile picture"></a>
                                    </div>
                                    <div class="">
                                        <div class="artikel_short_name px-2">Ini Adalah bsdenar toh kan</div>
                                        <div class="artikel_short_date px-2">29 September 2023 | 4 menit lalu</div>
                                    </div>
                                </div>
                                <div class="">
                                    <a class="list_artikel_title" href="{{route('artikel.detail', ['uname' => \Helper::getUname($d->user) ,'slug' => $d->slug])}}">
                                        {{$d->judul}}
                                    </a>
                                </div>
                                <div class="d-flex align-items-end ml-auto">
                                    <div class="text-67"> <i class="fa-regular fa-eye"></i> 123</div>
                                    <div class="text-67 mx-4"> <i class="fa-solid fa-heart"></i> 456</div>
                                    <div class="text-67"> <i class="fa-solid fa-message"></i> 7890</div>
                                </div>
                            </div>
                            <!-- <a href="#" class="btn btn-primary btn-sm float-right">Read More</a> -->
						</div>
					</div>
				</div>
				@endforeach
				<div class="float-right mt-3">
					{{$data->links()}}
				</div>
		</div>
	</div>
	@include('Frontend.body.footer')
    @include('template.footer')
	<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
