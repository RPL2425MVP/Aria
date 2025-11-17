<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>

<div class="wrapper">
    <div class="title">Register</div>

<form action="fuction.php" method="POST">
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

    <div class="field">
        <select name="peran" required>
            <option value="" hidden>Pilih Peran</option>
            <option value="customer">Customer</option>
            <option value="mitra">Mitra</option>
        </select>
        <label>Peran</label>
    </div>

    <input type="submit" value="Daftar">
</form>

</div>

</body>
</html>
