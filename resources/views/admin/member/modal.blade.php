<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.member.store') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">No Member</label>
                                <input type="text" class="form-control" name="no_member" id="no_member"
                                    placeholder="no_member">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nik</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="nama_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nama lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="nama_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">No Hp</label>
                                <input type="number" class="form-control" name="no_hp" id="no_hp"
                                    placeholder="no_hp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Alamat lengkap</label>
                                <input type="text" class="form-control" name="alamat_lengkap" id="alamat_lengkap"
                                    placeholder="alamat_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Tempat lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                    placeholder="tempat_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                    placeholder="tgl_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Ref</label>
                                <input type="text" class="form-control" name="ref" id="ref"
                                    placeholder="ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Bank Rek Ref</label>
                                <input type="text" class="form-control" name="bank_rek_ref" id="bank_rek_ref"
                                    placeholder="bank_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">No Rek Ref</label>
                                <input type="text" class="form-control" name="no_rek_ref" id="no_rek_ref"
                                    placeholder="no_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">An Rek Ref</label>
                                <input type="text" class="form-control" name="an_rek_ref" id="an_rek_ref"
                                    placeholder="an_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Foto Profil</label>
                                <input type="file" class="form-control" name="pp" id="pp"
                                    placeholder="pp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Faceboock</label>
                                <input type="text" class="form-control" name="fb" id="fb"
                                    placeholder="fb">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram"
                                    placeholder="instagram">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Expired Date</label>
                                <input type="date" class="form-control" name="expired_date" id="expired_date"
                                    placeholder="expired_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nip</label>
                                <input type="text" class="form-control" name="nip" id="nip"
                                    placeholder="nip">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="modalShowLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Data Member</h5>
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
                                <label for="char">No Member</label>
                                <input type="text" class="form-control" name="no_member" id="no_member"
                                    placeholder="no_member">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nik</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="nama_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nama lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="nama_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">No Hp</label>
                                <input type="number" class="form-control" name="no_hp" id="no_hp"
                                    placeholder="no_hp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Alamat lengkap</label>
                                <input type="text" class="form-control" name="alamat_lengkap" id="alamat_lengkap"
                                    placeholder="alamat_lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Tempat lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                    placeholder="tempat_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                    placeholder="tgl_lahir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Ref</label>
                                <input type="text" class="form-control" name="ref" id="ref"
                                    placeholder="ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Bank Rek Ref</label>
                                <input type="text" class="form-control" name="bank_rek_ref" id="bank_rek_ref"
                                    placeholder="bank_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">No Rek Ref</label>
                                <input type="text" class="form-control" name="no_rek_ref" id="no_rek_ref"
                                    placeholder="no_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">An Rek Ref</label>
                                <input type="text" class="form-control" name="an_rek_ref" id="an_rek_ref"
                                    placeholder="an_rek_ref">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Foto Profil</label>
                                <input type="file" class="form-control" name="pp" id="pp"
                                    placeholder="pp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Faceboock</label>
                                <input type="text" class="form-control" name="fb" id="fb"
                                    placeholder="fb">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram"
                                    placeholder="instagram">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Expired Date</label>
                                <input type="date" class="form-control" name="expired_date" id="expired_date"
                                    placeholder="expired_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="char">Nip</label>
                                <input type="text" class="form-control" name="nip" id="nip"
                                    placeholder="nip">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnUpdate">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
