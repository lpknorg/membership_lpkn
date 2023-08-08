@extends('layouts.front.template')
@section('styles')
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

.has-search .form-control-feedback {
  position: absolute;
  z-index: 2;
  display: block;
  width: 2.375rem;
  height: 2.375rem;
  line-height: 2.375rem;
  text-align: center;
  pointer-events: none;
  color: #aaa;
}
@media (min-width: 1200px){
  .modal-lg {
    max-width: 1140px !important;
  }
}
</style>
@endsection
@section('content')
<div class="container">
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
									<input type="text" class="form-control" placeholder="Search event" name="keyword" >
									<div class="input-group-append">
										<button class="btn btn-secondary" type="button" id="serch_event">
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
        <div class="ml-2">
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <!-- <li class="page-item active">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li> -->
                <?php $bagi = round($event['count'] / 9 + 1); $seg = \Request::segment(3); ?>
                @for($i=1;$i<=$bagi;$i++)
                <li class="page-item {{$seg == $i ? 'active' : ''}}">
                  @if(\Request::get('keyword'))
                  <a class="page-link" href="{{route('member_profile.allevent', ['id' => $i, 'keyword' => \Request::get('keyword')])}}">
                    @else
                    <a class="page-link" href="{{route('member_profile.allevent', ['id' => $i])}}">
                      @endif
                      {{$i}}
                      @if($seg == $i)
                      <span class="sr-only">(current)</span>
                      @endif
                    </a>
                  </li>
                  @endfor

                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
            </div>

          </div>
      </div>
      <aside class="col-md-4 blog-sidebar">
        <div class="p-4 mb-3 bg-light rounded">
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
    })
  </script>
  @endsection