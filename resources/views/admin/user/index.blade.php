@extends('layouts.template')
@section('breadcumb')
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>Provinsi</h3>
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
							<th>Nama</th>
							<th>Email</th>
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
@include('admin.provinsi.modal')
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$('body').on('click', '[id="btnAdd"]', function(e){
			showModal2('add')
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
					showAlert("Ada kesalahan dalam melihat data provinsi", "error")
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
					showAlert("Ada kesalahan dalam melihat data provinsi", "error")
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

			var form_data = new FormData($(this)[0]);
		// form_data.append('photo', $('[name=photo]').prop('files')[0]);

		$.ajax({
			type: 'post',
			url: $(this).attr("action"),
			data: form_data,
			dataType: 'json',
			processData: false,
			contentType: false,
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
			// form_data.append('photo', $('[name=photo]').prop('files')[0]);

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
				$('#modalShow [name=nama]').val(data.nama)
			}
			if (act == 'add') {
				$('#modalAdd').modal('show')
			}else if (act == 'show') {
				$('#modalShow .modal-title').text('Lihat Data Provinsi')
				$('#modalShow #btnUpdate').hide()
				$('#modalShow input, #modalShow textarea').attr('disabled', true)
			}else{
				$('#modalShow .modal-title').text('Ubah Data Provinsi')
				$('#modalShow #btnUpdate').show()
				$('#modalShow input, #modalShow textarea').attr('disabled', false)
				$('#modalShow form').attr({
					action: `${window.location}/${data.id}`,
					method: 'POST'
				})
			}
		}

		var table = $('#table-Datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('admin.provinsi.dataTables') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{data: 'nama', name: 'nama'},
			{data: 'email', name: 'email'},
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