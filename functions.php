<?php
// File: functions.php
// Fungsi umum untuk aplikasi hotel reservation dengan skema database baru

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_Hotel'); // Nama database sesuai instruksi
define('DB_USER', 'root'); // Ganti dengan username DB Anda
define('DB_PASS', ''); // Ganti dengan password DB Anda

// Fungsi koneksi database menggunakan PDO
function connectDB() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}

// Fungsi sanitasi input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Fungsi hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fungsi verifikasi password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Fungsi untuk mendapatkan data hotel dari tabel hotel
function getHotels() {
    $pdo = connectDB();
    $stmt = $pdo->query("SELECT * FROM hotel WHERE status_hotel = 'aktif'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mendapatkan kamar berdasarkan hotel dari tabel kamar
function getRoomsByHotel($hotelId) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM kamar WHERE id_hotel = ? AND status_kamar = 'aktif'");
    $stmt->execute([$hotelId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mendapatkan reservasi customer dari tabel reservasi
function getCustomerReservations($customerId) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT r.*, h.nama_hotel, k.tipe_kamar FROM reservasi r JOIN kamar k ON r.id_kamar = k.id_kamar JOIN hotel h ON k.id_hotel = h.id_hotel WHERE r.id_user = ?");
    $stmt->execute([$customerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mendapatkan hotel mitra dari tabel hotel
function getMitraHotels($mitraId) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM hotel WHERE id_mitra = ?");
    $stmt->execute([$mitraId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk login dari tabel user
function loginUser($email, $password, $role) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ? AND peran = ?");
    $stmt->execute([$email, $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && verifyPassword($password, $user['password'])) {
        return $user;
    }
    return false;
}

// Fungsi untuk register dari tabel user
function registerUser($name, $email, $phone, $password, $role) {
    $pdo = connectDB();
    $hashedPassword = hashPassword($password);
    $stmt = $pdo->prepare("INSERT INTO user (nama, email, no_telp, password, peran) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $phone, $hashedPassword, $role]);
}

// Fungsi untuk handle search hotel (contoh sederhana dari tabel hotel)
function searchHotels($location, $checkin, $checkout, $guests) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT * FROM hotel WHERE kota LIKE ? AND status_hotel = 'aktif'");
    $stmt->execute(['%' . $location . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mendapatkan review hotel dari tabel review
function getHotelReviews($hotelId) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT r.*, u.nama FROM review r JOIN user u ON r.id_user = u.id_user WHERE r.id_hotel = ?");
    $stmt->execute([$hotelId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk logout (session destroy)
function logout() {
    session_destroy();
}

// Fungsi untuk cek login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk mendapatkan user dari session
function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}
?>