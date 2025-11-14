<?php
// File: index.php
// Entry point utama: menampilkan home jika belum login, atau dashboard jika sudah login
session_start(); // Tambahkan di sini untuk memulai session sekali saja
include 'functions.php';

// Routing berdasarkan parameter GET
$page = $_GET['page'] ?? 'home';
$allowedPages = ['home', 'login', 'register', 'hotel', 'about', 'contact', 'profile'];

if (!in_array($page, $allowedPages)) {
    $page = 'home';
}

// Jika page adalah 'home' atau default, handle di sini; jika lain, include file terpisah
if ($page == 'home') {
    // Logika untuk home/dashboard
    $isLoggedIn = isLoggedIn();
    $user = $isLoggedIn ? getCurrentUser() : null;
} else {
    // Include halaman lain
    include $page . '.php';
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hotel Reservation App</title>
<script src="/_sdk/element_sdk.js"></script>
<script src="/_sdk/data_sdk.js"></script>
<script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>
<style>
    /* Styling umum dari common.css */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #FDFDFD;
      color: #6D5D4C;
      min-height: 100%;
      overflow-x: hidden;
    }

    html {
      height: 100%;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Header */
    header {
      background-color: #FDFDFD;
      padding: 24px 0;
      border-bottom: 2px solid #F3E9E2;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      background-color: #D4B896;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }

    .logo-text h1 {
      font-size: 24px;
      color: #6D5D4C;
      font-weight: 600;
    }

    .logo-text p {
      font-size: 12px;
      color: #6D5D4C;
      opacity: 0.8;
    }

    nav {
      display: flex;
      gap: 32px;
      align-items: center;
    }

    nav a {
      color: #6D5D4C;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
      cursor: pointer;
    }

    nav a:hover {
      color: #D4B896;
    }

    .auth-buttons {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .btn-login, .btn-register {
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
      font-size: 14px;
    }

    .btn-login {
      background: transparent;
      color: #6D5D4C;
      border: 2px solid #D4B896;
    }

    .btn-login:hover {
      background-color: #D4B896;
      color: #FDFDFD;
    }

    .btn-register {
      background-color: #D4B896;
      color: #FDFDFD;
    }

    .btn-register:hover {
      background-color: #c4a886;
    }

    .user-menu {
      position: relative;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background-color: #D4B896;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #FDFDFD;
      font-weight: 600;
      cursor: pointer;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #FDFDFD;
      border: 2px solid #F3E9E2;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(109, 93, 76, 0.1);
      min-width: 180px;
      z-index: 1000;
      display: none;
    }

    .dropdown-menu.show {
      display: block;
    }

    .dropdown-item {
      padding: 12px 16px;
      color: #6D5D4C;
      text-decoration: none;
      display: block;
      transition: background-color 0.3s;
      cursor: pointer;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
    }

    .dropdown-item:hover {
      background-color: #F3E9E2;
    }

    /* Page Sections */
    .page-section {
      display: none;
    }

    .page-section.active {
      display: block;
    }

    /* Footer */
    footer {
      background-color: #F3E9E2;
      padding: 40px 0;
      margin-top: 60px;
      text-align: center;
    }

    footer p {
      color: #6D5D4C;
      font-size: 14px;
    }

    /* Responsive umum */
    @media (max-width: 768px) {
      nav {
        gap: 16px;
      }
    }

    /* Bagian spesifik untuk index */
    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, #F3E9E2 0%, #FDFDFD 100%);
      padding: 60px 0;
      text-align: center;
    }

    .hero h2 {
      font-size: 48px;
      color: #6D5D4C;
      margin-bottom: 16px;
      font-weight: 700;
    }

    .hero p {
      font-size: 18px;
      color: #6D5D4C;
      opacity: 0.9;
      margin-bottom: 40px;
    }

    /* Search Card */
    .search-card {
      background-color: #FDFDFD;
      border-radius: 16px;
      padding: 32px;
      box-shadow: 0 4px 20px rgba(109, 93, 76, 0.1);
      max-width: 900px;
      margin: 0 auto;
    }

    .search-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-bottom: 24px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-size: 14px;
      font-weight: 600;
      color: #6D5D4C;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 12px 16px;
      border: 2px solid #F3E9E2;
      border-radius: 8px;
      font-size: 16px;
      color: #6D5D4C;
      background-color: #FDFDFD;
      transition: border-color 0.3s;
      font-family: inherit;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #D4B896;
    }

    .search-button, .btn-primary {
      background-color: #D4B896;
      color: #FDFDFD;
      border: none;
      padding: 16px 48px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      width: 100%;
    }

    .search-button:hover, .btn-primary:hover {
      background-color: #c4a886;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(212, 184, 150, 0.3);
    }

    .btn-secondary {
      background: transparent;
      color: #D4B896;
      border: 2px solid #D4B896;
      padding: 12px 24px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-secondary:hover {
      background-color: #D4B896;
      color: #FDFDFD;
    }

    .btn-danger {
      background-color: #e74c3c;
      color: #FDFDFD;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-danger:hover {
      background-color: #c0392b;
    }

    /* Featured Section */
    .featured {
      padding: 60px 0;
      background-color: #FDFDFD;
    }

    .section-header {
      text-align: center;
      margin-bottom: 48px;
    }

    .section-header h3 {
      font-size: 36px;
      color: #6D5D4C;
      margin-bottom: 12px;
      font-weight: 700;
    }

    .section-divider {
      width: 80px;
      height: 4px;
      background-color: #D4B896;
      margin: 0 auto;
      border-radius: 2px;
    }

    .hotel-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 32px;
    }

    .hotel-card {
      background-color: #FDFDFD;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(109, 93, 76, 0.08);
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
    }

    .hotel-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 24px rgba(109, 93, 76, 0.15);
    }

    .hotel-image {
      width: 100%;
      height: 200px;
      background: linear-gradient(135deg, #F3E9E2 0%, #D4B896 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 64px;
    }

    .hotel-content {
      padding: 24px;
    }

    .hotel-content h4 {
      font-size: 22px;
      color: #6D5D4C;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .hotel-location {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #6D5D4C;
      opacity: 0.8;
      font-size: 14px;
      margin-bottom: 16px;
    }

    .hotel-features {
      display: flex;
      gap: 12px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .feature-tag {
      background-color: #F3E9E2;
      color: #6D5D4C;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
    }

    .hotel-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 16px;
      border-top: 2px solid #F3E9E2;
    }

    .price {
      font-size: 24px;
      color: #D4B896;
      font-weight: 700;
    }

    .price-label {
      font-size: 12px;
      color: #6D5D4C;
      opacity: 0.7;
    }

    .book-button {
      background-color: #D4B896;
      color: #FDFDFD;
      border: none;
      padding: 10px 24px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .book-button:hover {
      background-color: #c4a886;
    }

    /* Responsive untuk index */
    @media (max-width: 768px) {
      .hero h2 {
        font-size: 32px;
      }

      .search-form {
        grid-template-columns: 1fr;
      }

      .hotel-grid {
        grid-template-columns: 1fr;
      }
    }
</style>
<body>
<header>
<div class="container">
    <div class="header-content">
    <div class="logo">
    <div class="logo-icon">🏨</div>
    <div class="logo-text">
    <h1 id="app-title">CozyStay</h1>
    <p id="tagline">Temukan kenyamanan rumah</p>
    </div>
    </div>
    <nav>
    <a href="?page=home">Beranda</a>
    <a href="?page=hotel">Hotel</a>
    <a href="?page=about">Tentang</a>
    <a href="?page=contact">Kontak</a>
    </nav>
    <?php if (!$isLoggedIn): ?>
    <div class="auth-buttons" id="auth-buttons">
    <a href="?page=login"><button class="btn-login">Masuk</button></a>
    <a href="?page=register"><button class="btn-register">Daftar</button></a>
    </div>
    <?php else: ?>
    <div class="user-menu" id="user-menu">
    <span id="user-name"><?php echo $user['nama']; ?></span>
    <div class="user-avatar" onclick="toggleDropdown()" id="user-avatar">U</div>
    <div class="dropdown-menu" id="dropdown-menu">
    <a href="?page=dashboard">Dashboard</a>
    <a href="?page=profile">Profil</a>
    <button onclick="logout()">Keluar</button>
    </div>
    </div>
    <?php endif; ?>
    </div>
</div>
</header>

<?php if (!$isLoggedIn): ?>
<!-- Home Page (untuk pengguna belum login) -->
<div id="home-page" class="page-section active">
<section class="hero">
    <div class="container">
    <h2 id="search-title">Reservasi Hotel Impian Anda</h2>
    <p>Nikmati pengalaman menginap yang tak terlupakan dengan harga terbaik</p>
    <div class="search-card">
    <form class="search-form" method="POST" action="?page=home">
    <div class="form-group">
        <label for="location" id="location-label">Lokasi</label>
        <input type="text" id="location" name="location" placeholder="Mau ke mana?" required>
    </div>
    <div class="form-group">
        <label for="checkin" id="checkin-label">Check-in</label>
        <input type="date" id="checkin" name="checkin" required>
    </div>
    <div class="form-group">
        <label for="checkout" id="checkout-label">Check-out</label>
        <input type="date" id="checkout" name="checkout" required>
    </div>
    <div class="form-group">
        <label for="guests" id="guests-label">Tamu</label>
        <select id="guests" name="guests" required>
        <option value="1">1 Tamu</option>
        <option value="2">2 Tamu</option>
        <option value="3">3 Tamu</option>
        <option value="4">4 Tamu</option>
        <option value="5">5+ Tamu</option>
        </select>
    </div>
    <button type="submit" class="search-button" id="search-button">Cari Hotel</button>
    </form>
    </div>
    </div>
</section>
<section class="featured">
    <div class="container">
    <div class="section-header">
    <h3 id="featured-title">Hotel Pilihan Terbaik</h3>
    <div class="section-divider"></div>
    <p id="reservation-stats" style="margin-top: 12px; color: #6D5D4C; opacity: 0.8; font-size: 14px;">Total Reservasi: 0</p>
    </div>
    <div class="hotel-grid" id="hotel-grid">
    <?php
      $hotels = getHotels(); // Dari tabel hotel di db_Hotel
    foreach ($hotels as $hotel) {
        echo "<div class='hotel-card'>{$hotel['nama_hotel']} - {$hotel['kota']}</div>";
    }
    ?>
    </div>
    </div>
</section>
</div>
<?php else: ?>
<!-- Dashboard Page (untuk pengguna sudah login) -->
<div id="dashboard-page" class="page-section active">
<div class="dashboard-container">
    <div class="container">
    <div class="dashboard-header">
    <h2 id="dashboard-title">Dashboard</h2>
    <p id="dashboard-subtitle">Selamat datang di panel kontrol Anda</p>
    </div>
    <!-- Customer Dashboard -->
    <?php if ($user['peran'] == 'customer'): ?>
    <div id="customer-dashboard">
    <div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-number" id="customer-reservations"><?php echo count(getCustomerReservations($user['id_user'])); ?></div>
        <div class="stat-label">Total Reservasi</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" id="customer-active">0</div>
        <div class="stat-label">Reservasi Aktif</div>
    </div>
    </div>
    <div class="dashboard-section">
    <div class="section-title">
        <h3>Riwayat Reservasi</h3>
    </div>
    <table class="data-table">
        <thead>
        <tr>
        <th>ID Reservasi</th>
        <th>Hotel</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Status</th>
        <th>Total</th>
        </tr>
        </thead>
        <tbody id="customer-reservations-table">
        <?php
        $reservations = getCustomerReservations($user['id_user']);
        foreach ($reservations as $res) {
            echo "<tr><td>{$res['id_reservasi']}</td><td>{$res['nama_hotel']}</td><td>{$res['tanggal_check_in']}</td><td>{$res['tanggal_check_out']}</td><td>{$res['status_reservasi']}</td><td>{$res['total_harga']}</td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
    <!-- Mitra Dashboard -->
    <?php elseif ($user['peran'] == 'mitra'): ?>
    <div id="mitra-dashboard">
    <div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-number" id="mitra-hotels"><?php echo count(getMitraHotels($user['id_user'])); ?></div>
        <div class="stat-label">Total Hotel</div>
    </div>
    <div class="stat-card">
        <div class="stat-number" id="mitra-reservations">0</div>
        <div class="stat-label">Total Reservasi</div>
    </div>
    </div>
    <div class="dashboard-section">
    <div class="section-title">
        <h3>Kelola Hotel</h3>
    </div>
    <table class="data-table">
        <thead>
        <tr>
        <th>ID Hotel</th>
        <th>Nama Hotel</th>
        <th>Lokasi</th>
        <th>Status</th>
        <th>Aksi</th>
        </tr>
        </thead>
        <tbody id="mitra-hotels-table">
        <?php
        $hotels = getMitraHotels($user['id_user']);
        foreach ($hotels as $hotel) {
        echo "<tr><td>{$hotel['id_hotel']}</td><td>{$hotel['nama_hotel']}</td><td>{$hotel['kota']}</td><td>{$hotel['status_hotel']}</td><td><button>Edit</button></td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
    <?php endif; ?>
</div>
</div>
</div>
<?php endif; ?>
</body>
</html>