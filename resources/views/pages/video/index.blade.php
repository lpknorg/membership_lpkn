@extends('layouts.front.template')
@section('content')
<div class="container con_full mt-0 mt-md-4">
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
                    url:"{{route('searchvideo')}}",
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
