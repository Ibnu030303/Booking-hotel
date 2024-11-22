<?php

require '../database/koneksi.php';

class Migration
{

    public static function up()
    {
        global $conn;
        $query = "
            CREATE TABLE IF NOT EXISTS users (
                user_id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                role ENUM('admin', 'user') DEFAULT 'user',
                password VARCHAR(255) NOT NULL,  -- Menambahkan kolom password
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        if (mysqli_query($conn, $query)) {
            echo "Tabel 'users' berhasil dibuat.\n";
        } else {
            echo "Error: " . mysqli_error($conn) . "\n";
        }
    }

    public static function down()
    {
        global $conn;
        $query = "DROP TABLE IF EXISTS users;";
        if (mysqli_query($conn, $query)) {
            echo "Tabel 'users' berhasil dihapus.\n";
        } else {
            echo "Error: " . mysqli_error($conn) . "\n";
        }
    }
}

// Menjalankan migrasi
Migration::up();
