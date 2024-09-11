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
</style>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="dashboard_graph x_panel">
			<div class="x_title">
				<div class="col-md-6">
					<h3>Data Member Berdasarkan Provinsi</h3>
				</div>
			</div>
			<div class="x_content">
				<canvas id="chartProvinsi"></canvas>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-4">
		<div class="x_panel fixed_height_320" style="height: 380px;">
			<div class="x_title">
				<h2>Data Member Berdasarkan Instansi</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<canvas id="chartInstansi"></canvas>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="x_panel fixed_height_320" style="height: 430px;">
			<div class="x_title">
				<h2>Data Member Berdasarkan <br> Status Kepegawaian</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<canvas id="chartStatusPeg"></canvas>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="x_panel fixed_height_320" style="height: 380px;">
			<div class="x_title">
				<h2>Data Member Berdasarkan KLPD</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<select name="instansi_id" class="form-control">
					<option value="">Pilih Instansi</option>
					@foreach($instansi as $i)
					<option value="{{$i->id}}">{{$i->nama}}</option>
					@endforeach
				</select>
				<div id="divKLPD">
					<div class="alert alert-warning mt-2">
						<b>Silakan pilih instansi terlebih dahulu</b>
					</div>
					<div class="alert alert-info mt-2" style="display: none">
						<b>Load ...</b>
					</div>
					<canvas id="chartMemberKLPD"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/chart.js')}}"></script>
<script>
	const ctx_prov = document.getElementById('chartProvinsi');

	new Chart(ctx_prov, {
		type: 'line',
		data: {
			labels: {!! json_encode($arr_provinsi) !!},
			datasets: [{
				label: 'Member',
				data: {!! json_encode($arr_total_byprovinsi) !!},
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});

	const ctx_instansi = document.getElementById('chartInstansi');
	new Chart(ctx_instansi, {
		type: 'doughnut',
		data: {
			labels: {!! json_encode($arr_instansi) !!},
			datasets: [{
				label: 'Member',
				data: {!! json_encode($arr_total_byinstansi) !!},
			}]
		}
	});

	const ctx_peg = document.getElementById('chartStatusPeg');
	new Chart(ctx_peg, {
		type: 'doughnut',
		data: {
			labels: {!! json_encode($arr_kepegawaian) !!},
			datasets: [{
				label: 'Member',
				data: {!! json_encode($arr_total_bykepegawaian) !!},
			}]
		}
	});
	$('body').on('change', '[name=instansi_id]', function(e) {
		let val = $(this).find(':selected').val()
		e.preventDefault()
		$.ajax({
			type: 'get',
			data: {
				instansi_id: val
			},
			url: "{{route('api.getMemberByLembagaPemerintahan')}}",
			beforeSend: function(){
				$('#divKLPD .alert-warning').hide()
				$('#divKLPD .alert-info').show()
				let chartStatus = Chart.getChart("chartMemberKLPD");
				if (chartStatus != undefined) {
					chartStatus.destroy();
				}
			},
			success: function(data) {
				$('#divKLPD .alert-info').hide()
				getDataKLPD(data)
			},
			error: function(data) {
				showAlert("Ada kesalahan dalam melihat data member berdasarkan instansi", "error")
			}
		});
	})

	function getDataKLPD(datas){
		const ctx_lp = document.getElementById('chartMemberKLPD');
		new Chart(ctx_lp, {
			type: 'bar',
			data: {
				labels: datas[0],
				datasets: [{
					label: 'Member',
					data: datas[1],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	}
</script>
@endsection