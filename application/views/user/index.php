
            <div class="pb-3">
                <h1><?= $title; ?></h1>
            </div>

            <div class="card">
                <div class="card-header" style="border-bottom: 0;">
                    <div class="row">
                        <div class="col">
                            <h4 class="d-inline">Data <?= $title; ?></h4>
                        </div>
                        <div class="col text-right">
                            <a href="#" class="btn btn-sm btn-primary btn-icon" id="reload">
                                <span class="oi oi-reload" aria-hidden="true"></span>
                            </a>
                            <?php if($admin['akses'] == 1): ?>
                            <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-primary btn-icon mr-2">
                                <span class="oi oi-plus" aria-hidden="true"></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="userContent">
                </div>

            </div>
        </div>
    </div>
</div>
</div>
