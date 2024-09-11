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
								<label for="nama">Judul Artikel</label>
								<textarea name="judul" rows="3" class="form-control" readonly></textarea>
							</div>
							<div class="form-group" id="div-ubahstatus">
								
							</div>
							<div class="form-group" id="divAlasanTolak" style="display: none;">
								<label>Alasan Tolak</label>
								<textarea name="alasan_tolak" rows="3" class="form-control"></textarea>
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
