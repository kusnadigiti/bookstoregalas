<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome untuk ikon -->
  <link href="./fontawesome/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right,rgb(107, 203, 17), #2575fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      max-width: 400px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 30px;
      background-color: white;
    }
    .input-group-text {
      background-color: #f7f7f7;
    }
    .form-control {
      border-radius: 30px;
    }
    .btn {
      border-radius: 30px;
    }
    .logo-icon {
            width: 50px; /* Ukuran proporsional dengan icon */
            height: 50px;
            object-fit: contain;
            vertical-align: middle;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="text-center">
    <img src="./images/logobookstore.png" alt="Logo" class="logo-icon">
    </div>

  <h6 class="text-center mb-4">LOGIN PELANGGAN<br>Book Store Galas</h6>
  <form action="proses_login_user.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" name="username" class="form-control" id="username" placeholder="Masukan username" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
        </div>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      <!-- <button type="submit" class="btn btn-primary w-100" >Login</button> -->
      <center><button type="submit" class="btn btn-primary w-80">
      <i class="fas fa-key"></i> Unlock
      </button>
    </form>
    <p class="mt-3 text-center">
      Belum punya akun? <a href="register_user.php">Daftar di sini</a>
    </p>
  </div>

  <!-- Bootstrap JS -->
  <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
