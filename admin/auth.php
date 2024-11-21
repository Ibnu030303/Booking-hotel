<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}
?>
