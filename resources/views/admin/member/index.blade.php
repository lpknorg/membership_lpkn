@extends('layouts.template')
@section('breadcumb')
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>Member</h3>
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
							<th width="50%">No member</th>
                            <th width="50%">Nama lengkap</th>
                            <th width="50%">Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('admin.member.modal')
@endsection
@section('scripts')
<script>
	$(document).ready(function(){
		$('body').on('click', '[id="btnHapus"]', function(e) {
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
								Swal.fire('Berhasil', data.messages, 'success')
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
		$('body').on('click', '[id="btnAdd"]', function(e) {
			showModal2('add')
		})
		$('body').on('click', '[id^="btnLihat"]', function(e) {
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					console.log(data)
					showModal2('show', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data member", "error")
				}
			});
		})
		$('body').on('click', '[id^="btnEdit"]', function(e) {
			e.preventDefault()
			$.ajax({
				type: 'get',
				url: $(this).attr("href"),
				success: function(data) {
					console.log(data)
					showModal2('edit', data)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam melihat data member", "error")
				}
			});
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
				beforeSend: function() {
					sendAjax('#btnSimpan', false)
				},
				success: function(data) {
					console.log(data)
					if (data.status == "ok") {
						showAlert(data.messages)
						setTimeout(function() {
							$('#modalAdd').modal('hide')
							$('#modalAdd input:not([name=_token]').val('')
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
							$('#modalShow input:not([name=_token]), #modalShow textarea').val(
								'')
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

		function showModal2(act, data = null) {
			if (act == 'show' || act == 'edit') {
				$('#modalShow').modal('show')
				$('#modalShow [name=no_member]').val(data.no_member)
                $('#modalShow [name=nik]').val(data.nik)
                $('#modalShow [name=email]').val(data.email)
                $('#modalShow [name=nama_lengkap]').val(data.nama_lengkap)
                $('#modalShow [name=no_hp]').val(data.no_hp)
                $('#modalShow [name=alamat_lengkap]').val(data.alamat_lengkap)
                $('#modalShow [name=tempat_lahir]').val(data.tempat_lahir)
                $('#modalShow [name=tgl_lahir]').val(data.tgl_lahir)
                $('#modalShow [name=ref]').val(data.ref)
                $('#modalShow [name=bank_rek_ref]').val(data.bank_rek_ref)
                $('#modalShow [name=no_rek_ref]').val(data.no_rek_ref)
                $('#modalShow [name=an_rek_ref]').val(data.an_rek_ref)
                $('#modalShow [name=pp]').val(data.pp)
                $('#modalShow [name=fb]').val(data.fb)
                $('#modalShow [name=instagram]').val(data.instagram)
                $('#modalShow [name=expired_date]').val(data.expired_date)
                $('#modalShow [name=nip]').val(data.nip)
			}
			if (act == 'add') {
				$('#modalAdd').modal('show')
			} else if (act == 'show') {
				$('#modalShow .modal-title').text('Lihat Data member')
				$('#modalShow #btnUpdate').hide()
				$('#modalShow input, #modalShow textarea').attr('disabled', true)
			} else {
				$('#modalShow .modal-title').text('Ubah Data member')
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
			ajax: "{{ route('admin.member.dataTables') }}",
			columns: [{
				data: 'DT_RowIndex',
				name: 'DT_RowIndex',
				orderable: false,
				searchable: false
			},
			{
				data: 'no_member',
				name: 'no_member'
			},
            {
				data: 'email',
				name: 'email'
			},
            {
				data: 'nama_lengkap',
				name: 'nama_lengkap'
			},
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
