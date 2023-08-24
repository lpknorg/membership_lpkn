<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg exampleModal" role="document" >
  </div>
</div>
<div class="modal fade" id="update_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <form action="{{route('member_profile.update_fotoprofile')}}" method="post" id="form_update_profile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ganti foto profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" class="form-control" name="foto_profile">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btnUpdatePP">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
