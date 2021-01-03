<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/laporan.css?v1.1') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/templates/demo/img/icon.ico') ?>" type="image/x-icon">
</head>

<body>
    <div class="container-fluid">
        <table class="table table-admin mb-5">
            <tr>
                <td width="6%">Lampiran</td>
                <td width="1%"> : </td>
                <td width="50%"><?= $title2 ?></td>
            </tr>
            <tr>
                <td>NAMA PPAT</td>
                <td> : </td>
                <td><?= $admin['nama'] ?></td>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td> : </td>
                <td><?= $admin['alamat'] ?></td>
            </tr>
            <tr>
                <td>DAERAH KERJA</td>
                <td> : </td>
                <td>Kabupaten Muaro Jambi</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th colspan="2">AKTA JUAL BELI</th>
                    <th rowspan="2">Bentuk Perbuatan Hukum</th>
                    <th colspan="3">Nama, Alamat dan NPWP</th>
                    <th rowspan="2">Jenis dan Nomor HAK</th>
                    <th rowspan="2">Letak Tanah dan Bangunan</th>
                    <th colspan="2">Luas M2</th>
                    <th rowspan="2">Harga Transaksi Perolehan Hak(Rp)</th>
                    <th colspan="2">SPPT PBB</th>
                    <th colspan="2">SSB</th>
                    <th colspan="2">SSP</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pengorder</th>
                    <th>Pihak yang mengalihkan</th>
                    <th>Pihak yang menerima</th>
                    <th>Tanah</th>
                    <th>Bangunan</th>
                    <th>NOP Tahun</th>
                    <th>NJOP</th>
                    <th>RP</th>
                    <th>Tangal</th>
                    <th>RP</th>
                    <th>Tangal</th>
                </tr>
                <tr class="column-number">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ppat as $p) : ?>
                    <?php

                    $dataPenerima = '';
                    $penerima = $this->Ppat_model->getPenerima($p['id']);
                    foreach ($penerima as $pn) {
                        $dataPenerima .= $pn['nama_klien'] . "<br>" . $pn['alamat_klien'] . "<br>";
                    };

                    $dataPemberi = '';
                    $pemberi = $this->Ppat_model->getPemberi($p['id']);
                    foreach ($pemberi as $pb) {
                        $dataPemberi .= $pb['nama_klien'] . "<br>" . $pn['alamat_klien'] . "<br>";
                    };
                    ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $p['no_akta'] ?></td>
                        <td><?= date('d/m/Y', strtotime($p['tgl_akta'])) ?></td>
                        <td><?= $p['hukum'] ?></td>
                        <td><?= $p['nama_pengorder'] ?></td>
                        <td><?= $dataPemberi ?></td>
                        <td><?= $dataPenerima ?></td>
                        <td><?= $p['jenis_hak'] ?></td>
                        <td><?= $p['letak'] ?></td>
                        <td><?= $p['luas_tanah'] ?></td>
                        <td><?= $p['luas_bangunan'] ?></td>
                        <td>Rp <?= number_format($p['harga']) ?>,-</td>
                        <td><?= $p['nop_tahun'] ?></td>
                        <td>Rp <?= number_format($p['njop']) ?>,-</td>
                        <td>Rp <?php if ($p['jml_ssb']) {
                                    echo number_format($p['jml_ssb']);
                                } ?>,-</td>
                        <td><?php if ($p['jml_ssp'] != '') {
                                echo date('d/m/Y', strtotime($p['tgl_ssb']));
                            } else {
                                echo 0;
                            } ?></td>
                        <td>Rp <?php if ($p['jml_ssp']) {
                                    echo number_format($p['jml_ssp']);
                                } ?>,-</td>
                        <td><?php if ($p['jml_ssb'] != '') {
                                echo date('d/m/Y', strtotime($p['tgl_ssp']));
                            } else {
                                echo 0;
                            } ?></td>
                    </tr>
                    <?php $n++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-end mt-5">
        <div class="col-3">
            <p>Muaro Jambi, <?= date('d-F-Y') ?></p>
            <p class="mb-5">Pejabat Pembuat Akta Tanah</p>
            <p class="mt-3"><?= $admin['nama'] ?></p>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>