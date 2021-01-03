
            <div class="pb-3">
                <h1><?= $title; ?></h1>
            </div>

            <div class="card mb-grid"> 
                <div class="card-header">
                    <div class="card-header-title">Form Tambah Data</div>
                </div>
                <div class="card-body px-3">
                    <form action="" method="POST">
                        <div class="card mb-3 rounded">
                            <div class="card-header bg-dark rounded-top">
                                <div class="row">
                                    <div class="col-9">
                                        <h4 class="d-inline text-white">Pihak Terlibat</h4>
                                    </div>
                                    <div class="col-3 text-right">
                                        <a href="#" class="mr-2 text-white" data-toggle="modal" data-target="#addKlienModal"> <i data-feather="user-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-2 pb-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nama" class="col-md-3 col-form-label form-label">Pihak Pemberi</label>
                                            <div class="col-sm-9">
                                                <select name="pemberi[]" multiple class="form-control" id="first-option" required>
                                                    <?php foreach($klien as $k): ?>
                                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nama" class="col-md-3 col-form-label form-label">Pihak Penerima</label>
                                            <div class="col-sm-9">
                                                <select name="penerima[]" multiple class="form-control" id="second-option" required>
                                                    <?php foreach($klien as $k): ?>
                                                        <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pengorder" class="col-md-2 col-form-label form-label">Pengorder</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="pengorder" class="form-control js-choice" required>
                                            <?php foreach($pengorder as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col px-0">
                                        <a href="#" data-toggle="modal" data-target="#addPengorder" class="text-success"> <i data-feather="user-plus"></i></a>
                                    </div>
                                </div>
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
                            <label for="tgl_akta" class="col-md-2 col-form-label form-label">Tanggal Akta</label>
                            <div class="col-md-5">
                                <input type="date" class="form-control mb-2" id="tgl_akta" name="tgl_akta" value="<?= date('Y-m-d') ?>">
                                <?= form_error('tgl_akta', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hukum" class="col-md-2 col-form-label form-label">Hukum</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="hukum" name="hukum">
                                <?= form_error('hukum', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_hak" class="col-md-2 col-form-label form-label">Jenis Hak</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="jenis_hak" name="jenis_hak">
                                <?= form_error('jenis_hak', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="letak" class="col-md-2 col-form-label form-label">Letak</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="letak" name="letak">
                                <?= form_error('letak', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="luas_tanah" class="col-md-2 col-form-label form-label">Luas Tanah</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="luas_tanah" name="luas_tanah">
                                <?= form_error('luas_tanah', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="luas_bangunan" class="col-md-2 col-form-label form-label">Luas Bangunan</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="luas_bangunan" name="luas_bangunan">
                                <?= form_error('luas_bangunan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-md-2 col-form-label form-label">Harga</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="harga" name="harga">
                                <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3 rounded">
                                    <div class="card-header bg-dark rounded-top">
                                        <h4 class="d-inline text-white">SPPT PBB</h4>
                                    </div>
                                    <div class="card-body px-2 pb-2">
                                        <div class="form-group row">
                                            <label for="nop_tahun" class="col-md-5 col-form-label form-label">NOP Tahun</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="nop_tahun" name="nop_tahun">
                                                <?= form_error('nop_tahun', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="njop" class="col-md-5 col-form-label form-label">NJOP</label>
                                            <div class="col-md-7">
                                                <input type="number" class="form-control" id="njop" name="njop">
                                                <?= form_error('njop', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3 rounded">
                                    <div class="card-header bg-dark rounded-top">
                                        <h4 class="d-inline text-white">SSB</h4>
                                    </div>
                                    <div class="card-body px-2 pb-2">
                                        <div class="form-group row">
                                            <label for="jml_ssb" class="col-md-5 col-form-label form-label">Jumlah SSB</label>
                                            <div class="col-md-7">
                                                <input type="number" class="form-control" id="jml_ssb" name="jml_ssb">
                                                <?= form_error('jml_ssb', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_ssb" class="col-md-5 col-form-label form-label">Tanggal SSB</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-control" id="tgl_ssb" name="tgl_ssb" value="<?= date('Y-m-d') ?>">
                                                <?= form_error('tgl_ssb', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3 rounded">
                                    <div class="card-header bg-dark rounded-top">
                                        <h4 class="d-inline text-white">SSP</h4>
                                    </div>
                                    <div class="card-body px-2 pb-2">
                                        <div class="form-group row">
                                            <label for="jml_ssp" class="col-md-5 col-form-label form-label">Jumlah SSP</label>
                                            <div class="col-md-7">
                                                <input type="number" class="form-control" id="jml_ssp" name="jml_ssp">
                                                <?= form_error('jml_ssp', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_ssp" class="col-md-5 col-form-label form-label">Tanggal SSP</label>
                                            <div class="col-md-7">
                                                <input type="date" class="form-control" id="tgl_ssp" name="tgl_ssp" value="<?= date('Y-m-d') ?>">
                                                <?= form_error('tgl_ssp', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<div class="modal fade" id="addPengorder" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                    class="form-control" name="namaPengorder" id="namaPengorder" placeholder="Nama Klien" required>
                </div>
                <div class="form-group">
                  <label for="hpPengorder">Handphone</label>
                  <input type="text"
                    class="form-control" name="hpPengorder" id="hpPengorder" placeholder="Nama Klien" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="savePengorder">Simpan</button>
            </div>
        </div>
    </div>
</div>