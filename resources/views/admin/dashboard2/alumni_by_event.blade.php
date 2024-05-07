@extends('layouts.template')
@section('breadcumb')

<div class="row">
	<div class="page-title ml-2">
		<div class="title_left">
			<h3>Dashboard</h3>
		</div>
	</div>
</div>
@endsection
@section('content')
<style>
	.x_title{
		border-bottom: none;
	}
	.nav-tabs .nav-link.active{
		color: #fff;
		background-color: #889af3;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<table class="table table-bordered table-hover" id="table-member">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Lengkap</th>
						<th>No Hp</th>
						<th>Email</th>
						<th>Instansi</th>
						<th>Unit Organisasi</th>
						<th>Status Pembayaran</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $key => $e)
					<tr>
						<td style="width: 5%">{{ $key+1 }}</td>
						<td>{{$e['nama_lengkap']}}</td>
						<td>{{$e['no_hp']}}</td>
						<td><a target="_blank" href="{{route('dashboard2.detail_alumni', $e['email'])}}">{{$e['email']}}</a></td>
						<td>{{$e['instansi']}}</td>
						<td>{{$e['unit_organisasi']}}</td><td>
							@if($e['status_pembayaran'] == 1)
							<span class="badge badge-success">Terverifikasi</span>
							@elseif($e['status_pembayaran'] == 0 && $e['bukti_bayar'])
							<span class="badge badge-warning">Upload Bukti</span>
							@else
							<span class="badge badge-danger">Belum Pembayaran</span>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script src="{{asset('js/chart.js')}}"></script>
<script>
	$(document).ready(function(){
		$('#table-member').DataTable();
	});
</script>
@endsection