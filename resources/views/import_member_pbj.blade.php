<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload File Excel</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Toastr CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

</head>
<body>

	<div class="container mt-5">
		<div class="card mb-2">
			<div class="card-body">
				<h2>Upload File Excel</h2>
				<a class="btn btn-outline-secondary btn-sm" href="{{asset('excel/format_pbj/template_awal.xlsx')}}" download>Download Template</a>
				<form id="uploadForm" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="file_excel">Pilih file Excel</label>
						<input type="file" class="form-control" id="file_excel_pbj" name="file_excel_pbj">
					</div>
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>
			</div>
		</div>
		<table class="mt-2 table table-hover table-bordered" id="users-table">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Lengkap</th>
					<th>Email</th>
					<th>NIP</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Toastr JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<!-- Custom JS -->s
	<script>
		$(document).ready(function() {
			var table = $('#users-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{url('import_member_datatable')}}',
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
					{ data: 'email_', name: 'name' },
					{ data: 'email', name: 'email' },
					{ data: 'nip', name: 'nip' }
					]
			});
			$('#uploadForm').on('submit', function(event) {
				event.preventDefault();

				var formData = new FormData($(this)[0]);
				formData.append('dok_import_member', $('[name=file_excel_pbj]').prop('files')[0]);
				$.ajax({
					url: '{{url('import_member')}}',
					type: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					beforeSend: function(){
						$('button[type=submit]').attr('disabled', true).text('Load ...')
					},
					success: function(response) {
						table.ajax.reload()
						if (response.status == 'oke') {
							toastr.success(response.messages, 'Berhasil');
						} else {
							toastr.error('Ada kesalahan saat upload file', 'Gagal');
						}
						$('button[type=submit]').attr('disabled', false).text('Upload')
					},
					error: function() {
						$('button[type=submit]').attr('disabled', false).text('Upload')
						toastr.error('Terjadi kesalahan saat mengunggah file.', 'Gagal');
					},
					complete: function(){
						$('button[type=submit]').attr('disabled', false).text('Upload')
					}
				});
			});
		});
	</script>
</body>
</html>
