<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['id_pesanan'])) {
    header("Location: index.php");
    exit;
}

$id_pesanan = (int)$_GET['id_pesanan'];
$query = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan = $id_pesanan 
    AND id_user = {$_SESSION['user_id']}
");
$pesanan = mysqli_fetch_assoc($query);

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
.logo-icon {
            width: 75px; /* Ukuran proporsional dengan icon */
            height: 75px;
            object-fit: contain;
            vertical-align: middle;
    }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="alert alert-success text-center">
  <img src="./images/logobookstore.png" alt="Logo" class="logo-icon">
  <h4 class="alert-heading">🎉 Pesanan Berhasil Dibuat!</h4> 
                <p>Terima kasih, pesanan Anda telah kami terima.</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Detail Pesanan</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID Pesanan:</strong> <?= $pesanan['id_pesanan']; ?></li>
                        <li class="list-group-item"><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></li>
                        <li class="list-group-item"><strong>Status:</strong> <?= ucfirst(str_replace('_', ' ', $pesanan['status'])); ?></li>
                        <li class="list-group-item"><strong>Metode Pembayaran:</strong> <?= strtoupper($pesanan['metode_pembayaran']); ?></li>
                    </ul>

                    <?php if ($pesanan['metode_pembayaran'] == 'transfer_bank'): ?>
                        <div class="alert alert-info mt-4">
                            <h5 class="alert-heading">💳 Instruksi Pembayaran</h5>
                            <p>Silakan transfer ke:</p>
                            <p><strong>BANK ABC</strong><br>No. Rekening: <strong>1234567890</strong></p>
                            <p>Jumlah Transfer: <strong>Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></strong></p>
                            <p>Kode Referensi: <strong>ORDER-<?= $pesanan['id_pesanan']; ?></strong></p>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4 text-center">
                        <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
