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
		Rekomendasi Event <small><a class="badge badge-primary" href="{{route('member_profile.allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	<p class=" border-bottom">Kemi merekomendasikan Event dibawah untukmu dari beberapa aktiritas kami di web ini</p>
	<div class="row">
		@foreach($new_event['event'] as $n)
		<div class="col-sm-4 card-wrapper-special">
			<div class="card card-special img__wrap">
				<img class="card-img-top card-img-top-special" src="{{$n['brosur_img']}}" alt="Card image cap">
				<div class="img__description_layer">
					<p style="padding: 6px">
						<button type="button" id="btnSelengkapnya" onclick="getEvent('{{$n['slug']}}');" slug="{{$n['slug']}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Selengkapnya</button>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
<!-- <script>
	$(document).ready(function(){
		$('body').on('click', '[id="btnSelengkapnya"]', function(e) {
			let sl = $(this).attr('slug')
			$('#exampleModal').modal('show')
			getEvent(sl)
		})		
	})
</script> -->
@endsection