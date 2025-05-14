<?php
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Registrasi</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')";

    if (mysqli_query($conn, $query)) {
        // Tampilan sukses
        echo '
        <div class="alert alert-success text-center shadow-sm rounded-3">
            <h4 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Registrasi Berhasil!</h4>
            <p>Akun Anda telah berhasil didaftarkan.</p>
            <hr>
            <a href="login.php" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
            </a>
        </div>';
    } else {
        // Tampilan error
        echo '
        <div class="alert alert-danger text-center shadow-sm rounded-3">
            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Gagal Registrasi</h4>
            <p>' . mysqli_error($conn) . '</p>
            <hr>
            <a href="register.php" class="btn btn-danger">
                <i class="bi bi-arrow-left-circle"></i> Coba Lagi
            </a>
        </div>';
    }
}
?>

        </div>
    </div>
</div>

</body>
</html>
