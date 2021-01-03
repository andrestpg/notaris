
            <div class="pb-3">
                <h1><?= $title; ?></h1>
            </div>

            <div class="card mb-grid">
                <div class="card-header">
                    <div class="card-header-title">Form Tambah Data</div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group row">
                            <label for="nama" class="col-md-2 col-form-label form-label">Nama<span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama User">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hp" class="col-md-2 col-form-label form-label">Handphone</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="hp" name="hp" placeholder="Handphone">
                                <?= form_error('hp', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label form-label">Email</label>
                            <div class="col-md-5">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row">
                            <legend class="col-form-legend col-md-2 form-label">Akses<span class="text-danger">*</span></legend>
                            <div class="col-md-5">
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="akses" id="akses1" value="0" checked>
                                    Admin
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="akses" id="akses2" value="1">
                                    Superadmin
                                </label>
                                </div>
                            </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label form-label">Username<span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <input type="username" class="form-control" id="username" name="username" placeholder="Username">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password1" class="col-md-2 col-form-label form-label">password<span class="text-danger">*</span></label>
                            <div class="input-group col-md-5">
                                <input type="password" class="form-control pass-form" id="password1" name="password1" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text pass-view"><span data-feather="eye"></span></span>
                                </div>
                                <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password2" class="col-md-2 col-form-label form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                            <div class="input-group col-md-5">
                                <input type="password" class="form-control pass-form" id="password2" name="password2" placeholder="Konfirmasi Password">
                                <div class="input-group-append">
                                    <span class="input-group-text pass-view"><span data-feather="eye"></span></span>
                                </div>
                                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
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