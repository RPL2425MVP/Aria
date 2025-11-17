<?php
session_start();
include 'koneksi.php';

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Form tidak lengkap!");
}

$nama = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE nama = '$nama' AND password = '$password'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);

    $_SESSION['nama'] = $data['nama'];
    $_SESSION['peran'] = $data['peran'];

    // Gunakan operator perbandingan (==), bukan assignment (=)
    if ($data['peran'] == 'mitra') {
        header("location:mitra/index.php");
        exit;
    } elseif ($data['peran'] == 'customer') {
        header("location:customer/index.php");
        exit;
    } else {
        echo "Peran tidak dikenali!";
    }

} else {
    echo "Login gagal! Username atau password salah";
}
?>
