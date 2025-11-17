<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
<div class="title">
    Form Login
</div>

        <form action="fuction.php" method="POST">
    <input type="hidden" name="action" value="login">

    <div class="field">
        <input type="text" name="username" required>
        <label>Username</label>
    </div>

    <div class="field">
        <input type="password" name="password" required>
        <label>Password</label>
    </div>
<a href="register.php" style="color:red;">register</a>

    <input type="submit" value="Login">
</form>

</body>
<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = event.target;
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.textContent = "🙈"; // ubah ke ikon mata tertutup
    } else {
        passwordInput.type = "password";
        icon.textContent = "👁️"; // ubah ke ikon mata terbuka
    }
}
</script>

</html>