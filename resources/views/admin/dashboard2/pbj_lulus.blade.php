@extends('layouts.template')
@section('breadcumb')   
<style>
	table tr:first-child td{
		text-align: center;
	}
	/*table tr:first-child td:first-child{
		vertical-align: middle;
	}	*/
</style> 
<div class="row">
	<div class="page-title ml-2">
		<div class="title_left">
			<h3 class="mb-0">Dashboard</h3>			
			<h5>Chart Kelulusan PBJ</h5>
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
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td>Tahun</td>
						<td>Keterangan</td>
						<td>Jumlah Pelatihan</td>
						<td>Jumlah Ujian</td>
						<td>Hadir Ujian</td>
						<td>Lulus Ujian</td>
						<td>Tidak Lulus</td>
						<td>Persentase</td>
					</tr>
					<tr>
						<td>2022 - 2024</td>
						<td>Tingkat Kelulusan Tahun 2022 - 2024</td>
						<td>{{$totPbj[3]}}</td>
						<td>{{$totPbj[3]}}</td>
						<td>{{$totPbj[2]}}</td>
						<td>{{$totPbj[1]}}</td>
						<td>{{$totPbj[0]}}</td>
						<td>{{round($totPbj[1] / $totPbj[0] * 100, 2)}}%</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<canvas id="chartKelulusan"></canvas>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered" id="table-rekap">
					<tr>
						<td rowspan="2" style="padding: 3px;vertical-align: middle">Nama Kegiatan</td>
						<td rowspan="2" style="padding: 3px;vertical-align: middle">Tahun</td>
						<td colspan="4" style="padding: 3px;">Jumlah</td>
					</tr>
					<tr>						
						<!-- <td>Pelatihan</td> -->
						<td>Hadir Ujian</td>
						<td>Lulus Ujian</td>
						<td>Tidak Lulus</td>
						<td>Persentase</td>
					</tr>
					@foreach($api_pbj[0]['list_kelulusan'] as $l)
					<tr>
						<td>Pelatihan dan Sertifikasi PBJ Dasar</td>
						<td>{{$l['tahun']}}</td>
						<td>{{$l['total_peserta']}}</td>
						<td>{{$l['peserta_lulus']}}</td>
						<td>{{$l['peserta_tidak_lulus']}}</td>
						<td>{{round($l['peserta_lulus'] / $l['peserta_tidak_lulus'] * 100, 2)}}%</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
	const ctx_kelulusan = document.getElementById('chartKelulusan');
	new Chart(ctx_kelulusan, {
		type: 'bar',
		data: {
			labels: ['Tida Lulus', 'Lulus', 'Hadir Ujian', 'Jumlah Pelatihan'],
			datasets: [{
				label: 'Jumlah',
				data: {!! json_encode($totPbj) !!},
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
	
</script>
@endsection