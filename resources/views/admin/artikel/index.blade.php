@extends('layouts.template')
@section('breadcumb')
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>Artikel Kategori</h3>
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
							<th>Judul</th>
							<th>Deskripsi</th>
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
@include('admin.artikel.modal')
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$('body').on('click', '[id^="btnEdit"]', function(e){
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					showModal2('edit', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data artikel kategori", "error")
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
		$('body').on('change', '[name=status_id]', function($q){
			let _v = $(this).find(':selected').val()
			if(_v == 2 || _v == 5){
				$('#divAlasanTolak').show()
			}else{
				$('#divAlasanTolak').hide()
			}
		})

		function showModal2(act, data=null){
			console.log(data)
			if(act == 'show' || act == 'edit'){
				$('#modalShow').modal('show')
				$('#modalShow .modal-title').text('Ubah Data Artikel')
				$('#modalShow #btnUpdate').show()
				$('#modalShow input, #modalShow textarea').attr('disabled', false)
				$('#modalShow form').attr({
					action: '{{url()->full()}}'+`/${data.id}`,
					method: 'POST'
				})

				$('#modalShow [name=judul]').val(data.judul)
				var _cont = `<label>Ubah Status</label>`
				_cont += `<select name="status_id" class="form-control">
				<option value="0" ${data.status_id == 0 ? 'selected' : ''}>Pending</option>
				<option value="1" ${data.status_id == 1 ? 'selected' : ''}>Setuju</option>
				<option value="2" ${data.status_id == 2 ? 'selected' : ''}>Tolak</option>
				<option value="3" ${data.status_id == 3 ? 'selected' : ''}>Pengajuan Edit</option>
				<option value="4" ${data.status_id == 4 ? 'selected' : ''}>Pending Edit</option>
				<option value="5" ${data.status_id == 5 ? 'selected' : ''}>Tolak Edit</option>
				<option value="6" ${data.status_id == 6 ? 'selected' : ''}>Setuju Edit</option>
				<option value="7" ${data.status_id == 7 ? 'selected' : ''}>Pengajuan Ulang</option>
				</select>`								
				$('#modalShow #div-ubahstatus').html(_cont)

				if(data.status_id == 2 || data.status_id == 5){
					$('#divAlasanTolak').show()
					$('[name=alasan_tolak]').val(data.alasan_tolak)
				}else{
					$('#divAlasanTolak').hide()
					$('[name=alasan_tolak]').val(null)
				}
			}
			
		}

		var table = $('#table-Datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('admin.artikel.dataTables') }}",
			columns: [
				{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
				{data: 'judul', name: 'judul'},
				{data: 'deskripsi', name: 'judul'},
				{
					data: 'status',
					name: 'judul',
					orderable: false,
					searchable: false
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false
				},
				]
		});
	})
</script>
@endsection