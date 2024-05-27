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
	#table-rekap td{
		text-align: center;
	}
	#table-rekap td:first-child{
		vertical-align: middle;
	}
	/*#table-rekap tr:first-child td:nth-child(2n){
		background-color: #f5f5f5;
	}*/
	/*#table-rekap tr:nth-child(2) td:nth-child(-n+3), #table-rekap tr:nth-child(2) td:nth-child(n+7):nth-child(-n+9){
		background-color: #f5f5f5;
	}
	#table-rekap tr:nth-child(n+3):nth-child(-n+5) td:nth-child(n+2):nth-child(-n+4), #table-rekap tr:nth-child(n+3):nth-child(-n+5) td:nth-child(n+8):nth-child(-n+10){
		background-color: #f5f5f5;
	}*/
	#table-rekap td{
		border-color: #7c7b7b;
	}
	#table-rekap td{
		color: #000;
	}
	#table-rekap tr:nth-child(3), #table-rekap tr:nth-child(5){
		background-color: #f5f5f5;
	}
	#div-table-rekaptahunan tr:nth-child(1) td:nth-child(2):hover,#div-table-rekaptahunan tr:nth-child(1) td:nth-child(3):hover,#div-table-rekaptahunan tr:nth-child(1) td:nth-child(4):hover{
		cursor: pointer;
		background-color: #91bcf1 !important;
	}
</style>
<div class="row mt-3">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="col-md-6">
				<canvas id="chartKelulusan"></canvas>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered" id="table-rekap">
					<tr>
						<td rowspan="2" style="padding: 3px;">Nama Kegiatan</td>
						<td rowspan="2" style="padding: 3px;">Tahun</td>
						<td colspan="4" style="padding: 3px;">Jumlah</td>
					</tr>
					<tr>						
						<td>Pelatihan</td>
						<td>Hadir Ujian</td>
						<td>Lulus Ujian</td>
						<td>Tidak Lulus</td>
					</tr>
					<tr>
						<td>Pelatihan dan Sertifikasi PBJ Dasar</td>
						<td>2022</td>
						<td>110</td>
						<td>3162</td>
						<td>1507</td>
						<td>1655</td>						
					</tr>
					<tr>
						<td>Pelatihan dan Sertifikasi PBJ Dasar</td>
						<td>2023</td>
						<td>110</td>
						<td>3162</td>
						<td>1507</td>
						<td>1655</td>						
					</tr>
					<tr>
						<td>Pelatihan dan Sertifikasi PBJ Dasar</td>
						<td>2024</td>
						<td>110</td>
						<td>3162</td>
						<td>1507</td>
						<td>1655</td>						
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-md-12" id="div-table-rekaptahunan">
		<div class="x_panel">
			<h5>Rekap Event Tahunan</h5>
			<a href="{{\Request::url().'?refresh_api=1'}}" class="btn btn-outline-primary btn-sm">Refresh Data</a>
			<table class="table table-bordered" id="table-rekap">
				<tr>
					<td rowspan="2">KEGIATAN</td>
					@foreach($arrYear as $y)
					<td colspan="2" style="padding: 3px;background-color: #bdd7f7;"><a href="javascript:void" data-year="{{$y['tahun']}}" style="color: #000;text-decoration: underline;font-size: 15px;">{{$y['tahun']}}</a></td>
					@endforeach
				</tr>
				<tr>
					@for($i=0;$i<3;$i++)
					@foreach($listStatus as $l)
					<td>{{$l}}</td>
					@endforeach
					@endfor
				</tr>
				@foreach($newArrayTahun as $k => $v)
				<tr>
					<td>{{$k}}</td>
					@foreach($v as $value)
					<td>{{$value}}</td>
					@endforeach
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="col-md-12" id="div-table-rekapbulanan">

	</div>
