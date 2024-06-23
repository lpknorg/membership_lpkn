<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editable Table</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	<style>
		.table td {
			padding: 0.5rem;
			position: relative;
		}
		.editable {
			display: inline-block;
			width: 100%;
		}
		.edit-input {
			width: 100%;
			border: none;
			background: transparent;
			outline: none;
			display: block;
		}
		.edit-input:focus {
			background: #f0f0f0;
			border: 1px solid #007bff;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
		}
		.placeholder {
			color: #ccc;
		}
	</style>
</head>
<body>
	<div class="row mx-1">
		<h2 class="mb-4">Data PBJ - </h2>
		<div class="col-md-12">
		@csrf
			<table class="table table-bordered" id="users-table">
				<thead>
					<tr>
						<th scope="col">Password LKPP</th>
						<th scope="col">Email</th>
						<th scope="col">Nama Lengkap</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $u)
					<tr>
						<td><div data-nik="{{$u->nik}}" class="editable" data-placeholder="Click to edit">Password</div></td>
						<td><div class="editable" data-placeholder="Click to edit">{{$u->email}}</div></td>
						<td><div class="editable" data-placeholder="Click to edit">{{$u->name}}</div></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<!-- jQuery and Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script>
		$(document).ready(function(){
			function updateData(form_data){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('[name=_token]').val()
					}
				});

				$.ajax({
					type: 'post',
					url: '{{url('import_member')}}' + `/${form_data.nik}/store` ,
					data: form_data,
					dataType: 'json',
					success: function(data) {
						console.log(data)
						if (data.status == "ok") {
							toastr.success(data.messages, 'Berhasil');
						}
					},
					error: function(data) {
						console.log(data)
						var data = data.responseJSON;
						if (data.status == "fail") {
							toastr.error(data.messages, 'Error');
						}else{
							toastr.error('Terdapat kesalahan saat update data', 'Error');
						}
					}
				});
			}
			var table = $('#users-table').DataTable()
			$('.editable').each(function(){
				var $this = $(this);
				var placeholder = $this.data('placeholder');

				$this.attr('contenteditable', true);
				$this.addClass('edit-input');

				if($this.text().trim() === ''){
					$this.text(placeholder).addClass('placeholder');
				}

				$this.on('focus', function(){
					if($this.text() === placeholder){
						$this.text('').removeClass('placeholder');
					}                    
					$this.parent().addClass('editing');
				}).on('blur', function(){
					if($this.text().trim() === ''){
						$this.text(placeholder).addClass('placeholder');
					}
					let sendData = {
						nik: $this.data('nik'),
						password : $this.text()
					}
					updateData(sendData)
					$this.parent().removeClass('editing');
				}).on('dblclick', function(){
					var range = document.createRange();
					range.selectNodeContents(this);
					var selection = window.getSelection();
					selection.removeAllRanges();
					selection.addRange(range);
					var textToCopy = $this.text().trim();

					try {
						document.execCommand('copy');
						toastr.success(`Berhasil salin teks ${textToCopy}`, 'Berhasil');
					} catch (err) {
						console.log('Whoops, teks gagal disalin');
					}
				});
			});
		});
	</script>
</body>
</html>
