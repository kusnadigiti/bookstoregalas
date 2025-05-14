<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Form</title>
  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome untuk ikon -->
  <link href="../fontawesome/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap JS -->
  <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      min-width: 600px;
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
  </style>
</head>
<body>

  <div class="login-card">
  <h6 class="text-center mb-6">Daftar<br>Book Store Galas</h6>
<form action="proses_register.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" name="username" class="form-control" id="username" placeholder="Masukan username" required>
        </div>
      </div>
 
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi" required>
        </div>
      </div>

      <div class="mb-3 form-check">
      <button type="submit" class="btn btn-primary w-100" >Daftar</button>
      </div>
</form>
<p>Sudah punya akun? <a href="login.php"> <i class="fas fa-user"> Login</i></a></p>
  
</body>
</html>
