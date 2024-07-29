<div class="col-md-12">				
	<table class="table table-bordered">
		<thead>
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
		</thead>
		<tbody>
			<tr>
				<td>{{\Request::get('year1').' - '.\Request::get('year2')}}</td>
				<td>Tingkat Kelulusan Tahun 2022 - 2024</td>
				<td>{{$totPbj[3]}}</td>
				<td>{{$totPbj[3]}}</td>
				<td>{{$totPbj[2]}}</td>
				<td>{{$totPbj[1]}}</td>
				<td>{{$totPbj[0]}}</td>
				<td>{{round($totPbj[1] / $totPbj[0] * 100, 2)}}%</td>
			</tr>
		</tbody>
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
			<td>{{round($l['peserta_lulus'] / $l['total_peserta'] * 100, 2)}}%</td>
		</tr>
		@endforeach
	</table>
</div>
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