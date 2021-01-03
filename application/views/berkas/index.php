
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
                            <a href="#" class="btn btn-sm btn-success btn-icon" data-toggle="modal" data-target="#berkasModal">
                                <span class="oi oi-clipboard" aria-hidden="true"></span>
                            </a>
                            <a href="#" class="btn btn-sm btn-primary btn-icon" id="reload">
                                <span class="oi oi-reload" aria-hidden="true"></span>
                            </a>
                            <a href="<?= base_url('berkas/add') ?>" class="btn btn-sm btn-primary btn-icon">
                                <span class="oi oi-plus" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="berkasContent">
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="detailBerkasModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <div class="modal-body" id="detailBody">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="berkasModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="year">Tahun</label>
                  <select class="form-control" name="year" id="year">
                        <option value="">Pilih Tahun</option>
                      <?php foreach($date as $dt): ?>
                        <option value="<?= $dt['year']; ?>"><?= $dt['year'] ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="month">Month</label>
                  <select class="form-control" name="month" id="month">
                  </select>
                </div>
                <a class="btn btn-success btn-block" id="btnCetak" href="#">Cetak</a>
            </div>
        </div>
    </div>
</div>

