<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Beasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="Views/css/style_register.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <div class="register-card">
    <h3>Daftar Akun Beasiswa</h3>

    <?php if (!empty($msg)): ?>
      <?php if ($msg == 'success'): ?>
        <script>
          Swal.fire({
            title: "Registrasi Berhasil!",
            text: "Akun Anda telah dibuat. Silakan login kembali.",
            icon: "success",
            timer: 4000,
            showConfirmButton: false
          }).then(() => {
            window.location.href = "index.php?page=login";
          });
        </script>
      <?php else: ?>
        <div class="alert alert-danger text-center"><?= $msg ?></div>
      <?php endif; ?>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 mt-2">Daftar Sekarang</button>
    </form>

    <p class="text-center mt-4 mb-0 register-link">
      Sudah punya akun? <a href="index.php?page=login">Login di sini</a>
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
