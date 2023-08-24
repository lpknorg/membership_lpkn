@extends('layouts.front.template')
@section('content')
<div class="container con_full">
	<div class="row">
		<div class="col-md-8 blog-main mt-2 mb-5">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5 class="pb-4 mb-4 font-italic border-bottom">
						Semua Event <small><a class="badge badge-primary" href="{{url('member_profile')}}">Kembali Ke Beranda</a></small>
					</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right" style="background-color: transparent;">
						<li class="breadcrumb-item">
							<form class="form-inline ml-0 ml-md-3" action="">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search event" name="keyword" value="{{\Request::get('keyword') ?? ''}}" >
									<div class="input-group-append">
										<button class="btn btn-primary" type="button" id="serch_event">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
							</form>
						</li>
					</ol>
				</div>
			</div>
			<div class="blog-post">
				<h2 class="blog-post-title">Total Event : <?= (isset($event['count'])) ? $event['count'] : ''?></h2>
				<div class="row" id="content-event">
					@foreach($event['event'] as $e)
					<div class="col-lg-4 col-6 card-wrapper-special">
						<div class="card card-special img__wrap">
							<img class="card-img-top card-img-top-special" src="{{$e['brosur_img']}}" alt="Card image cap">
							<div class="img__description_layer">
								<p style="padding: 6px">
                  <button type="button" id="btnSelengkapnya" slug="{{$e['slug']}}" class="btn btn-primary btn-sm">Selengkapnya</button>
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item {{\Request::segment(2) == 1 ? 'disabled' : ''}}">
                  <a class="page-link" href="#" tabindex="-1" id="pagePrevious">Previous</a>
                </li>
                <!-- <li class="page-item active">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li> -->
                <?php $bagi = round($event['count'] / 9 + 1); $seg = \Request::segment(2); ?>
                @for($i=1;$i<=$bagi;$i++)
                <li class="page-item {{$seg == $i ? 'active' : ''}}">
                  @if(\Request::get('keyword'))
                  <a class="page-link" href="{{route('allevent', ['id' => $i, 'keyword' => \Request::get('keyword')])}}">
                    @else
                    <a class="page-link" href="{{route('allevent', ['id' => $i])}}">
                      @endif
                      {{$i}}
                      @if($seg == $i)
                      <span class="sr-only">(current)</span>
                      @endif
                    </a>
                  </li>
                  @endfor

                  <li class="page-item">
                    <a class="page-link" href="#" id="pageNext">Next</a>
                  </li>
                </ul>
              </nav>
            </div>

          </div>
      </div>
      <aside class="col-md-4 blog-sidebar">
        <div class="p-4 mb-3 bg-card rounded">
          <h4 class="font-italic">About</h4>
          <p class="mb-0">Lembaga Pengembangan dan Konsultasi Nasional (LPKN) merupakan lembaga Diklat resmi yang berdiri sejak tahun 2005, dan telah Terakreditasi A Oleh Lembaga Kebijakan Pengadaan Barang/ Jasa Pemerintah (LKPP) – RI, untuk kegiatan Pelaksanaan Pelatihan Pengadaan dan Sertifikasi Barang/ Jasa pemerintah. Saat ini telah memiliki Alumni sebanyak 1.300.580 orang, yang tersebar di seluruh Indonesia, LPKN juga telah medapatkan 2 Rekor MURI, dalam penyelenggaraan Webinar dengan jumlah Peserta lebih dari 100.000 orang.</p>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Kategori Event</h4>
          <ol class="list-unstyled mb-0">
            <li><a class="badge badge-primary" href="#">Pengadaan Barang & Jasa</a></li>
            <!-- <li><a class="badge badge-primary" href="#">Umum</a></li> -->
            <li><a class="badge badge-primary" href="#">Pelatihan Sertifikasi</a></li>
            <li><a class="badge badge-primary" href="#">Pelatihan Non Sertifikasi</a></li>
            <li><a class="badge badge-primary" href="#">Pendidikan </a></li>
            <li><a class="badge badge-primary" href="#">Umum</a></li>
          </ol>
        </div>

        <div class="p-4">
          <h4 class="font-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a class="badge badge-warning" href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
            <li><a class="badge badge-danger" href="#"><i class="fa fa-youtube"></i> Youtube</a></li>
            <li><a class="badge badge-primary" href="#"><i class="fa fa-facebook"></i> Facebooks</a></li>
          </ol>
        </div>
      </aside><!-- /.blog-sidebar -->

    </div>
    @include('Frontend.body.footer')
</div>
@endsection
@section('scripts')
@include('js/custom_script')
  <script>
    $(document).ready(function(){
      $('body').on('click', '[id="btnSelengkapnya"]', function(e) {
        let sl = $(this).attr('slug')
        $('#exampleModal').modal('show')
        getEvent(sl)
      })
      var _key = '{{\Request::get('keyword')}}'
      $('body').on('click', '[id="pagePrevious"]', function(e) {
        e.preventDefault()
        let _id = '{{\Request::segment(2)}}'
        _id = parseInt(_id)
        _id = _id - 1
        @if(\Request::get('keyword'))
        window.location = `/allevent/${_id}?keyword=${_key}`
        @else
        window.location = `/allevent/${_id}`
        @endif
      })
      $('body').on('click', '[id="pageNext"]', function(e) {
        e.preventDefault()
        let _id = '{{\Request::segment(2)}}'
        _id = parseInt(_id)
        _id = _id + 1
        @if(\Request::get('keyword'))
        window.location = `/allevent/${_id}?keyword=${_key}`
        @else
        window.location = `/allevent/${_id}`
        @endif
      })
    })
  </script>
  @endsection
  {{-- ini besok --}}
