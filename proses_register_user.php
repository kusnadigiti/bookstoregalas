<?php
include "config.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $message = " <center> <div class='alert alert-danger'>Username sudah digunakan! <a href='login_user.php'>Login di sini</a>.</div>";
    } else {
        $query = "INSERT INTO user (username, password, nama_lengkap, no_telepon, alamat) 
                  VALUES ('$username', '$password', '$nama_lengkap', '$no_telepon', '$alamat')";
        if (mysqli_query($conn, $query)) {
            $message = "<center> <div class='alert alert-success'>Registrasi berhasil! <a href='login_user.php'>Login di sini</a>.</div>";
        } else {
            $message = "<center> <div class='alert alert-danger'>Registrasi gagal! <a href='login_user.php'>Login di sini</a>.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-register {
            max-width: 500px;
            margin: 80px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-register">
        <h3 class="mb-4 text-center">Proses Registrasi</h3>

        <?php if ($message) echo $message; ?>

       
    </div>
</div>

<!-- Bootstrap JS (for alerts and form interactions) -->
<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
