
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
                            <label for="nama" class="col-md-2 col-form-label form-label">Pembeli</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="pembeli" class="form-control js-choice" id="klienBerkas" required>
                                            <?php foreach($klien as $k): ?>
                                                <?php if( $berkas['pembeli'] == $k['id'] ): ?>
                                                <option value="<?= $k['id'] ?>" selected><?= $k['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                                <?php endif; ?>
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
                            <label for="nama" class="col-md-2 col-form-label form-label">Pengorder</label>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-10">
                                        <select name="pengorder" class="form-control js-choice" id="pengorderBerkas" required>
                                            <?php foreach($pengorder as $k): ?>
                                                <?php if( $berkas['pengorder'] == $k['id'] ): ?>
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
                            <label for="nama_dan_no" class="col-md-2 col-form-label form-label">Nama Pemegang Hak & No. Sertifikat</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nama_dan_no" name="nama_dan_no" value="<?= $berkas['nama_dan_no'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_berkas" class="col-md-2 col-form-label form-label">No. Berkas</label>
                            <div class="col-md-5">
                                <input type="number" class="form-control" id="no_berkas" name="no_berkas" value="<?= $berkas['no_berkas'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl" class="col-md-2 col-form-label form-label">Tanggal</label>
                            <div class="col-md-5">
                                <input type="date" class="form-control mb-2" id="tgl" name="tgl" value="<?= date('Y-m-d', strtotime($berkas['tgl'])) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-md-2 col-form-label form-label">Jenis Pekerjaan</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $berkas['jenis'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ploting" class="col-md-2 col-form-label form-label">CEK / PLOTING</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="ploting" name="ploting" value="<?= $berkas['ploting'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pbb" class="col-md-2 col-form-label form-label">PBB / LUNAS</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="pbb" name="pbb" value="<?= $berkas['pbb'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bphtb" class="col-md-2 col-form-label form-label">BPHTB / VERIFIKASI</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="bphtb" name="bphtb" value="<?= $berkas['bphtb'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pph" class="col-md-2 col-form-label form-label">PPH / VALIDASI</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="pph" name="pph" value="<?= $berkas['pph'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dok_pertama" class="col-md-2 col-form-label form-label">Dokumen Pihak Pertama</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="dok_pertama" name="dok_pertama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dok_kedua" class="col-md-2 col-form-label form-label">Dokumen Pihak Kedua</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="dok_kedua" name="dok_kedua">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-md-2 col-form-label form-label">Keterangan</label>
                            <div class="col-md-5">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= $berkas['keterangan'] ?></textarea>
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