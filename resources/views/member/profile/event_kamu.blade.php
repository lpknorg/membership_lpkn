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
		Event yang Kamu ikuti <small><a class="badge badge-primary" href="{{route('allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	<div class="row card-body">
		<table class="table table-hover table-bordered table-responsive-sm tableEventKamu" id="tableEventKamu" style="width: 100%;">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Event</th>
					<th scope="col">Action</th>
					<th scope="col">Tanggal Pelaksanaan</th>
				</tr>
			</thead>
			<tbody>
				@foreach($my_event['event'] as $key => $e)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $e['judul']}}</td>
					<td>{{ \Helper::changeFormatDate($e['tgl_start']).' s/d '.\Helper::changeFormatDate($e['tgl_end']) }}</td>
					<td>
						<button type="button" onclick="getEvent('{{$e['slug']}}');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i></button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
@endsection