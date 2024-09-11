@extends('layouts.template')
@section('breadcumb')
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>Kota</h3>
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12">
		<button class="btn btn-primary btn-sm" id="btnAdd">Tambah</button>
		<div class="dashboard_graph x_panel">
			<div class="x_content">
				<table class="table table-hover table-bordered table-responsive-sm" id="table-Datatable" style="width: 100%;">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Nama Provinsi</th>
							<th>Nama Kota</th>
							<th>Kabupaten</th>
							<th width="90px">Action</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.kota.modal')
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$('#modalAdd [name=provinsi]').select2({
			dropdownParent: $('#modalAdd .modal-content'),
			width : '100%'
		})
		$('#modalShow [name=provinsi]').select2({
			dropdownParent: $('#modalShow .modal-content'),
			width : '100%'
		})
		$('body').on('click', '[id="btnAdd"]', function(e){
			showModal2('add')
		})
		$('#modalAdd [name=kabupaten]').change(function(){
			if($(this).is(":checked")) {
				$('#modalAdd [name=kabupaten_checked]').val(1)
			}else{
				$('#modalAdd [name=kabupaten_checked]').val(0)
			}
		})
		$('#modalShow [name=kabupaten]').change(function(){
			if($(this).is(":checked")) {
				$('#modalShow [name=kabupaten_checked]').val(1)
			}else{
				$('#modalShow [name=kabupaten_checked]').val(0)
			}
		})
		$('body').on('click', '[id^="btnShow"]', function(e){
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					console.log(data);
					showModal2('show', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data Kota", "error")
				}
			});
		})
		$('body').on('click', '[id^="btnEdit"]', function(e){
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					console.log(data)
					showModal2('edit', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data Kota", "error")
				}
			});
		})
		$('body').on('click', '[id="btnHapus"]', function(e){
			Swal.fire({
				title: 'Apa anda yakin ?',
				text: "Data akan hilang jika dihapus!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('[name=_token]').val()
						}
					});

					$.ajax({
						type: 'DELETE',
						url: $(this).attr("action"),
						data: {
							id: $(this).attr('data-id')
						},
						dataType: 'json',
						success: function(data) {
							console.log(data)
							if (data.status == "ok") {
								Swal.fire('Berhasil',data.messages,'success')
								table.ajax.reload()
							}
						},
						error: function(data) {
							var data = data.responseJSON;
							if (data.status == "fail") {
								alertShow(data.messages, "error")
							}
						}
					});
				}
			})
		})
		$('#modalAdd form').submit(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function() {
					sendAjax('#btnSimpan', false)
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						showAlert(data.messages)
						setTimeout(function() {
							$('#modalAdd').modal('hide')
							$('#modalAdd input:not([name=_token]), #modalAdd textarea').val('')
						}, 1000);
						table.ajax.reload()
					}
				},
				error: function(data) {
					var data = data.responseJSON;
					if (data.status == "fail") {
						showAlert(data.messages, "error")
					}
				},
				complete: function() {
					sendAjax('#btnSimpan', true, 'Simpan')
				}
			});
		});
		$('#modalShow form').submit(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});

			var form_data = new FormData($(this)[0]);
			form_data.append('_method', 'PATCH')

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				beforeSend: function() {
					sendAjax('#btnUpdate', false)
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						showAlert(data.messages)
						setTimeout(function() {
							$('#modalShow').modal('hide')
							$('#modalShow input:not([name=_token]), #modalShow textarea').val('')
						}, 1000);
						table.ajax.reload()
					}
				},
				error: function(data) {
					var data = data.responseJSON;
					console.log(data)
					if (data.status == "fail") {
						showAlert(data.messages, "error")
					}
				},
				complete: function() {
					sendAjax('#btnUpdate', true, 'Update')
				}
			});
		});

		function showModal2(act, data=null){
			if(act == 'show' || act == 'edit'){
				$('#modalShow').modal('show')
				$('#modalShow [name=kota]').val(data.kota.kota)
				let provinsi = '<option value="">-- Pilih Provinsi --</option>'
				$.each(data.provinsi, function(k, v){
					provinsi += `<option value="${v.id}" ${data.kota.id_provinsi == v.id ? 'selected' : ''} >${v.nama}</option>`
				})
				$('#modalShow [name=provinsi]') .html(provinsi)
				if (data.kota.kabupaten == 1) {
					$('#modalShow [name=kabupaten]').attr('checked', true)
				}else{
					$('#modalShow [name=kabupaten]').attr('checked', false)
				}
			}
			if (act == 'add') {
				$('#modalAdd').modal('show')
			}else if (act == 'show') {
				$('#modalShow .modal-title').text('Lihat Data Kota')
				$('#modalShow #btnUpdate').hide()
				$('#modalShow input, #modalShow select').attr('disabled', true)
			}else{
				$('#modalShow .modal-title').text('Ubah Data Kota')
				$('#modalShow #btnUpdate').show()
				$('#modalShow input, #modalShow select').attr('disabled', false)
				$('#modalShow form').attr({
					action: `${window.location}/${data.kota.id}`,
					method: 'POST'
				})
			}
		}

		var table = $('#table-Datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('admin.kota.dataTables') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'provinsi', name: 'provinsi.nama'},
			{data: 'kota', name: 'kota'},
			{data: 'is_kabupaten', name: 'kota'},
			{
				data: 'action',
				name: 'action',
				orderable: true,
				searchable: true
			},
			]
		});
	})
</script>
@endsection