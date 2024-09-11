@extends('layouts.template')
@section('breadcumb')  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> 
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
			<div class="col-md-3 mb-2">
				<label for="">Tahun Awal</label>
				<input type="text" name="tanggal_awal" class="form-control datepicker" value="2022">
			</div>
			<div class="col-md-3 mb-2">
				<label for="">Tahun Akhir</label>
				<input type="text" name="tanggal_akhir" class="form-control datepicker" value="2024">
			</div>						
			<div id="div-response">

			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
	getDataLulus()
	function getDataLulus(year1=2022, year2=2024){
		$.ajax({
			url:"{{route('dashboard2.lulusPbj')}}",
			type: "get",
			data: {
				year1,
				year2,
			},
			beforeSend: function(){
				let a = '<div class="col-md-12">'
				a += '<h4 class="text-center">Load ...</h4></div>'
				$('#div-response').html(a)
			},
			success:function(result){
				console.log('work')
				$('#div-response').html(result)
			}
		});
	}
	$('[class~=datepicker]').datepicker({
		minViewMode: 2,
		format: 'yyyy',
		startDate: '2022',
	}).on('changeDate', function() {
		let year1 = $('[name=tanggal_awal]').val()
		let year2 = $('[name=tanggal_akhir]').val()
		getDataLulus(year1, year2)
	})	
</script>
@endsection