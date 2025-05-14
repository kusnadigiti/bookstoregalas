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
      min-width: 600px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 50px;
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
  <h6 class="text-center mb-4">DAFTAR PELANGGAN<br>Book Store Galas</h6>
  <form action="proses_register_user.php" method="POST">
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

      <div class="mb-3">
        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
          <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan nama lengkap" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="no_telepon" class="form-label">Nama Telpon</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-phone"></i></span>
          <input type="text" name="no_telepon" class="form-control" id="no_telepon" placeholder="Masukkan Nomor telepon" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-house-user"></i></span>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>
      </div>

      <div class="mb-3 form-check">
      <button type="submit" class="btn btn-primary w-100" >Daftar</button>
      </div>
    <center><p>Sudah punya akun? <a href="login_user.php"> <i class="fas fa-user"> Login</i></a></p>

    </form>
    
  </div>

  <!-- Bootstrap JS -->
  <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
