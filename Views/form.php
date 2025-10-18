<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
  header("Location: index.php?page=login");
  exit;
}

// Data dari controller (jika ada)
$data = $dataUser ?? [];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pendaftaran Beasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Views/css/style_form.css">
</head>

<body>
<div class="container my-4 my-md-5">

  <div class="header-section d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Form Pendaftaran Beasiswa</h3>
    <div>
      <span class="me-3 text-secondary">
        <?= htmlspecialchars($_SESSION['user']['username'] ?? 'User') ?>
      </span>
      <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
  </div>

    <div class="card p-4 p-md-5">
      <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= $message ?></div>
      <?php endif; ?>

      <form method="POST" action="index.php?page=form" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama"
              value="<?= htmlspecialchars($data['nama'] ?? '') ?>"
              placeholder="Masukkan nama Anda">
          </div>

          <div class="col-md-6 mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="number" class="form-control" id="nim" name="nim"
              value="<?= htmlspecialchars($data['nim'] ?? '') ?>"
              placeholder="Masukkan NIM">
          </div>

          <div class="col-md-6 mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <select class="form-select" id="prodi" name="prodi">
              <option disabled <?= empty($data['prodi']) ? 'selected' : '' ?>>-- Pilih Prodi --</option>
              <option value="Sistem Informasi" <?= ($data['prodi'] ?? '') == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
              <option value="Teknologi Informasi" <?= ($data['prodi'] ?? '') == 'Teknologi Informasi' ? 'selected' : '' ?>>Teknologi Informasi</option>
              <option value="Informatika" <?= ($data['prodi'] ?? '') == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label d-block">Jenis Kelamin</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="jeniskelamin" id="radio1" value="Laki-laki"
                <?= ($data['jeniskelamin'] ?? '') == 'Laki-laki' ? 'checked' : '' ?>>
              <label class="form-check-label" for="radio1">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="jeniskelamin" id="radio2" value="Perempuan"
                <?= ($data['jeniskelamin'] ?? '') == 'Perempuan' ? 'checked' : '' ?>>
              <label class="form-check-label" for="radio2">Perempuan</label>
            </div>
          </div>

          <?php
          $kegiatanList = explode(', ', $data['kegiatan'] ?? '');
          ?>
          <div class="col-12 mb-3">
            <label class="form-label d-block">Kegiatan Kemahasiswaan</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="kegiatan1" name="kegiatan[]" value="Ormawa"
                <?= in_array('Ormawa', $kegiatanList) ? 'checked' : '' ?>>
              <label class="form-check-label" for="kegiatan1">Ormawa</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="kegiatan2" name="kegiatan[]" value="UKM"
                <?= in_array('UKM', $kegiatanList) ? 'checked' : '' ?>>
              <label class="form-check-label" for="kegiatan2">UKM</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="kegiatan3" name="kegiatan[]" value="Organisasi Eksternal"
                <?= in_array('Organisasi Eksternal', $kegiatanList) ? 'checked' : '' ?>>
              <label class="form-check-label" for="kegiatan3">Organisasi Eksternal</label>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="inputFile" class="form-label">Pas Foto 3x4</label>
            <input class="form-control" type="file" id="inputFile" name="inputFile">
            <?php if (!empty($data['foto'])): ?>
              <div class="mt-2">
                <img src="<?= $data['foto'] ?>" alt="Foto" style="max-width:100px;border-radius:4px;">
              </div>
            <?php endif; ?>
          </div>
        </div>

        <hr class="my-4">

        <h3 class="mb-4">Asal Daerah</h3>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <select id="provinsi" name="provinsi" class="form-select" required>
              <?php if (!empty($data['provinsi'])): ?>
                <option selected><?= htmlspecialchars($data['provinsi']) ?></option>
              <?php else: ?>
                <option value="">Memuat provinsi...</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="kabupaten" class="form-label">Kabupaten / Kota</label>
            <select id="kabupaten" name="kabupaten" class="form-select" required>
              <?php if (!empty($data['kabupaten'])): ?>
                <option selected><?= htmlspecialchars($data['kabupaten']) ?></option>
              <?php else: ?>
                <option value="">Pilih provinsi terlebih dahulu</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="form-select" required>
              <?php if (!empty($data['kecamatan'])): ?>
                <option selected><?= htmlspecialchars($data['kecamatan']) ?></option>
              <?php else: ?>
                <option value="">Pilih kabupaten/kota terlebih dahulu</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="kelurahan" class="form-label">Kelurahan / Desa</label>
            <select id="kelurahan" name="kelurahan" class="form-select" required>
              <?php if (!empty($data['kelurahan'])): ?>
                <option selected><?= htmlspecialchars($data['kelurahan']) ?></option>
              <?php else: ?>
                <option value="">Pilih kecamatan terlebih dahulu</option>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-12 mb-3">
            <label for="inputTextarea" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control" id="inputTextarea" name="inputTextarea" rows="3"
              placeholder="Contoh: Jl. Melati No. 5 RT 03/RW 02, Kelurahan ...."><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
          </div>
        </div>

        <hr class="my-4">

        <h3 class="mb-3">Tanda Tangan</h3>
        <div class="mb-4 d-flex flex-column flex-md-row align-items-start">
          <canvas id="signaturePad" class="border border-secondary rounded bg-white mb-2 mb-md-0"></canvas>
          <button type="button" class="btn btn-sm btn-danger ms-md-2" id="clearSignature">Hapus</button>
          <input type="hidden" name="signature" id="signatureData"
            value="<?= htmlspecialchars($data['tanda_tangan'] ?? '') ?>">
        </div>

        <?php if (!empty($data['tanda_tangan'])): ?>
          <div class="mt-2">
            <img src="<?= $data['tanda_tangan'] ?>" alt="TTD" style="max-width:150px;">
          </div>
        <?php endif; ?>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">
            <?= !empty($data) ? 'Perbarui Data' : 'Kirim Pendaftaran' ?>
          </button>
        </div>
      </form>

      <?php if (!empty($data)): ?>
      <?php endif; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="Views/js/DataWilayah.js"></script>
  <script src="Views/js/CanvasTTD.js"></script>
</body>
</html>