</div>
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
							<option value="">Semua Kategori</option>
							<?php $jjenis = ['PBJ', 'CPOF', 'CPST', 'CPSP'] ?>;
							@foreach($jjenis as $j)
							<option value="{{strtolower($j)}}">{{$j}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="">Jenis Kelas</label>
						<select name="jenis_event" class="form-control">
							<option value="">Semua Jenis Kelas</option>
							<option value="0">Online</option>
							<option value="1">Tatap Muka</option>
						</select>
					</div>						
				</div>
				<div class="row float-right">
					<div class="col-md">
						<a href="{{route('dashboard2.exportAlumniRegis')}}" class="btn btn-outline-primary btn-sm" id="btnDownloadRegist">Download Excel Data Registrasi</a>
						<button type="submit" class="btn btn-outline-primary btn-sm">Download Excel Event</button>
					</div>
				</div>
			</form>
			<table class="table table-bordered table-hover table-responsive" id="table-DatatableEventBerbayar">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Tgl Start</th>
						<th>Tgl End</th>
						<th>Nama Panitia</th>
						<th>Link</th>
						<th>Jumlah Peserta</th>
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
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
	const ctx_kelulusan = document.getElementById('chartKelulusan');

	new Chart(ctx_kelulusan, {
		type: 'bar',
		data: {
			labels: ['Tida Lulus', 'Lulus', 'Hadir Ujian', 'Jumlah Pelatihan'],
			datasets: [{
				label: 'Jumlah',
				data: [1655, 1507, 3162, 110],
				backgroundColor: ['rgba(255, 159, 64, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(201, 203, 207, 0.2)',
					'rgba(54, 162, 235, 0.2)'
					],
				borderColor: [
					'rgb(255, 159, 64)',
					'rgb(153, 102, 255)',
					'rgb(201, 203, 207)',
					'rgb(54, 162, 235)'
					],
				borderWidth: 1				
			}]
		},
		options: {
			indexAxis: 'y',
			plugins: {
				legend: {
					display: true,
					position: 'top'
				},
				datalabels: {
					anchor: 'center',
					align: 'center',
					formatter: (value, context) => {
						return value;
					},
					color: 'black'
				}
			}
		},
		plugins: [ChartDataLabels]
	});
	function getTotalByYear(year=2024){
		$.ajax({
			url:"{{route('dashboard2.responseByBulan')}}",
			type: "get",
			data: {
				year:year,
			},
			beforeSend: function(){
				$('#div-table-rekapbulanan').html('<div class="alert alert-info">Load ...</div>')
			},
			success:function(result){
				$('#div-table-rekapbulanan').html(result)
				setTimeout(() => {
					$('[id*=rekapp2] tr:nth-child(3) td:nth-child(26)').text(totalTd(3))
					$('[id*=rekapp2] tr:nth-child(4) td:nth-child(26)').text(totalTd(4))
					$('[id*=rekapp2] tr:nth-child(5) td:nth-child(26)').text(totalTd(5))
				}, 500)
			}
		});
	}	
	$('#div-table-rekaptahunan tr:nth-child(1) td:nth-child(2),#div-table-rekaptahunan tr:nth-child(1) td:nth-child(3),#div-table-rekaptahunan tr:nth-child(1) td:nth-child(4)').click(function(){
		let _year = $(this).find('a').attr('data-year')
		getTotalByYear(_year)
	})
	@if(\Request::get('refresh_api'))
	let fUrl = window.location
	fUrl = fUrl.replace('dashboard2', '?refresh_api=1')
	@endif	
	function totalTd(num_tr){
		let total = 0
		$(`[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(3),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(5),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(7),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(9),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(11),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(13),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(15),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(17),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(19),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(21),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(23),[id*=rekapp2] tr:nth-child(${num_tr}) td:nth-child(25)`).each(function(){
			let value = parseInt($(this).text());
			if (!isNaN(value)) {
				total += value;
			}			
		})
		return total
	}	
	function _vall(names){
		return $(`[name=${names}]`).val()
	}
	function getStringDownloadRegist(){
		let abc = '{{url('dashboard2')}}'
		abc += `/exportAlumniRegis?tanggal_awal=${_vall('tanggal_awal')}`
		abc += `&tanggal_akhir=${_vall('tanggal_akhir')}`
		abc += `&kategori_event=${_vall('kategori_event')}`
		abc += `&jenis_event=${_vall('jenis_event')}`
		return abc
	}
	$('[name=tanggal_awal]').change(function(){
		let _href = getStringDownloadRegist()
		$('#btnDownloadRegist').attr('href', _href)
		tableEventBerbayar.draw()
	})
	$('[name=tanggal_akhir]').change(function(){
		let _href = getStringDownloadRegist()
		$('#btnDownloadRegist').attr('href', _href)
		tableEventBerbayar.draw()
	})
	$('[name=kategori_event]').change(function(){
		let _href = getStringDownloadRegist()
		$('#btnDownloadRegist').attr('href', _href)
		tableEventBerbayar.draw()
	})
	$('[name=jenis_event]').change(function(){
		let _href = getStringDownloadRegist()
		$('#btnDownloadRegist').attr('href', _href)
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
			{data: 'link_list_alumni', name: 'judul'},
			{data: 'tgl_start', searchable: false},
			{data: 'tgl_end', searchable: false},
			{data: 'nama_panitia', name: 'nama_panitia'},
			{data: 'link_event', searchable: false},
			{data: 'jumlah_peserta', name: 'jumlah_peserta'},
			]
	});
</script>
@endsection