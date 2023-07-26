@extends('member.layouts.template')
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Event yang Kamu ikuti <small><a class="badge badge-primary" href="{{route('member_profile.allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	
</div>
@endsection