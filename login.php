<?php
// File: login.php
include 'functions.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $role = sanitize($_POST['role']);
    $user = loginUser($email, $password, $role);
    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user'] = $user;
        header('Location: ?page=dashboard');
        exit;
    } else {
        $message = 'Login gagal!';
    }
}
?>
<!-- Login Page -->
<div id="login-page" class="page-section">
 <div class="auth-container">
  <div class="container">
   <div class="auth-card">
    <div class="auth-header">
     <h2>Masuk ke Akun</h2>
     <p>Selamat datang kembali!</p>
    </div>
    <form class="auth-form" method="POST">
     <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
     </div>
     <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
     </div>
     <div class="form-group">
      <label for="role">Masuk sebagai</label>
      <select id="role" name="role" required>
       <option value="customer">Customer</option>
       <option value="mitra">Mitra Hotel</option>
       <option value="admin">Admin</option>
      </select>
     </div>
     <button type="submit" class="btn-primary">Masuk</button>
     <?php if ($message) echo "<p>$message</p>"; ?>
    </form>
    <div class="auth-switch">
     Belum punya akun? <a href="?page=register">Daftar sekarang</a>
    </div>
   </div>
  </div>
 </div>
</div>