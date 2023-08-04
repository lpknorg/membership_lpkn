@extends('member.layouts.template')
@section('styles')
<style>
	@media (min-width: 1200px){
		.modal-lg {
			max-width: 1140px !important;
		}
	}	
</style>
@endsection
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Dokumentasi <small><a class="badge badge-primary ml-2 gotoback" onclick="goToBack()" style="display:none; cursor: pointer;"><i class="fa fa-arrow-left"></i> Go To Back</a></small>
	</h5>
	<p class=" border-bottom">Kemi merekomendasikan Event dibawah untukmu dari beberapa aktiritas kami di web ini</p>
	<div class="row dokumentasi">
		@foreach($dokumentasi as $doc)
		<div class="col-md-4 mb-3">
			<div class="card mb-4 shadow-sm h-100">
				<div class="card-head">
					<div class="user-image" style="background: url({{$doc['linkfoto']}}) 50% 50% no-repeat; background-size: 125% auto; background-repeat: no-repeat; padding-bottom: 0px; height: 190px;"></div>
				</div>
				<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<small><a href="">Create By : {{$doc['first_name']}}</a></small>
					<small><a href="">{{$doc['jenis_artikel']}}</a></small>
				</div>
				<hr>
				<p class="card-text text-center">{{$doc['judul']}}</p><hr>Waktu Kegiatan :<br>{{$doc['waktu']}}<p></p>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-between align-items-center">
						<small class="text-muted"><i class="far fa-calendar-alt"></i> {{$doc['create_date']}}</small>
						<div class="btn-group">
							<a href="#!" id="readmore" class="btn btn-xs btn-info white-text d-flex justify-content-end readmore" data-id="{{$doc['id_artikel']}}" onclick="getArtikelByid({{$doc['id_artikel']}});">
							<h5>Read More <i class="fas fa-angle-double-right"></i></h5>
						</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		<div class="row ml-1">
			<div class="col-md-12">
				<!-- Custom Pagination Links -->
				<ul class="pagination justify-content-center">
					@if($currentPage > 1)
						<li class="page-item"><a class="page-link" href="{{ route('member_profile.dokumentasi.index', ['page' => $currentPage - 1]) }}">Previous</a></li>
					@endif
					@foreach($paginationLinks as $page)
						@if($page == 0)
						<li class="page-item">
                            <a class="page-link" href="#">...</a>
                        </li>
						@else	
						<li class="page-item {{ ($currentPage == $page) ? 'active' : '' }}">
                            <a class="page-link" href="{{ route('member_profile.dokumentasi.index', ['page' => $page]) }}">{{ $page }}</a>
                        </li>
						@endif
                    @endforeach

					@if($currentPage < $totalPages)
						<li class="page-item"><a class="page-link" href="{{ route('member_profile.dokumentasi.index', ['page' => $currentPage + 1]) }}">Next</a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
<script>
	function getArtikelByid(id_artikel){
		if(id_artikel != 'all'){
			$(".gotoback").show()
		}else{
			$(".gotoback").hide()
			$('.dokumentasi').html('')
		}

		$.ajax({
			url:"{{route('member_profile.dokumentasi.get_artikel')}}",   
			type: "post",   
			dataType: 'json',
			data: {
				"_token": "{{ csrf_token() }}",
				id_artikel:id_artikel,
			},
            success:function(result){
                console.log(result);
				$('.dokumentasi').html(result);
            }
        });
	}

	function goToBack(){
		var id_artikel = 'all';
		location.reload();
	}

  </script>
@endsection