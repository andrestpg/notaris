
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
                            <a href="<?= base_url('klien/add') ?>" class="btn btn-sm btn-primary btn-icon">
                                <span class="oi oi-plus" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="klienContent">
                </div>

            </div>
        </div>
    </div>
</div>
</div>
