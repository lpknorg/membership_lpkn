<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Kota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{route('admin.kota.store')}}">
				<div class="modal-body">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="kode">Provinsi</label>
								<select name="provinsi" class="form-control">
									<option value="">Pilih Provinsi</option>
									@foreach($provinsi as $p)
									<option value="{{$p->id}}">{{ucwords($p->nama)}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="nama">Nama Kota</label>
								<input type="text" class="form-control" name="kota" id="kota" placeholder="Nama Kota">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-check">
								<input type="hidden" name="kabupaten_checked" value="0">
								<input type="checkbox" class="form-check-input" id="exampleCheck1" name="kabupaten" value="1">
								<label class="form-check-label" for="exampleCheck1">Kabupaten</label>
								<div>
									<span class="text-warning">*Jika diceklis, maka kabupaten</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="modalShowLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST">
				<div class="modal-body">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="kode">Provinsi</label>
								<select name="provinsi" class="form-control">
									<option value="">Pilih Provinsi</option>

								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="nama">Nama Kota</label>
								<input type="text" class="form-control" name="kota" id="kota" placeholder="Nama Kota">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-check">
								<input type="hidden" name="kabupaten_checked" value="0">
								<input type="checkbox" class="form-check-input" id="exampleCheck2" name="kabupaten" value="1">
								<label class="form-check-label" for="exampleCheck2">Kabupaten</label>
								<div>
									<span class="text-warning">*Jika diceklis, maka kabupaten</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btnUpdate">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
