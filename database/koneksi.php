<?php
// Konfigurasi database
$host = "localhost"; // Host database (default: localhost)
$user = "root"; // Username database
$password = ""; // Password database (kosong jika default)
$database = "hotel"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Opsional: Set karakter encoding ke UTF-8
$conn->set_charset("utf8");
