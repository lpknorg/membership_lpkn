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
	<div class="mx-3">
		<h2 class="mb-4">Data Detail </h2>
		<!-- <a href="{{route('downloadZip', ['tipe' => 'foto_ktp', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm">Download KTP</a> -->
		<!-- <a href="{{route('downloadZip', ['tipe' => 'file_sk_pengangkatan_asn', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm">Download SK Pengangkatan ASN</a> -->
		<!-- <a href="{{route('downloadZip', ['tipe' => 'foto_profile', 'id_event' => $id_event])}}" class="btn btn-primary btn-sm">Download Pas Foto</a> -->
		<a href="{{\Request::url().'/excel'}}" class="btn btn-primary btn-sm">Download Excel</a>
		<div class="mt-3">
			@csrf
			<div class="table-responsive">
				<div class="row">
					<!-- <div class="col-md-2">
						<div class="form-group">
							<label>Warna Background</label>
							<input type="color" name="css-bg_color" class="form-control" value="#f0f0f0" />
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Warna Teks</label>
							<input type="color" name="css-font_color" class="form-control" value="#000" />
						</div>
					</div> -->
				</div>	
				<table class="table table-bordered table-hover" id="users-table">
					<thead>
						<tr>
							<!-- <th></th> -->
							<th>Password LKPP</th>
							<th>Marketing</th>
							<th>Keterangan</th>
							<th width="20%">Nama Lengkap(tanpa gelar)</th>
							<th>Nama Lengkap(dengan gelar)</th>
							<th>NIK</th>
							<th>Email Aktif</th>
							<th>No Whatsapp</th>
							<th>Tempat Lahir</th>
							<th>Tgl Lahir</th>
							<th>Pendidikan Terakhir</th>
							<th>Nama Pendidikan Terakhir</th>
							<th>Status Kepegawaian</th>
							<th>Posisi Pelaku Pengadaan</th>
							<th>Jenis Jabatan</th>
							<th>Nama Jabatan</th>
							<th>Golongan Terakhir</th>
							<th>NIP</th>
							<th>NRP</th>
							<th>Nama Instansi Lengkap</th>
							<th>Unit Organisasi</th>
							<th>Alamat Lengkap Kantor</th>
							<th>Kode Pos</th>
							<th>Paket Kontribusi</th>
							<th>Pas Foto</th>
							<th>KTP</th>
							<th>SK ASN</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $u)
						<tr id="custom{{$u->id}}">
							<!-- <td>
								<div class="form-group form-check">
									<input type="checkbox" class="form-check-input" id="cb-{{$u->id}}">
								</div>
							</td> -->
							<td><div data-nik="{{$u->userDetail->nik}}" class="editable" data-tipe="users" data-field="password_lkpp" data-placeholder="Click to edit">{{\Helper::passHashedDecrypt($u->userDetail->password_lkpp)}}</div></td>
							<td><div class="editable" data-tipe="user_event" data-field="marketing" data-placeholder="Click to edit">{{$u->marketing}}</div></td>
							<td><div class="editable" data-tipe="user_event" data-field="keterangan" data-placeholder="Click to edit">{{$u->keterangan}}</div></td>
							<td><div class="editable" data-tipe="users" data-field="name" data-placeholder="Click to edit">{{$u->userDetail->name}}</div></td>
							<td><div class="editable" data-tipe="member" data-field="nama_lengkap_gelar" data-placeholder="Click to edit">{{$u->userDetail->member->nama_lengkap_gelar}}</div></td>
							<td><div data-placeholder="Click to edit">{{$u->userDetail->nik}}</div></td>
							<td><div data-placeholder="Click to edit">{{$u->userDetail->email}}</div></td>
							<td><div data-tipe="member" data-field="no_hp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->no_hp}}</div></td>
							<td><div data-tipe="member" data-field="tempat_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tempat_lahir}}</div></td>
							<td><div data-tipe="member" data-field="tgl_lahir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->tgl_lahir}}</div></td>
							<td><div data-tipe="member" data-field="pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->pendidikan_terakhir}}</div></td>
							<td><div data-tipe="member" data-field="nama_pendidikan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->nama_pendidikan_terakhir}}</div></td>
							<td><div data-tipe="member_kantor" data-field="status_kepegawaian" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->status_kepegawaian}}</div></td>
							<td><div data-tipe="member_kantor" data-field="posisi_pelaku_pengadaan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->posisi_pelaku_pengadaan}}</div></td>
							<td><div data-tipe="member_kantor" data-field="jenis_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->jenis_jabatan}}</div></td>
							<td><div data-tipe="member_kantor" data-field="nama_jabatan" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_jabatan}}</div></td>
							<td><div data-tipe="member_kantor" data-field="golongan_terakhir" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->golongan_terakhir}}</div></td>
							<td><div data-tipe="users" data-field="nip" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nip}}</div></td>
							<td><div data-tipe="users" data-field="nrp" class="editable" data-placeholder="Click to edit">{{$u->userDetail->nrp}}</div></td>
							<td><div data-tipe="member_kantor" data-field="nama_instansi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->nama_instansi}}</div></td>
							<td><div data-tipe="member_kantor" data-field="unit_organisasi" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->unit_organisasi}}</div></td>
							<td><div data-tipe="member_kantor" data-field="alamat_kantor_lengkap" class="editable" data-placeholder="Click to edit" data-is_alamat="{{$u->userDetail->member->memberKantor->alamat_kantor_lengkap}}">{{\Helper::cutString($u->userDetail->member->memberKantor->alamat_kantor_lengkap, 15)}}</div></td>
							<td><div data-tipe="member_kantor" data-field="kode_pos" class="editable" data-placeholder="Click to edit">{{$u->userDetail->member->memberKantor->kode_pos}}</div></td>
							<td><div>{{$u->paket_kontribusi}}</div></td>
							<td><a href="{{\Helper::showImage($u->userDetail->member->foto_profile, 'poto_profile')}}" target="_blank">Lihat Dokumen</a></td>
							<td>
								@if($u->userDetail->member->foto_ktp)	
								<a href="{{\Helper::showImage($u->userDetail->member->foto_ktp, 'foto_ktp')}}" target="_blank">Lihat Dokumen</a>
								@else
								-
								@endif
							</td>
							<td>
								@if($u->userDetail->member->file_sk_pengangkatan_asn)
								<a href="{{\Helper::showImage($u->userDetail->member->file_sk_pengangkatan_asn, 'file_sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
								@else
								-
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
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
			$('body').on('input', '[name=css-bg_color]', function(e) {
				let _val = $(this).val()
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					$(`#custom${id}`).css('background-color', _val)
				})
			})
			$('body').on('input', '[name=css-font_color]', function(e) {
				let _val = $(this).val()
				$('input[type="checkbox"][id^="cb-"]:checked').each(function(){
					let id = $(this).attr('id')
					id = id.replace(/\D/g, '');
					$(`#custom${id} td`).css('color', _val)
				});				
			})
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
							// toastr.error('Terdapat kesalahan saat update data', 'Error');
						}
					}
				});
			}
			var table = $('#users-table').DataTable({
				"columnDefs": [
					{ "width": "300px", "targets": 1 }, // Mengatur lebar kolom pertama
					{ "width": "150px", "targets": 2 }  // Mengatur lebar kolom kedua
					],
				"autoWidth": false 
			})
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
					if(typeof($this.attr('data-is_alamat')) !== "undefined"){
						let fixalamat = $this.attr('data-is_alamat')
						$this.text(fixalamat)
					}
					$this.parent().addClass('editing');
				}).on('blur', function(){
					if($this.text().trim() === ''){
						$this.text(placeholder).addClass('placeholder');
					}
					// if(typeof($this.attr('data-is_alamat')) !== "undefined"){
					// 	let fixalamat = $this.attr('data-is_alamat').substr(0, 15)+'...'
					// 	$this.text(fixalamat)
					// }
					var _tipe = $this.data('tipe')
					var _field = $this.data('field')
					var _nik = $(this).closest('tr').find('div[data-nik]').data('nik');
					let sendData = {
						nik        : _nik,
						tipe       : _tipe,
						nama_field : _field,
						isi_field  : $this.text(),
						id_event   : '{{$id_event}}'
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
