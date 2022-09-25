<?php
echo "<script>alert('Anda telah keluar');</script>";

if (array_key_exists('role', $session)) {
    echo "<script>location='../login-kasir.php';</script>";
    return;
}
echo "<script>location='login.php';</script>";
session_destroy();
