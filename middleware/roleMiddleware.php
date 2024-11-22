<?php
// Mulai session untuk mengakses variabel session
session_start();

// Middleware logic to restrict access based on role
function authorize($requiredRole)
{
    // Pastikan session 'role' ada
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: /Sewa Hotel/views/login.php");
        exit();
    }

    // Dapatkan role pengguna dari session
    $userRole = $_SESSION['role'];

    // Jika peran pengguna tidak sesuai, redirect ke halaman unauthorized
    if ($userRole !== $requiredRole) {
        header("Location: /Sewa Hotel/views/unauthorized.php");
        exit();
    }
}
