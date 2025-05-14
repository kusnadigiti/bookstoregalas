<?php
session_start();
include "config.php";

// untuk nampilin produk
$query = "SELECT * FROM produk";

// untuk search produk
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if (!empty($keyword)) {
    $query .= " WHERE nama_produk LIKE '%$keyword%' OR kategori_produk LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $query);

// Ambil riwayat pesanan jika user sudah login
$riwayat_pesanan = [];
if (isset($_SESSION['user_id'])) {
    $query_pesanan = mysqli_query($conn, "
        SELECT * FROM pesanan 
        WHERE id_user = {$_SESSION['user_id']}
        ORDER BY created_at DESC
    ");
    while ($row = mysqli_fetch_assoc($query_pesanan)) {
        $riwayat_pesanan[] = $row;
    }
}


//pagination
$limit = 8; // jumlah produk per halaman
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$keyword_escaped = mysqli_real_escape_string($conn, $keyword);

// Query data produk sesuai keyword dan pagination
$query = "SELECT * FROM produk ";
if (!empty($keyword_escaped)) {
    $query .= "WHERE nama_produk LIKE '%$keyword_escaped%' OR kategori_produk LIKE '%$keyword_escaped%' ";
}
$query .= "LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);

// Hitung total data untuk pagination
$count_query = "SELECT COUNT(*) AS total FROM produk ";
if (!empty($keyword_escaped)) {
    $count_query .= "WHERE nama_produk LIKE '%$keyword_escaped%' OR kategori_produk LIKE '%$keyword_escaped%'";
}
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_products = $count_row['total'];
$total_pages = ceil($total_products / $limit);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore Galas </title>
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./images/logobookstore.png" type="image/png">
    <style>
        .produk-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .produk-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .riwayat-pesanan {
            margin-top: 40px;
        }

        .status-pending { color: #f39c12; }
        .status-diproses { color: #3498db; }
        .status-dikirim { color: #2ecc71; }
        .status-selesai { color: #27ae60; }

        .logo-icon {
            width: 50px; /* Ukuran proporsional dengan icon */
            height: 50px;
            object-fit: contain;
            vertical-align: middle;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <img src="./images/logobookstore.png" alt="Logo" class="logo-icon">    
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Produk</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a href="#" class="btn btn-outline-primary me-2">Registered</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="register_user.php" class="nav-link">Registration</a></li>
                
                <?php endif; ?>

            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="me-2">Welcome, <?= htmlspecialchars($_SESSION['user']); ?></span>
                    <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>
                    <a href="keranjang.php" class="btn btn-outline-success">Keranjang</a>
                <?php else: ?>
                    <a href="login_user.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="login_user.php" class="btn btn-outline-info">Keranjang</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Daftar Produk</h2>
        <form method="GET" action="" class="d-flex mb-3">
            <input type="text" class="form-control me-2" name="keyword" placeholder="Cari produk atau kategori..." value="<?= htmlspecialchars($keyword); ?>">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>

        <div class="produk-wrapper">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="produk-card">
                        <img src="admin/uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>" class="img-fluid mb-2">
                        <h5><?= htmlspecialchars($row['nama_produk']); ?></h5>
                        <p>Kategori: <?= htmlspecialchars($row['kategori_produk']); ?></p>
                        <p>Harga: Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <p>Stok: <?= $row['stok']; ?></p>
                        <button class="btn btn-sm btn-success" onclick="addToCart(<?= $row['id_produk']; ?>)">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-muted">Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>
<?php if ($total_pages > 1): ?>
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center mt-4">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?keyword=<?= urlencode($keyword); ?>&page=<?= $i; ?>">
                        <?= $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>



        <!-- Riwayat Pemesanan -->
        <?php if (!empty($riwayat_pesanan)): ?>
            <div class="riwayat-pesanan">
                <h3 class="mt-5">Riwayat Pemesanan Anda</h3>
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($riwayat_pesanan as $pesanan): ?>
                            <tr>
                                <td><?= $pesanan['id_pesanan']; ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($pesanan['created_at'])); ?></td>
                                <td>Rp <?= number_format($pesanan['total'], 0, ',', '.'); ?></td>
                                <td class="status-<?= str_replace('_', '-', $pesanan['status']); ?>">
                                    <?php
                                        $status = [
                                            'pending' => 'Pending',
                                            'diproses' => 'Diproses',
                                            'dikirim' => 'Dikirim',
                                            'selesai' => 'Selesai'
                                        ];
                                        echo $status[$pesanan['status']] ?? $pesanan['status'];
                                    ?>
                                </td>
                                <td>
                                    <a href="detail_pesanan_user.php?id=<?= $pesanan['id_pesanan']; ?>" class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function addToCart(productId) {
            <?php if (!isset($_SESSION['user_id'])): ?>
                alert("Silakan login terlebih dahulu!");
                window.location.href = "login_user.php";
            <?php else: ?>
                fetch("add_to_cart.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "id_produk=" + productId
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.status === "success") {
                            window.location.reload();
                        }
                    });
            <?php endif; ?>
        }
    </script>
</body>
</html>
