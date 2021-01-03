
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
                            <label for="nama" class="col-md-2 col-form-label form-label">Nama</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengorder">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hp" class="col-md-2 col-form-label form-label">Handphone</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="hp" name="hp" placeholder="Handphone Pengorder">
                                <?= form_error('hp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-form-label form-label">Alamat</label>
                            <div class="col-md-5">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
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