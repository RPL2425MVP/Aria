<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Register</title>
</head>

<style>
    /* Reset dasar untuk konsistensi */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body dengan latar belakang putih bersih */
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(rgba(59, 57, 57, 0.7), rgba(0, 0, 0, 0.7)), url("image/aula.jpg");
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #6D5D4C;
        /* Cokelat Netral untuk teks */
        background-position: center;
        background-size: cover;
    }

    /* Wrapper sebagai section divider dengan beige lembut */
    .wrapper {
        background-color: #F3E9E2;
        /* Beige Lembut */
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    /* Judul */
    .title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #6D5D4C;
        /* Cokelat Netral */
    }

    /* Form styling */
    form {
        display: flex;
        flex-direction: column;
    }

    /* Field input */
    .field {
        position: relative;
        margin-bottom: 20px;
    }



    .field input {
        width: 100%;
        padding: 10px;
        border: 1px solid #D4B896;
        /* Cokelat Kayu Muda untuk border */
        border-radius: 5px;
        font-size: 16px;
        background-color: #FDFDFD;
        /* Putih Bersih */
        color: #6D5D4C;
        /* Cokelat Netral */
        transition: border-color 0.3s;
    }

    .field input:focus {
        outline: none;
        border-color: #6D5D4C;
        /* Cokelat Netral saat fokus */
    }

    .field label {
        position: absolute;
        top: 10px;
        left: 10px;
        color: #6D5D4C;
        /* Cokelat Netral */
        pointer-events: none;
        transition: 0.3s;
    }

    .field input:focus+label,
    .field input:valid+label {
        top: -10px;
        font-size: 12px;
        color: #D4B896;
        /* Cokelat Kayu Muda */
    }

    /* Link login (seperti tombol) */
    .register-btn {
        background-color: #D4B896;
        /* Cokelat Kayu Muda */
        color: #FDFDFD;
        /* Putih Bersih */
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        display: inline-block;
        text-decoration: none;
        margin-bottom: 20px;
    }

    .register-btn:hover {
        background-color: #6D5D4C;
        /* Cokelat Netral */
    }

    /* Tombol submit */
    input[type="submit"] {
        background-color: #D4B896;
        /* Cokelat Kayu Muda */
        color: #FDFDFD;
        /* Putih Bersih */
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #6D5D4C;
        /* Cokelat Netral */
    }
</style>

<body>
    <div class="wrapper">
        <div class="title">
            Form Register
        </div>

        <form action="function.php" method="POST">
    <input type="hidden" name="action" value="register">

    <div class="field">
        <input type="text" name="nama" required>
        <label>Nama Lengkap</label>
    </div>

    <div class="field">
        <input type="email" name="email" required>
        <label>Email</label>
    </div>

    <div class="field">
        <input type="text" name="no_telp" required>
        <label>No Telp</label>
    </div>

    <div class="field">
        <input type="password" name="password" required>
        <label>Password</label>
    </div>

    <div class="field" style="display: none;">
        <select name="peran" required>
            <option value="customer">Customer</option>
        </select>
    </div>
    <a href="login.php" class="register-btn">Login</a>
    <input type="submit" value="Daftar">
</form>
    </div>
</body>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const icon = event.target;
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.textContent = ""; // ubah ke ikon mata tertutup
        } else {
            passwordInput.type = "password";
            icon.textContent = ""; // ubah ke ikon mata terbuka
        }
    }
</script>

</html>
