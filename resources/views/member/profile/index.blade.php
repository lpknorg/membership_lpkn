@extends('member.layouts.template')
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Rekomendasi Event <small><a class="badge badge-primary" href="{{url('/')}}">Semua Event</a></small>
	</h5>
	<p class=" border-bottom">Kemi merekomendasikan Event dibawah untukmu dari beberapa aktivitas kami di web ini</p>
	<div class="row">
		@foreach($new_event['event'] as $n)
		<div class="col-sm-4 card-wrapper-special">
			<div class="card card-special img__wrap">
				<img class="card-img-top card-img-top-special" src="{{$n['brosur_img']}}" alt="Card image cap">
				<div class="img__description_layer">
					<div class="img__description_layer">
                        <p class="small pb-0">{{ $n['judul'] }}</p>
                        <button type="button" id="btnSelengkapnya" slug="{{$n['slug']}}" class="btn btn-primary btn-sm mb-1 mb-1 py-0"><small>Selengkapnya</small></button>
                    </div>
				</div>
			</div>
		</div>
		@endforeach
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
