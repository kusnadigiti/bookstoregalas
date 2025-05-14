<!-- FILE: detail_pesanan_user.php -->
<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$id_pesanan = (int)$_GET['id'];

$query_pesanan = mysqli_query($conn, "
    SELECT * FROM pesanan 
    WHERE id_pesanan = $id_pesanan 
    AND id_user = {$_SESSION['user_id']}
");
$pesanan = mysqli_fetch_assoc($query_pesanan);

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

$query_items = mysqli_query($conn, "
    SELECT detail_pesanan.*, produk.nama_produk, produk.gambar
    FROM detail_pesanan
    JOIN produk ON detail_pesanan.id_produk = produk.id_produk
    WHERE detail_pesanan.id_pesanan = $id_pesanan
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }

        .print-button-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-light">



<!-- Konten Utama -->
<div class="container py-5 print-area">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="card-title">Detail Pesanan #<?= $pesanan['id_pesanan'] ?></h3>
            <!-- Tombol Cetak -->
<div class="print-button-container no-print">
    <button class="btn btn-success" onclick="window.print()">🖨️ Cetak Laporan</button>
</div>
            <hr>
            <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($pesanan['created_at'])) ?></p>
            <p><strong>Status:</strong>
                <span class="badge bg-secondary">
                    <?php
                    $status = [
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai'
                    ];
                    echo $status[$pesanan['status']] ?? $pesanan['status'];
                    ?>
                </span>
            </p>
            <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>
            <p><strong>Alamat Pengiriman:</strong><br><?= nl2br(htmlspecialchars($pesanan['alamat'])) ?></p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Item Pesanan</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = mysqli_fetch_assoc($query_items)): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                                <td><img src="admin/uploads/<?= $item['gambar'] ?>" width="50" class="img-thumbnail"></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td><?= $item['jumlah'] ?></td>
                                <td>Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 no-print">
        <a href="index.php" class="btn btn-secondary">&laquo; Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>
