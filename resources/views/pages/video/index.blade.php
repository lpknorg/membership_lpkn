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
  padding: 6px;
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

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.video-container {
    text-align: center;
    margin-top: 50px;
}

/* .open-video-btn {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
} */

.video-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 80%;
    width: 100%;
    max-width: 900px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    padding: 20px;
    text-align: center;
    z-index: 9999;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

iframe{
    height: 100%;
    width: 100%;
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
						Semua Video <small><a class="badge badge-primary" href="{{url('member_profile')}}">Kembali Ke Beranda</a></small>
					</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right" style="background-color: transparent;">
						<li class="breadcrumb-item">
							<form class="form-inline ml-0 ml-md-3" action="">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search video" name="keyword" id="searchInput">
									<div class="input-group-append">
									</div>
								</div>
							</form>
						</li>
					</ol>
				</div>
			</div>
			<div class="blog-post">
				<h2 class="blog-post-title">Total Video : {{ count($videos) }}</h2>
                <div class="video-container">
                    <div class="row videoGallery" id="videoGallery">
                        @foreach($videos as $video)
                        <div class="card-deck col-md-6 mb-3">
                            <div class="card">
                                <iframe style="padding:5px;" src="{{ $video->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <div class="card-body">
                                <h5 class="card-title">{{ $video->judul }}</h5>
                                    <p class="card-text">{{ $video->keterangan }}</p>
                                    <button type="button" class="btn btn-primary btn-sm open-video-btn" onclick="openVideo('{{$video->link}}')">Open Video</button>
                                </div>
                                <div class="card-footer">
                                <small class="text-muted">Updated at {{ mediumdate_indo($video->updated_at) }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                         @if ($videos->onFirstPage())
                         <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $videos->previousPageUrl() }}" aria-label="Previous" disabled>
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        @endif
                        @for($i=1;$i<=$videos->lastPage();$i++)
                            @if (is_string($i))
                                <li class="page-item"><a class="pagination-ellipsis page-link">{{ $i }}</a></li>
                            @endif

                            @if (is_array($i))
                                @foreach ($i as $page => $url)
                                    @if ($page == $videos->currentPage())
                                        <li class="page-item"><span class="pagination-link active">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="page-item"><a href="{{$videos->url($i)}}" class="pagination-ellipsis page-link">{{ $i }}</a></li>
                        @endfor

                        @if ($videos->hasMorePages())
                            <li class="page-item">
                                <a class="pagination-next page-link" href="{{ $videos->nextPageUrl() }}" rel="next">Next page</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        @endif
                    </ul>
                    </nav>

                    <div class="video-popup">
                        <span class="close-btn">&times;</span>
                        <iframe id="playVideo" width="560" height="315" src="https://www.youtube.com/embed/CXbP8_vUIOM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
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
    const popup = document.querySelector('.video-popup');
    const closeBtn = document.querySelector('.close-btn');

    function openVideo(links){
        $('#playVideo').attr('src', links);
        popup.style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const videoGallery = document.getElementById('videoGallery');

        searchInput.addEventListener('input', function() {
            $('#videoGallery').html('');
            let html = '';

            const query = searchInput.value;
            if (query.trim() !== '') {
                $.ajax({
                    url:"{{route('member_profile.searchvideo')}}",   
                    type: "get",   
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        query:query,
                    },
                    success:function(response){
                        const videos = response.videos;
                        if(videos.length === 0){
                            html += `<h5>Video Tidak Ditemukan</h5>`;
                        }else{
                            videos.forEach(video => {
                                html += `
                                    <div class="card-deck col-md-6 mb-3">
                                        <div class="card">
                                            <iframe style="padding:5px;" src="${video.link}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            <div class="card-body">
                                            <h5 class="card-title">${video.judul}</h5>
                                                <p class="card-text">${video.keterangan}</p>
                                                <button type="button" class="btn btn-primary btn-sm open-video-btn" onclick="openVideo('${video.link}')">Open Video</button>
                                            </div>
                                            <div class="card-footer">
                                            <small class="text-muted">Updated at ${video.updated_at}</small>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                        }

                        videoGallery.innerHTML = html;
                    }
                });

            } else {
                html += 'Video Tidak Ditemukan'
                videoGallery.innerHTML = html;
            }

        });
    });

  </script>
  @endsection