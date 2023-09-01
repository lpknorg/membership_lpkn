<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{route('admin.video.store')}}">
				<div class="modal-body">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="judul">Judul</label>
								<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Video">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="link">Link link</label>
								<input type="text" class="form-control" name="link" id="link" placeholder="Link Video">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-check-label" for="keterangan">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan Video"></textarea>
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
								<label for="judul">Judul</label>
								<input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Video">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="link">Link link</label>
								<input type="text" class="form-control" name="link" id="link" placeholder="Link Video">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-check-label" for="exampleCheck1">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" id="keterangan" placeholder="keterangan Video"></textarea>
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
