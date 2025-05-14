<?php
include "../config.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id_produk = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Edit Produk</h4>
            </div>
            <div class="card-body">
                <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_produk" value="<?= $data['id_produk']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="<?= $data['nama_produk']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_produk" class="form-select" required>
                            <option value="Elektronik" <?= ($data['kategori_produk'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                            <option value="Pakaian" <?= ($data['kategori_produk'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                            <option value="Makanan" <?= ($data['kategori_produk'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                            <option value="Aksesoris" <?= ($data['kategori_produk'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="uploads/<?= $data['gambar']; ?>" alt="Gambar Produk" width="150" class="img-thumbnail">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Baru (Opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
