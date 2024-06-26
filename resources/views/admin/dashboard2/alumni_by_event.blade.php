@extends('layouts.template')
@section('breadcumb')

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
	#table-status tr td{
		padding: 4px !important;
		margin: 4px !important;
	}
	h5{
		font-size: 18px;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<?php
		if (\Request::segment(2) == 'event_user_list') {
			$tipe = 'berbayar';
		}else{
			$tipe = 'gratis';
		}
		?>
		@if($tipe == 'berbayar' && $alumni_list_event)
		<h5>Judul Event : {{$alumni_list_event[0]['judul']}}</h5>
		<h5>Tanggal Pelaksanaan : {{\Helper::changeFormatDate($alumni_list_event[0]['tgl_start']).' s/d '.\Helper::changeFormatDate($alumni_list_event[0]['tgl_end'])}}</h5>
		<h5>Lokasi : {{$alumni_list_event[0]['lokasi_event']}}</h5>
		@else
		@if(isset($alumni_list_event['list_regis_sertif']))
		<h5>Judul Event : {{$alumni_list_event['list_regis_sertif'][0]['judul']}}</h5>
		@endif
		@endif
	</div>
	<div class="col-md-12">
		<div class="x_panel">
			<div class="row">
				<div class="col-md-4 mx-auto">
					<table class="table table-bordered table-hover" id="table-status">
						<thead class="text-center">
							<tr>
								<td>Verifikasi</td>
								<td>Pending</td>
								<td>Belum Bayar</td>
							</tr>
							<tr>
								<td>{{$totalDataStatus[0]}}</td>
								<td>{{$totalDataStatus[1]}}</td>
								<td>{{$totalDataStatus[2]}}</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="row float-right">
				<div class="col-md">
					<a href="{{route('dashboard2.exportExcelAlumniByEvent', $tipe).'?id_event='.$id_events}}" class="btn btn-outline-primary btn-sm">Download Excel</a>
				</div>
			</div>
			<table class="table table-bordered table-hover" id="table-alumni">
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
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/chart.js')}}"></script>
<script>
	var tableEventGratis = $('#table-alumni').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			"url": "{{ route('dashboard2.get_user_by_event_datatable') }}",
			data: function(d){
				d.id_event = '{{$id_events}}'
				d.tipe = '{{$tipe}}'
				d.status_pembayaran = $('[name=tanggal_awal]').val()
			}
		},
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'email_', 'name': 'nama_lengkap'},
			{data: 'no_hp', searchable: false},
			{data: 'email', 'name': 'email'},
			{data: 'instansi', searchable: false},
			{data: 'unit_organisasi', searchable: false},
			{data: 'status_pembayaran', searchable: false},
			]
	});
</script>
@endsection