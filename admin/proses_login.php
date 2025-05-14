<?php 
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proses Login</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        // Login sukses
        $_SESSION['admin_id'] = $admin['id_admin'];
        $_SESSION['username'] = $admin['username'];
        header("Location: index.php");
        exit;
    } else {
        // Login gagal – tampilkan pesan Bootstrap
        echo '
        <div class="alert alert-danger text-center shadow-sm rounded-3">
            <h4 class="alert-heading"><i class="bi bi-x-circle-fill"></i> Login Gagal</h4>
            <p>Username atau password salah.</p>
            <hr>
            <a href="login.php" class="btn btn-danger">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Login
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
