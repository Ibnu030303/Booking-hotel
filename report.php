<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Ambil data pemesanan
$query = "SELECT * FROM bookings";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00bcd4;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #00bcd4;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #444;
        }

        thead th {
            padding: 10px;
            text-align: left;
            color: #fff;
            border-bottom: 2px solid #555;
        }

        tbody tr {
            border-bottom: 1px solid #555;
        }

        tbody tr:nth-child(odd) {
            background-color: #444;
        }

        tbody tr:nth-child(even) {
            background-color: #3a3a3a;
        }

        tbody td {
            padding: 10px;
            text-align: left;
            color: #ddd;
        }

        tbody tr:hover {
            background-color: #555;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #bbb;
            font-style: italic;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00bcd4;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-link a:hover {
            background-color: #008c9e;
        }
    </style>
</head>
<body>
    <main class="container">
        <h2>Laporan Pemesanan</h2>
        <a href="add_booking.php">Tambah Pemesanan Baru</a>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Pemesanan</th>
                        <th>Nama Pemesan</th>
                        <th>ID Kamar</th>
                        <th>Tanggal Check-in</th>
                        <th>Tanggal Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['room_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['check_in_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['check_out_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">Tidak ada data pemesanan tersedia.</p>
        <?php endif; ?>

        <!-- Link untuk kembali -->
        <div class="back-link">
            <a href="index.php">Kembali ke Halaman Utama</a>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
