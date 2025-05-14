<?php
session_start();
include "../config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// Proses saat form disubmit
if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $upload_dir = "uploads/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $gambar_path = $upload_dir . basename($gambar);

    if (move_uploaded_file($tmp_name, $gambar_path)) {
        $query = "INSERT INTO produk (nama_produk, kategori_produk, gambar, harga, deskripsi, stok) 
                  VALUES ('$nama_produk', '$kategori_produk', '$gambar', '$harga', '$deskripsi', '$stok')";

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success'>Produk berhasil ditambahkan!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Gagal upload gambar.</div>";
    }
}

// Pagination untuk Produk
$limit_produk = 5;
$page_produk = isset($_GET['page_produk']) ? (int)$_GET['page_produk'] : 1;
$start_produk = ($page_produk - 1) * $limit_produk;

$query_total_produk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk");
$total_produk = mysqli_fetch_assoc($query_total_produk)['total'];
$total_pages_produk = ceil($total_produk / $limit_produk);

$query_produk = "SELECT * FROM produk LIMIT $start_produk, $limit_produk";
$result_produk = mysqli_query($conn, $query_produk);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-muted">Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong></h3>
    <a href="../logout.php" class="btn btn-danger">X</a>
</div>
</div>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-3">Dashboard Admin Produk</h1>
        <!-- <h5>Selamat datang, <strong><?php echo $_SESSION['username'] ?></strong></h5> -->

        <?= $message ?>

        <div class="card mb-4">
            <div class="card-header">Tambah Produk</div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori Produk</label>
                        <select name="kategori_produk" class="form-select" required>
                            <option value="Sejarah">Sejarah</option>
                            <option value="MaPel">MaPel</option>
                            <option value="Novel">Novel</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Tambah Produk</button>
                </form>
            </div>
        </div>

<h3 class="mb-3">Data Produk</h3>
<div class="table-responsive mb-4">
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th width=11%>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $start_produk + 1;
            if (mysqli_num_rows($result_produk) > 0) :
                while ($row_produk = mysqli_fetch_assoc($result_produk)) :
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row_produk['nama_produk']; ?></td>
                        <td><?= $row_produk['kategori_produk']; ?></td>
                        <td><img src="uploads/<?= $row_produk['gambar']; ?>" width="50"></td>
                        <td>Rp <?= number_format($row_produk['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row_produk['deskripsi']; ?></td>
                        <td><?= $row_produk['stok']; ?></td>
                        <td>
                            <a href="edit_produk.php?id=<?= $row_produk['id_produk']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_produk.php?id=<?= $row_produk['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
            <?php
                endwhile;
            else :
                echo "<tr><td colspan='8' class='text-center'>Tidak ada data produk.</td></tr>";
            endif;
            ?>
        </tbody>
    </table>
</div>

<!-- PAGINATION PRODUK -->
<nav>
    <ul class="pagination justify-content-center">
        <?php if ($page_produk > 1): ?>
            <li class="page-item"><a class="page-link" href="?page_produk=<?= $page_produk - 1 ?>">Previous</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages_produk; $i++): ?>
            <li class="page-item <?= ($i == $page_produk) ? 'active' : '' ?>">
                <a class="page-link" href="?page_produk=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page_produk < $total_pages_produk): ?>
            <li class="page-item"><a class="page-link" href="?page_produk=<?= $page_produk + 1 ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>

        <h3 class="mb-3">Data User</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Dibuat Pada</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query_user = "SELECT * FROM user";
                $result_user = mysqli_query($conn, $query_user);

                if (mysqli_num_rows($result_user) > 0) :
                    while ($row_user = mysqli_fetch_assoc($result_user)) :
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row_user['username'] ?></td>
                            <td><?= $row_user['nama_lengkap'] ?></td>
                            <td><?= $row_user['no_telepon'] ?></td>
                            <td><?= $row_user['alamat'] ?></td>
                            <td><?= $row_user['created_at'] ?></td>
                        </tr>
                <?php endwhile;
                else :
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data user.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>

        <h3 class="mb-3">Data Pesanan</h3>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_pesanan = "SELECT pesanan.*, user.username 
                                  FROM pesanan 
                                  JOIN user ON pesanan.id_user = user.id_user
                                  ORDER BY pesanan.created_at DESC";
                $result_pesanan = mysqli_query($conn, $query_pesanan);

                if (mysqli_num_rows($result_pesanan) > 0) :
                    while ($row = mysqli_fetch_assoc($result_pesanan)) :
                ?>
                        <tr>
                            <td><?= $row['id_pesanan'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td>
                                <form action="update_status.php" method="POST">
                                    <input type="hidden" name="id_pesanan" value="<?= $row['id_pesanan'] ?>">
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="diproses" <?= $row['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                        <option value="dikirim" <?= $row['status'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                        <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                    </select>
                                </form>
                            </td>
                            <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                            <td><a href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>" class="btn btn-info btn-sm">Detail</a></td>
                        </tr>
                <?php
                    endwhile;
                else :
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada pesanan.</td></tr>";
                endif;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS CDN (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
