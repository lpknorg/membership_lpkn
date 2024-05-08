@extends('layouts.template')
@section('breadcumb')

<div class="row">
	<div class="page-title ml-2">
		<div class="title_left">
			<h3 class="mb-0">Dashboard</h3>			
			<h5>List Event Gratis</h5>
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

<div class="row mt-3">
	<div class="col-md-12">
		<div class="x_panel">
			<?php
			$curRoute = \Route::current()->getName();
			?>
			<a class="btn btn-outline-secondary btn-sm" href="{{route('dashboard2.index')}}">Event Berbayar</a>
			<a class="btn {{$curRoute == 'dashboard2.eventGratis' ? 'btn-secondary' : 'btn-outline-secondary'}} btn-sm" href="{{route('dashboard2.eventGratis')}}">Event Gratis</a>
			<form action="{{route('dashboard2.exportExcelEvent', 'gratis')}}">
				@csrf					
				<div class="row mb-2">
					<div class="col-md-4">
						<label for="">Tanggal Awal</label>
						<input type="date" name="tanggal_awal" class="form-control" placeholder="">
					</div>
					<div class="col-md-4">
						<label for="">Tanggal Akhir</label>
						<input type="date" name="tanggal_akhir" class="form-control" placeholder="">
					</div>						
				</div>
				<div class="row float-right">
					<div class="col-md">
						<button type="submit" class="btn btn-outline-primary btn-sm">Download Excel</button>
					</div>
				</div>
			</form>
			<table class="table table-bordered table-hover table-responsive" id="table-DatatableEventGratis">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Link Sertifikat</th>
						<th>Waktu Pelaksaan</th>
						<th>Panitia</th>
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

<script>
	$('[name=tanggal_awal]').change(function(){
		tableEventGratis.draw()
	})
	$('[name=tanggal_akhir]').change(function(){
		tableEventGratis.draw()
	})
	var tableEventGratis = $('#table-DatatableEventGratis').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			"url": "{{ route('dashboard2.dataTableEventGratis') }}",
			data: function(d){
				d.tgl1 = $('[name=tanggal_awal]').val()
				d.tgl2 = $('[name=tanggal_akhir]').val()
			}
		},
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'judul', 'name': 'judul'},
			{data: 'link_sertifikat', searchable: false},
			{data: 'created_at',searchable: false},
			{data: 'panitia', 'name': 'panitia'}
			]
	});
</script>
@endsection