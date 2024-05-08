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
				d.id_event = 636
				d.status_pembayaran = $('[name=tanggal_awal]').val()
			}
		},
		columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'nama_lengkap', 'name': 'nama_lengkap'},
			{data: 'no_hp', 'name': 'no_hp'},
			{data: 'email_', 'name': 'email'},
			{data: 'instansi', 'name': 'instansi'},
			{data: 'unit_organisasi', 'name': 'unit_organisasi'},
			{data: 'status_pembayaran', searchable: false},
			]
	});
</script>
@endsection