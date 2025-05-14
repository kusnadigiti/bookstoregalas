<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tentang Kami - MyWebsite</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .logo-icon {
            width: 50px; /* Ukuran proporsional dengan icon */
            height: 50px;
            object-fit: contain;
            vertical-align: middle;
    }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <img src="./images/logobookstore.png" alt="Logo" class="logo-icon">    

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Header -->
<header class="bg-primary text-white text-center py-5">
  <div class="container">
    <h1>About us</h1>
    <p class="lead">"Buku Adalah Jendela, Kami Kuncinya."</p>
  </div>
</header>

<!-- Konten Tentang Kami -->
<section class="py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-6">
        <h3>Visi Kami</h3>
        <p>Menjadi toko buku terdepan yang menginspirasi dan mencerdaskan masyarakat melalui penyediaan buku berkualitas, pelayanan terbaik, dan pengalaman membaca yang menyenangkan.</p>
      </div>
      <div class="col-md-6">
        <h3>Misi Kami</h3>
        <ul>
          <li>Menyediakan berbagai jenis buku yang berkualitas, terbaru, dan relevan untuk semua kalangan.</li>
          <li>Memberikan layanan pelanggan yang ramah, cepat, dan profesional.</li>
          <li>Mendorong minat baca masyarakat melalui promosi, diskon, dan program literasi.</li>
        </ul>
      </div>
    </div>

    <div class="text-center">
      <h3 class="mb-4">Tim Kami</h3>
      <div class="row">
        <div class="col-md-4 mb-4">
          <img src="./images/avatar_1.png" class="rounded-circle mb-2" alt="CEO">
          <h5>Andi Pratama</h5>
          <p>CEO & Founder</p>
        </div>
        <div class="col-md-4 mb-4">
          <img src="./images/avatar_2.png" class="rounded-circle mb-2" alt="CTO">
          <h5>Kusnadi</h5>
          <p>CTO</p>
        </div>
        <div class="col-md-4 mb-4">
          <img src="./images/avatar_3.png" class="rounded-circle mb-2" alt="Marketing">
          <h5>Kusnadi</h5>
          <p>Marketing Lead</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    <small>© <?= date("Y") ?> | BOOK STORE | Kusnadi | All rights reserved.</small>
  </div>
</footer>

<script src
