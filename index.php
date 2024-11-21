<?php
// Include file koneksi database
include 'koneksi.php';

// Memuat layout utama
require 'layouts/header.php';
require 'layouts/navbar.php';
?>

<main>
    <?php
    // Hero Section
    if (!file_exists('layouts/heroSection.php')) {
        die('File header.php tidak ditemukan.');
    }
    require 'layouts/heroSection.php';


    // About Section
    if (!file_exists('layouts/aboutSection.php')) {
        die('File about.php tidak ditemukan.');
    }
    require 'layouts/aboutSection.php';


    // Room Section
    if (!file_exists('layouts/roomSection.php')) {
        die('File room.php tidak ditemukan.');
    }
    require 'layouts/roomSection.php';


    // Footer
    require 'layouts/footer.php';
    ?>

</main>