<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
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
        background-color: #F3E9E2; /* Agar label tidak tertutup background */
        padding: 0 5px;
    }

    .field input:focus + label,
    .field input:not(:placeholder-shown) + label {
        top: -10px;
        font-size: 12px;
        color: #D4B896;
        /* Cokelat Kayu Muda */
    }

    /* Link register */
    a {
        color: #D4B896;
        /* Cokelat Kayu Muda */
        text-decoration: none;
        margin-bottom: 20px;
        display: inline-block;
    }

    a:hover {
        text-decoration: underline;
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
        margin-bottom: 20px;
    }

    input[type="submit"]:hover {
        background-color: #6D5D4C;
        /* Cokelat Netral */
    }

    /* Pesan register */
    .register-message {
        font-size: 14px;
        color: #6D5D4C;
        margin-bottom: 0px;
    }

    .register-message a {
        color: #D4B896;
        margin-left: 5px;
    }

    /* Toggle password */
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6D5D4C;
        font-size: 18px;
    }
</style>

<body>
    <div class="wrapper">
        <div class="title">
            Form Login
        </div>

        <form action="function.php" method="POST">
            <input type="hidden" name="action" value="login">

            <div class="field">
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div>

            <div class="field">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label>Password</label>
                <span class="password-toggle" onclick="togglePassword()">👁️</span>
            </div>

            <input type="submit" value="Login">

            <div class="register-message">
                <p>Apakah sudah memiliki akun? Jika belum, <a href="register.php">register</a></p>
            </div>
        </form>
    </div>
</body>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const icon = event.target;
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.textContent = "🙈"; // Ikon mata tertutup
        } else {
            passwordInput.type = "password";
            icon.textContent = "👁️"; // Ikon mata terbuka
        }
    }
</script>

</html>
