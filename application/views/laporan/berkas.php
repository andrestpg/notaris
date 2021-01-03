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
                        <th rowspan="2">No</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">No. Berkas</th>
                        <th rowspan="2">Nama Pemegang Hak dan Nomor Sertifikat</th>
                        <th rowspan="2">Nama Pembeli</th>
                        <th rowspan="2">Nama Pengorder</th>
                        <th rowspan="2">jenis Pekerjaan</th>
                        <th colspan="6">Kelengkapan Berkas</th>
                        <th rowspan="2">Petugas</th>
                        <th rowspan="2">Keterangan</th>
                    </tr>
                    <tr>
                        <th>CEK / PLOTING</th>
                        <th>PBB / LUNAS</th>
                        <th>BPHTB / VERIFIKASI</th>
                        <th>PPH / VALIDASI</th>
                        <th>Dokumen Pihak Pertama</th>
                        <th>Dokumen Pihak Kedua</th>
                    </tr>
                    <tr class="column-numb">
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
                    </tr>
                </thead>
                <tbody>
                <?php foreach($akta as $a): ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $a['no_berkas'] ?></td>
                        <td><?= date('d/m/Y',strtotime($a['tgl'])) ?></td>
                        <td><?= $a['nama_dan_no'] ?></td>
                        <td><?= $a['nama_klien'] ?></td>
                        <td><?= $a['nama_pengorder'] ?></td>
                        <td><?= $a['jenis'] ?></td>
                        <td><?= $a['ploting'] ?></td>
                        <td><?= $a['pbb'] ?></td>
                        <td><?= $a['bphtb'] ?></td>
                        <td><?= $a['pph'] ?></td>
                        <td><?= $a['dok_pertama'] ?></td>
                        <td><?= $a['dok_kedua'] ?></td>
                        <td><?= $a['nama_admin'] ?></td>
                        <td><?= $a['keterangan'] ?></td>
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