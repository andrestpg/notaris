
            <div class="pb-3">
                <h1><?= $title; ?></h1>
            </div>

            <div class="card mb-grid">
                <div class="card-header">
                    <div class="card-header-title">Form Tambah Data</div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label form-label">Pengorder</label>
                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="pengorder" class="form-control js-choice"required>
                                            <?php foreach($pengorder as $k): ?>
                                                <?php if($k['id'] == $rekap['pengorder']): ?>
                                                <option value="<?= $k['id'] ?>" selected><?= $k['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col px-0">
                                        <a href="#" data-toggle="modal" data-target="#addPengorderModal" class="text-success"> <i data-feather="user-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_masuk" class="col-sm-2 col-form-label form-label">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control mb-2" id="tgl_masuk" name="tgl_masuk" value="<?= date('Y-m-d', strtotime($rekap['tgl_masuk'])) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_keluar" class="col-sm-2 col-form-label form-label">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control mb-2" id="tgl_keluar" name="tgl_keluar" value="<?= date('Y-m-d', strtotime($rekap['tgl_keluar'])) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_urut" class="col-sm-2 col-form-label form-label">No. Urut Sertifikat</label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="no_urut" name="no_urut" value="<?= $rekap['no_urut'] ?>">
                                <?= form_error('no_urut', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="data_sertifikat" class="col-sm-2 col-form-label form-label">Data Serifikat</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="data_sertifikat" name="data_sertifikat" value="<?= $rekap['data_sertifikat'] ?>">
                                <?= form_error('data_sertifikat', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label form-label">Status</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="status" name="status" value="<?= $rekap['status'] ?>">
                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label form-label">Keterangan</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $rekap['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nb" class="col-sm-2 col-form-label form-label">NB</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="nb" name="nb" rows="3"><?= $rekap['nb'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="addPengorderModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengorder Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="namaPengorder">Nama</label>
                  <input type="text"
                    class="form-control" name="namaPengorder" id="namaPengorder" placeholder="Nama Pengorder" required>
                </div>
                <div class="form-group">
                  <label for="hpPengorder">Handphone</label>
                  <input type="text"
                    class="form-control" name="hpPengorder" id="hpPengorder" placeholder="08XXXXX" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="savePengorder">Simpan</button>
            </div>
        </div>
    </div>
</div>