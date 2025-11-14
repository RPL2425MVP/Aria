<?php
// File: register.php
include 'functions.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $password = $_POST['password'];
    $role = sanitize($_POST['role']);
    if (registerUser($name, $email, $phone, $password, $role)) {
        $message = 'Registrasi berhasil!';
    } else {
        $message = 'Registrasi gagal!';
    }
}
?>
<!-- Register Page -->
<div id="register-page" class="page-section">
 <div class="auth-container">
  <div class="container">
   <div class="auth-card">
    <div class="auth-header">
     <h2>Buat Akun Baru</h2>
     <p>Bergabunglah dengan kami!</p>
    </div>
    <form class="auth-form" method="POST">
     <div class="form-group">
      <label for="name">Nama Lengkap</label>
      <input type="text" id="name" name="name" required>
     </div>
     <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
     </div>
     <div class="form-group">
      <label for="phone">No. Telepon</label>
      <input type="tel" id="phone" name="phone" required>
     </div>
     <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
     </div>
     <div class="form-group">
      <label for="role">Daftar sebagai</label>
      <select id="role" name="role" required>
       <option value="customer">Customer</option>
       <option value="mitra">Mitra Hotel</option>
      </select>
     </div>
     <button type="submit" class="btn-primary">Daftar</button>
     <?php if ($message) echo "<p>$message</p>"; ?>
    </form>
    <div class="auth-switch">
     Sudah punya akun? <a href="?page=login">Masuk sekarang</a>
    </div>
   </div>
  </div>
 </div>
</div>