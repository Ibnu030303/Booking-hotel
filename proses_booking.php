<?php
include 'koneksi.php';

// Validasi input dari form (pastikan tidak ada data kosong atau tidak valid)
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$room_id = $_POST['room'] ?? '';
$check_in = $_POST['check_in'] ?? '';
$check_out = $_POST['check_out'] ?? '';
$price_per_night = $_POST['price'] ?? 0;

if (empty($name) || empty($email) || empty($phone) || empty($room_id) || empty($check_in) || empty($check_out) || empty($price_per_night)) {
    echo "<h2>Form tidak lengkap!</h2><p>Harap isi semua kolom.</p>";
    exit;
}

// Hitung jumlah hari menginap
$check_in_date = new DateTime($check_in);
$check_out_date = new DateTime($check_out);
$interval = $check_in_date->diff($check_out_date);
$duration = $interval->days;

// Hitung total biaya
$total_price = $duration * $price_per_night;

// Gunakan prepared statement untuk menghindari SQL injection
$stmt = $conn->prepare("INSERT INTO bookings (customer_name, email, phone, room_id, check_in_date, check_out_date, duration, total_price)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssii", $name, $email, $phone, $room_id, $check_in, $check_out, $duration, $total_price);

if ($stmt->execute()) {
    // Booking berhasil, redirect ke halaman booking.php dengan parameter success dan booking data
    header('Location: booking.php?booking_status=success&room_id=' . $room_id .
        '&name=' . urlencode($name) .
        '&check_in=' . urlencode($check_in) .
        '&check_out=' . urlencode($check_out) .
        '&duration=' . urlencode($duration) .
        '&total_price=' . urlencode($total_price));
    exit;
} else {
    // Terjadi kesalahan, redirect ke halaman booking.php dengan parameter error
    header('Location: booking.php?booking_status=error&message=' . urlencode($stmt->error));
    exit;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
