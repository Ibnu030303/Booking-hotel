<?php
require_once "url.php"
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Hotel</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- <script src="https://unpkg.com/scrollreveal"></script> -->

    <!-- OAS -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->

    <!-- SWEETALERT -->
    <!-- <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>

    <!-- AOS -->
    <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script> -->

    <!-- SWEETALERT -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script> -->

    <!-- <script>
        // Inisialisasi ScrollReveal
        ScrollReveal({
            reset: true, // Mengatur apakah efek akan diputar ulang setiap kali elemen muncul kembali
            distance: "60px", // Jarak pergerakan efek
            duration: 2500, // Durasi animasi (dalam milidetik)
            delay: 400, // Delay sebelum animasi dimulai
        });

        // Memberikan efek reveal untuk Hero Section
        ScrollReveal().reveal("#heroSection", {
            delay: 200,
            origin: "top", // Menampilkan dari atas
            distance: "100px",
        });

        ScrollReveal().reveal("#heroImage", {
            delay: 300,
            origin: "left", // Menampilkan dari kiri
            distance: "100px",
        });

        ScrollReveal().reveal("#heroText", {
            delay: 400,
            origin: "right", // Menampilkan dari kanan
            distance: "100px",
        });
    </script> -->
</body>

</html>