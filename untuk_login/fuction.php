<?php
session_start();
include 'koneksi.php';


// ==========================================
// FUNCTION LOGIN
// ==========================================
function loginUser($conn)
{
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

}


// ==========================================
// FUNCTION REGISTER
// ==========================================
function registerUser($conn)
{
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $password = $_POST['password'];
    $peran = $_POST['peran'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (nama, email, no_telp, password, peran)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $nama, $email, $no_telp, $hash, $peran);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}



// ==========================================
// TENTUKAN AKSI (login / register)
// ==========================================
if (isset($_POST['action'])) {

    if ($_POST['action'] == "login") {
        loginUser($conn);

    } elseif ($_POST['action'] == "register") {
        registerUser($conn);

    } else {
        echo "Aksi tidak dikenali!";
    }

} else {
    echo "Tidak ada aksi!";
}

$conn->close();
?>
