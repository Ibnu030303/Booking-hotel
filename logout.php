<?php
session_start(); // Memulai sesi

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan ke halaman login
header("Location: index.php");
exit();
?>
