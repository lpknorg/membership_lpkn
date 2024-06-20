<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List Event</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Toastr CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

</head>
<body>

	<div class="container mt-5">
		<h2>List Event</h2>
		<table class="mt-2 table table-hover table-bordered table-striped" id="users-table">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Waktu Pelaksanaan</th>
					<th>Panitia</th>
					<th>Link</th>
					<th>Lokasi</th>
					<th>Jumlah Peserta</th>
				</tr>
			</thead>
			<tbody>
				@for($i=1;$i<15;$i++)
				<tr>
					<td>{{$i}}</td>
					<td>ABC</td>
					<td>DEF</td>
					<td>GHI</td>
					<td>GHI</td>
					<td>GHI</td>
					<td>GHI</td>
				</tr>
				@endfor
			</tbody>
		</table>
	</div>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Toastr JS -->
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<!-- Custom JS -->
	<script>
		$(document).ready(function() {
			var table = $('#users-table').DataTable()
		});
	</script>
</body>
</html>
