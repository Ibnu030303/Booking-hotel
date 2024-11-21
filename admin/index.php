<?php 
include 'layouts/header.php'; 
?>

<div class="wrapper">
    <?php include 'layouts/sidebar.php'; ?>

    <main id="main" class="main">


        <div id="page-content">
            <?php
            // Ambil parameter halaman dari URL
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            // Gunakan switch untuk memuat konten berdasarkan halaman
            switch ($page) {
                case 'dashboard':
                    include 'pages/dashboard.php';
                    break;
                case 'laporan':
                    include 'pages/laporan.php';
                    break;
                case 'rooms':
                    include 'pages/rooms.php';
                    break;
                default:
                    echo "<p>Halaman tidak ditemukan.</p>";
                    break;
            }
            ?>
        </div>
    </main>
</div>

