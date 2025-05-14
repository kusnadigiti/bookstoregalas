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
        <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Header -->
<header class="bg-primary text-white text-center py-5">
  <div class="container">
    <h1>Contact us</h1>
    <p class="lead">"Buku Adalah Jendela, Kami Kuncinya."</p>
  </div>
</header>

<!-- Konten Tentang Kami -->
<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h2>Contact Us</h2>
        <p class="text-muted">We'd love to hear from you!</p>
    </div>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name *</label>
                    <input type="text" class="form-control" id="name" placeholder="Kusnadi" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email" class="form-control" id="email" placeholder="example@email.com" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message *</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
            <h5>Store Address</h5>
            <p>Jl. Buku No.123, Jakarta, Indonesia</p>

            <h5>Email</h5>
            <p>info@bookstore.com</p>

            <h5>Phone</h5>
            <p>+62 812 3456 7890</p>

            <h5>Working Hours</h5>
            <p>Monday - Friday: 9AM - 6PM</p>
            <p>Saturday - Sunday: 10AM - 4PM</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
  <div class="container">
    <small>© <?= date("Y") ?> | BOOK STORE | Kusnadi | All rights reserved.</small>
  </div>
</footer>

<script src
