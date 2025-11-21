<?php
session_start();
include 'koneksi.php';



function loginUser($conn)
{
    // Pastikan session sudah dimulai di file utama (index.php, dll)
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        die("Form tidak lengkap!");
    }

    $nama = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $query = "SELECT nama, password, peran FROM user WHERE nama = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        die("Error query: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $nama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        // Verifikasi password dengan hash
        if (password_verify($password, $data['password'])) {
            // Login sukses
            
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['peran'] = $data['peran'];

            // Redirect berdasarkan peran
            switch ($data['peran']) {
                case 'admin':
                    header("Location: admin/index.php");
                    exit;
                case 'customer':
                    header("Location: customer/index.php");
                    exit;
                case 'mitra':
                    header("Location: mitra/index.php");
                    exit;
                default:
                    echo "Peran tidak dikenali!";
            }
        } else {
            echo "Login gagal! Username atau password salah.";
        }
    } else {
        echo "Login gagal! Username atau password salah.";
    }

    mysqli_stmt_close($stmt);
}



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
