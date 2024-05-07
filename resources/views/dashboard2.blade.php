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

<!-- <div class="row">
	<div class="col-md-4">
		<div class="x_panel fixed_height_320" style="height: 380px;">
			<div class="x_title">
				<h2>Total Event Berdasarkan Jenis</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<canvas id="chartTipe"></canvas>
			</div>
		</div>
	</div>
</div> -->
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-event_berbayar-tab" data-toggle="tab" data-target="#nav-event_berbayar" type="button" role="tab" aria-controls="nav-event_berbayar" aria-selected="true">Event Berbayar</button>
					<button class="nav-link" id="nav-event_gratis-tab" data-toggle="tab" data-target="#nav-event_gratis" type="button" role="tab" aria-controls="nav-event_gratis" aria-selected="true">Event Gratis</button>
					<button class="nav-link" id="nav-alumni-tab" data-toggle="tab" data-target="#nav-alumni" type="button" role="tab" aria-controls="nav-alumni" aria-selected="false">Peserta</button>
				</div>
			</nav>
			<div class="tab-content mt-2" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-event_berbayar" role="tabpanel" aria-labelledby="nav-event_berbayar-tab">
					<form action="{{route('dashboard2.exportExcelEvent')}}">
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
					<table class="table table-bordered table-hover table-responsive" id="table-DatatableEvent">
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
				<div class="tab-pane fade" id="nav-event_gratis" role="tabpanel" aria-labelledby="nav-event_gratis-tab">EVENT Gratis Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium at ducimus aspernatur tempora, inventore sunt placeat ut labore vero nulla nesciunt vel reiciendis voluptate consequuntur? Molestias eum ipsa earum!</div>
				<div class="tab-pane fade" id="nav-alumni" role="tabpanel" aria-labelledby="nav-alumni-tab">PESERTA Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium at ducimus aspernatur tempora, inventore sunt placeat ut labore vero nulla nesciunt vel reiciendis voluptate consequuntur? Molestias eum ipsa earum!</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')

<script src="{{asset('js/chart.js')}}"></script>
<script>
	$('[name=tanggal_awal]').change(function(){
		tableEvent.draw()
	})
	$('[name=tanggal_akhir]').change(function(){
		tableEvent.draw()
	})
	$('[name=kategori_event]').change(function(){
		tableEvent.draw()
	})
	$('[name=jenis_event]').change(function(){
		tableEvent.draw()
	})
	var tableEvent = $('#table-DatatableEvent').DataTable({
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
			{data: 'tgl_start', name: 'tgl_start'},
			{data: 'tgl_end', name: 'tgl_end'},
			{data: 'img_brosur', searchable: false},
			{data: 'nama_panitia', name: 'nama_panitia'},
			{data: 'link_event', searchable: false},
			{data: 'lokasi_event', name: 'lokasi_event'},
			]
	});
	// const ctx_tipee = document.getElementById('chartTipe');
	// new Chart(ctx_tipee, {
	// 	type: 'doughnut',
	// 	data: {
	// 		labels: {!! json_encode($arr_tipe_event) !!},
	// 		datasets: [{
	// 			label: 'Kategori Event',
	// 			data: {!! json_encode($arr_total_bytipe) !!},
	// 		}]
	// 	}
	// });
</script>
@endsection