
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
                            <label for="nama" class="col-md-2 col-form-label form-label">Penghadap / Klien</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="klien" class="form-control js-choice" id="klienAkta" required>
                                            <?php foreach($klien as $k): ?>
                                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col px-0">
                                        <a href="#" data-toggle="modal" data-target="#addKlienModal"> <i data-feather="user-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_berkas" class="col-md-2 col-form-label form-label">No. Berkas</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="no_berkas" name="no_berkas">
                                <?= form_error('no_berkas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_akta" class="col-md-2 col-form-label form-label">Tanggal Akta</label>
                            <div class="col-md-5">
                                <input type="date" class="form-control mb-2" id="tgl_akta" name="tgl_akta" value="<?= date('Y-m-d') ?>">
                                <?= form_error('tgl_akta', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sifat_akta" class="col-md-2 col-form-label form-label">Sifat Akta</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="sifat_akta" name="sifat_akta">
                                <?= form_error('sifat_akta', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_akta" class="col-md-2 col-form-label form-label">No. Akta</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="no_akta" name="no_akta">
                                <?= form_error('no_akta', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-2 col-form-label form-label">Keterangan</label>
                            <div class="col-md-5">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
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
<div class="modal fade" id="addKlienModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Klien Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="namaKlien">Nama</label>
                  <input type="text"
                    class="form-control" name="namaKlien" id="namaKlien" placeholder="Nama Klien" required>
                </div>
                <div class="form-group">
                  <label for="hpKlien">Handphone</label>
                  <input type="text"
                    class="form-control" name="hpKlien" id="hpKlien" placeholder="Nama Klien" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveKlien">Simpan</button>
            </div>
        </div>
    </div>
</div>