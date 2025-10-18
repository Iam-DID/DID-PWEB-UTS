<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Beasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="Views/css/style_login.css" rel="stylesheet">
</head>
<body>

  <div class="login-card">
    <h3>Selamat Datang!</h3>

    <?php if (isset($_SESSION['user'])): ?>
      <div class="alert alert-success text-center bg-success text-white border-0">
        Halo, <strong><?= $_SESSION['user']['username'] ?></strong>! Anda sudah login.
      </div>
      <div class="text-center mt-3">
        <a href="index.php?page=logout" class="btn btn-danger w-100">Logout</a>
      </div>

    <?php else: ?>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center bg-danger text-white border-0"><?= $error ?></div>
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

        <button type="submit" class="btn btn-primary w-100 mt-2">Masuk</button>
      </form>

      <p class="text-center mt-4 mb-0 register-link">
        Belum punya akun? <a href="index.php?page=register">Daftar di sini</a>
      </p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
