<?php
session_start();
include "config.php";

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

// Validasi parameter ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID tidak valid.";
    exit;
}

$id_keranjang = intval($_GET['id']);
$id_user = $_SESSION['user_id'];

// Pastikan item yang akan dihapus memang milik user ini
$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE id_keranjang = $id_keranjang AND id_user = $id_user");

if (mysqli_num_rows($cek) > 0) {
    $delete = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = $id_keranjang");

    if ($delete) {
        $_SESSION['success'] = "Item berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus item.";
    }
} else {
    $_SESSION['error'] = "Item tidak ditemukan atau bukan milik Anda.";
}

header("Location: keranjang.php");
exit;
?>
