@extends('layouts.template')
@section('breadcumb')

<div class="row">
	<div class="page-title ml-2">
		<div class="title_left">
			<h3 class="mb-0">Dashboard</h3>			
			<h5>List Event Berbayar</h5>
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
			<a class="btn {{$curRoute == 'dashboard2.index' ? 'btn-secondary' : 'btn-outline-secondary'}} btn-sm" href="{{route('dashboard2.index')}}">Event Berbayar</a>
			<a class="btn btn-outline-secondary btn-sm" href="{{route('dashboard2.eventGratis')}}">Event Gratis</a>
			<form action="{{route('dashboard2.exportExcelEvent', 'berbayar')}}">
				@csrf					
				<div class="row mb-2">
					<div class="col-md-3">
						<label for="">Tanggal Awal</label>
						<input type="date" name="tanggal_awal" class="form-control" placeholder="">
					</div>
					<div class="col-md-3">
						<label for="">Tanggal Akhir</label>
						<input type="date" name="tanggal_akhir" class="form-control" placeholder="">
					</div>
					<div class="col-md-3">
						<label for="">Kategori Event</label>
						<select name="kategori_event" class="form-control">
							<option value="">Pilih Kategori Event</option>
							<?php $jjenis = ['PBJ', 'CPOF', 'CPST', 'CPSP'] ?>;
							@foreach($jjenis as $j)
							<option value="{{strtolower($j)}}">{{$j}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="">Jenis Kelas</label>
						<select name="jenis_event" class="form-control">
							<option value="">Pilih Jenis Kelas</option>
							<option value="0">Online</option>
							<option value="1">Tatap Muka</option>
						</select>
					</div>						
				</div>
				<div class="row float-right">
					<div class="col-md">
						<button type="submit" class="btn btn-outline-primary btn-sm">Download Excel</button>
					</div>
				</div>
			</form>
			<table class="table table-bordered table-hover table-responsive" id="table-DatatableEventBerbayar">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis</th>
						<th>Judul</th>
						<th>Tgl Start</th>
						<th>Tgl End</th>
						<th>Brosur</th>
						<th>Nama Panitia</th>
						<th>Link</th>
						<th>Lokasi Event</th>
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
		tableEventBerbayar.draw()
	})
	$('[name=tanggal_akhir]').change(function(){
		tableEventBerbayar.draw()
	})
	$('[name=kategori_event]').change(function(){
		tableEventBerbayar.draw()
	})
	$('[name=jenis_event]').change(function(){
		tableEventBerbayar.draw()
	})
	var tableEventBerbayar = $('#table-DatatableEventBerbayar').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			"url": "{{ route('dashboard2.dataTableEvent') }}",
			data: function(d){
				d.tanggal_awal = $('[name=tanggal_awal]').val()
				d.tanggal_akhir = $('[name=tanggal_akhir]').val()
				d.kategori_event = $('[name=kategori_event]').find(":selected").val()
				d.jenis_event = $('[name=jenis_event]').find(":selected").val()
			}
		},
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'jenis', name: 'jenis'},
			{data: 'link_list_alumni', name: 'judul'},
			{data: 'tgl_start', searchable: false},
			{data: 'tgl_end', searchable: false},
			{data: 'img_brosur', searchable: false},
			{data: 'nama_panitia', name: 'nama_panitia'},
			{data: 'link_event', searchable: false},
			{data: 'lokasi_event', name: 'lokasi_event'},
			]
	});
</script>
@endsection