<?php

require '../../database/koneksi.php';

class Seeder
{
    public static function seedUsers()
    {
        global $conn;

        // Generate 100 random users
        for ($i = 0; $i < 100; $i++) {
            // Generate random name, email, and role
            $name = 'User ' . uniqid();
            $email = 'user' . rand(1000, 9999) . '@example.com';
            $role = rand(0, 1) ? 'admin' : 'user'; // Randomly assign 'admin' or 'user'

            // Generate a random password
            $password = 'password' . rand(1000, 9999); // Random password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

            // Prepare the query to insert data into users table
            $query = "INSERT INTO users (name, email, role, password) VALUES ('$name', '$email', '$role', '$hashedPassword')";

            // Execute the query
            if (mysqli_query($conn, $query)) {
                echo "User '$name' dengan password '$password' berhasil ditambahkan.\n";
            } else {
                echo "Error: " . mysqli_error($conn) . "\n";
            }
        }
    }
}

// Menjalankan seeder
Seeder::seedUsers();
