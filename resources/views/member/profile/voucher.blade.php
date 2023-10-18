@extends('member.layouts.template')
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Voucher Kamu
	</h5>
	<div class="row table-responsive card-body">
		<table class="table table-hover table-bordered table-responsive-sm tableEventKamu" id="tableEventKamu" style="width:1000px;">
			<thead class="thead-dark">
				<tr>
					<th width="5%" scope="col">No</th>
					<th scope="col">Nama Event</th>
					<th scope="col">Tanggal Pelaksanaan</th>
					<th scope="col">Kode Voucher</th>
				</tr>
			</thead>
			<tbody>
				@foreach($detailevent as $key => $de)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $de['judul']}}</td>
					<td>{{ $de['waktu_event']}}</td>
					<td>{{ $de['kdvcr']}}</td>
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
