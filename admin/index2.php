<?php
session_start();
include '../koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin/index.php");
    exit();
}

// Proses tambah kamar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_type = $_POST['room_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $availability = isset($_POST['availability']) ? 1 : 0;

    // Proses upload gambar
    $image_name = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $upload_dir = 'img/';

    // Generate nama file unik untuk menghindari duplikasi
    $image_new_name = time() . '_' . $image_name;
    $upload_path = $upload_dir . $image_new_name;

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true); // Membuat folder jika belum ada
    }

    // Validasi ukuran file (maksimal 2MB)
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        $error = "Ukuran gambar terlalu besar. Maksimal 2MB.";
    } elseif (move_uploaded_file($image_temp, $upload_path)) {
        // Simpan data ke database
        $sql = "INSERT INTO rooms (room_type, description, price, availability, image) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdss", $room_type, $description, $price, $availability, $image_new_name);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    } else {
        $error = "Failed to upload image.";
    }
}

// Ambil data kamar dari database
$query = "SELECT * FROM rooms";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="admin-header">
        <h1>Dashboard Admin</h1>
        <a href="index.php" class="btn btn-logout">Logout</a>
    </header>

    <main class="admin-container">
        <h2>Tambah Kamar Baru</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
            <label for="room_type">Tipe Kamar:</label>
            <input type="text" id="room_type" name="room_type" required>

            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Harga per malam:</label>
            <input type="number" id="price" name="price" required>

            <label for="availability">Tersedia:</label>
            <input type="checkbox" id="availability" name="availability">

            <label for="image">Upload Gambar:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit" class="btn">Tambah Kamar</button>
        </form>

        <h2>Daftar Kamar</h2>
        <table class="room-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Tipe Kamar</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Ketersediaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php
                        $image_path = isset($row['image']) ? 'img/' . htmlspecialchars($row['image']) : "img/default.jpg";
                        if (file_exists($image_path)) {
                            echo '<img src="' . $image_path . '" alt="Gambar Kamar" style="width: 100px; height: 100px; object-fit: cover;">';
                        } else {
                            echo '<img src="img/default.jpg" alt="Default Image" style="width: 100px; height: 100px; object-fit: cover;">';
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['availability'] ? 'Tersedia' : 'Tidak Tersedia'); ?></td>
                    <td>
                        <a href="edit_room.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete_room.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
