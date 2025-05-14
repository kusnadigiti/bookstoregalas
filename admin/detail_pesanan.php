<?php
session_start();
include "../config.php";

$id_pesanan = (int)$_GET['id'];

$query_pesanan = mysqli_query($conn, "
    SELECT pesanan.*, user.username 
    FROM pesanan 
    JOIN user ON pesanan.id_user = user.id_user
    WHERE pesanan.id_pesanan = $id_pesanan
");
$pesanan = mysqli_fetch_assoc($query_pesanan);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-pending {
            color: #e67e22;
            font-weight: bold;
        }
        .status-verified {
            color: #2ecc71;
            font-weight: bold;
        }
        .bukti-transfer {
            max-width: 100%;
            height: auto;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                top: 0;
                left: 0;
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

<!-- Tombol Cetak -->
<div class="print-button-container no-print">
    <button class="btn btn-danger" onclick="window.print()">🖨️ Cetak </button>
</div>

<!-- Konten -->
<div class="container my-5 print-area">
    <h1 class="mb-4">Detail Pesanan #<?= $id_pesanan ?></h1>

    <!-- Informasi Utama Pesanan -->
    <div class="card mb-4">
        <div class="card-header">Informasi Pesanan</div>
        <div class="card-body">
            <p><strong>Pelanggan:</strong> <?= $pesanan['username'] ?></p>
            <p><strong>Tanggal Pesan:</strong> <?= date('d/m/Y H:i', strtotime($pesanan['created_at'])) ?></p>
            <p><strong>Status:</strong> 
                <span class="<?= ($pesanan['status'] == 'menunggu_verifikasi') ? 'status-pending' : 'status-verified' ?>">
                    <?= ucfirst(str_replace('_', ' ', $pesanan['status'])) ?>
                </span>
            </p>
            <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>
            <p><strong>Alamat Pengiriman:</strong><br><?= nl2br(htmlspecialchars($pesanan['alamat'])) ?></p>
        </div>
    </div>

    <!-- Bukti Transfer -->
    <div class="card mb-4">
        <div class="card-header">Bukti Transfer</div>
        <div class="card-body">
            <?php if ($pesanan['bukti_transfer']): ?>
                <img src="../bukti_transfer/<?= $pesanan['bukti_transfer'] ?>" alt="Bukti Transfer" class="bukti-transfer mb-3">
                <div class="no-print">
                    <a href="../bukti_transfer/<?= $pesanan['bukti_transfer'] ?>" class="btn btn-primary btn-sm" download>Download Bukti</a>
                </div>
            <?php else: ?>
                <p class="text-danger">Belum mengupload bukti transfer.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Daftar Item Pesanan -->
    <div class="card mb-4">
        <div class="card-header">Item Pesanan</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered m-0">
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
                                <td><img src="uploads/<?= $item['gambar'] ?>" width="50"></td>
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

    <div class="no-print">
        <a href="index.php" class="btn btn-secondary">&laquo; Kembali ke Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
