<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

// Ambil data keranjang lengkap dengan ID keranjang
$query = mysqli_query($conn, "
    SELECT keranjang.id_keranjang, produk.nama_produk, produk.harga, keranjang.jumlah 
    FROM keranjang 
    JOIN produk ON keranjang.id_produk = produk.id_produk 
    WHERE keranjang.id_user = {$_SESSION['user_id']}
");

$total = 0;
$item_count = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .cart-item {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
        }
    </style>
    <script>
        function validateCheckout() {
            <?php if ($item_count == 0): ?>
                alert("Keranjang kosong! Tambahkan produk terlebih dahulu.");
                window.location.href = "index.php";
                return false;
            <?php else: ?>
                return true;
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">🛒 Keranjang Belanja</h2>

                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <div class="cart-item">
                        <h5><?= htmlspecialchars($row['nama_produk']) ?></h5>
                        <p class="mb-1">Harga: <strong>Rp <?= number_format($row['harga'], 0, ',', '.') ?></strong></p>
                        <p>Jumlah: <strong><?= $row['jumlah'] ?></strong></p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="hapus_keranjang.php?id=<?= $row['id_keranjang'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus item ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </div>
                        <?php $total += $row['harga'] * $row['jumlah']; ?>
                    </div>
                <?php endwhile; ?>

                <?php if ($item_count > 0): ?>
                    <h4 class="text-end mt-4">Total: <span class="text-success">Rp <?= number_format($total, 0, ',', '.') ?></span></h4>
                <?php endif; ?>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali Belanja
                    </a>
                    <a href="checkout.php" onclick="return validateCheckout()" class="btn btn-success">
                        <i class="bi bi-cart-check"></i> Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
