<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pendaftar</title>
  <link rel="stylesheet" href="Views/css/style_result.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

  <div class="container">
    <div class="header text-center mb-4">
      <h1>Selamat Datang Admin!</h1>
    </div>

    <div class="row justify-content-center mb-4">
      <div class="col-md-4">
        <div class="card-summary text-center">
          <h4><?= $totalData ?></h4>
          <p>Total Pendaftar</p>
        </div>
      </div>
    </div>

    <div class="table-container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary mb-0">Data Pendaftar</h4>
        <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Logout</a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Prodi</th>
              <th>Jenis Kelamin</th>
              <th>Kegiatan</th>
              <th>Alamat Lengkap</th>
              <th>Foto</th>
              <th>Tanda Tangan</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data)): ?>
              <?php $no = 1; ?>
              <?php foreach ($data as $row): ?>
                <?php
                  $alamatLengkap = trim(
                    htmlspecialchars($row["alamat"]) . ", " .
                    htmlspecialchars($row["kelurahan"]) . ", " .
                    htmlspecialchars($row["kecamatan"]) . ", " .
                    htmlspecialchars($row["kabupaten"]) . ", " .
                    htmlspecialchars($row["provinsi"])
                  );
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row["nama"]) ?></td>
                  <td><?= htmlspecialchars($row["nim"]) ?></td>
                  <td><?= htmlspecialchars($row["prodi"]) ?></td>
                  <td><?= htmlspecialchars($row["jeniskelamin"]) ?></td>
                  <td><?= htmlspecialchars($row["kegiatan"]) ?></td>
                  <td class="text-start"><?= $alamatLengkap ?></td>
                  <td>
                    <?php if ($row["foto"]): ?>
                      <img src="<?= htmlspecialchars($row["foto"]) ?>" class="photo-thumb" alt="foto">
                    <?php else: ?>
                      <em>-</em>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($row["tanda_tangan"]): ?>
                      <img src="<?= htmlspecialchars($row["tanda_tangan"]) ?>" class="signature-thumb" alt="ttd">
                    <?php else: ?>
                      <em>-</em>
                    <?php endif; ?>
                  </td>
                  <td><?= $row["created_at"] ?? "-" ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="10"><em>Belum ada data tersimpan.</em></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
