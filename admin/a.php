<?php
$password = "admin123";

$hash = password_hash($password, PASSWORD_BCRYPT);

echo $hash;

// Verifikasi
var_dump(password_verify($password, $hash));
?>
