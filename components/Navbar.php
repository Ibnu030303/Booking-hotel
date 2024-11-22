<!-- Navbar -->
<header class="py-3 fixed-top" id="navbar">
    <div class="container-fluid px-5">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img
                    src="<?php echo base_url('assets/img/logo.svg'); ?>"
                    alt="Logo"
                    class="img-fluid"
                    width="140" />
            </a>
            <!-- Toggle Button -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <?php
                    // Array menu untuk navigasi dinamis
                    $menu_items = [
                        "Home" => "#",
                        "About Us" => "#about",
                        "Rooms" => "#rooms",
                        "Contact" => "#contact"
                    ];
                    $current_page = "Home"; // Ubah sesuai halaman aktif
                    foreach ($menu_items as $name => $link) :
                    ?>
                        <li class="nav-item">
                            <a
                                class="nav-link <?php echo $current_page === $name ? 'active' : ''; ?>"
                                href="<?php echo $link; ?>">
                                <?php echo $name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="d-flex ms-3">
                    <a href="?page=login" class="btn btn-outline-success">
                        Login
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- Navbar END -->