@extends('layouts.template')
@section('breadcumb')
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>User</h3>
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12">
		<button class="btn btn-primary btn-sm" id="btnAdd">Tambah</button>
		<div class="row float-right">
			<div class="col-md-12">
				<div class="form-group">
					<form action="{{url('import_member')}}" method="POST" enctype="multipart/form-data">
						@csrf
						<a href="{{route('downloadFile', ['file' =>  'template_member.xlsx', 'excel?']).rand(1, 9999)}}" class="btn btn-primary btn-sm float-right">Import Template</a>
						<label for="char">Dokumen Import</label>
						<input type="file" class="form-control" name="dok_import_member" placeholder="Dokumen Import Member" required>
						<button type="submit" class="btn btn-success btn-sm mt-2">Import Member</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="dashboard_graph x_panel">
			<div class="x_content">
				<table class="table table-hover table-bordered table-responsive-sm" id="table-Datatable" style="width: 100%;">
					<thead>
						<tr>
							<th width="10px">No</th>
							<th>Nama Lengkap</th>
							<th>Email</th>
							<th>NIP</th>
							<th>Status</th>
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
@include('admin.User.modal')
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		@if(\Session::has('success_import_member'))
        showAlert('{{\Session::get('success_import_member')}}')
        @endif
		$('body').on('click', '[id="btnAdd"]', function(e){
			showModal2('add')
		})
		$('body').on('click', '[id^="btnShow"]', function(e){
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					showModal2('show', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data User", "error")
				}
			});
		})
		$('body').on('click', '[id^="btnEdit"]', function(e){
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					showModal2('edit', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data User", "error")
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
				$('#modalShow [name=name]').val(data.name)
				$('#modalShow [name=email]').val(data.email)
				$('#modalShow [name=password]').val(data.password)
				console.log(data.is_confirm)
				if (parseInt(data.is_confirm) == 1) {
					$('#modalShow [name=verifikasi_akun]').prop('checked', true)
				}else{
					$('#modalShow [name=verifikasi_akun]').prop('checked', false)
				}
			}
			if (act == 'add') {
				$('#modalAdd').modal('show')
			}else if (act == 'show') {
				$('#modalShow .modal-title').text('Lihat Data User')
				$('#modalShow #btnUpdate').hide()
				$('#modalShow input, #modalShow textarea').attr('disabled', true)
			}else{
				$('#modalShow .modal-title').text('Ubah Data User')
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
			ajax: "{{ route('admin.user.dataTables') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
				{data: 'name', name: 'name'},
				{data: 'email', name: 'email'},
				{data: 'nip', name: 'nip'},
				{
					data: 'status_user',
					name: 'status_user',
					orderable: true,
					searchable: false
				},
				{
					data: 'action',
					name: 'action',
					orderable: true,
					searchable: false
				},
				]
		});
	})
</script>
@endsection
