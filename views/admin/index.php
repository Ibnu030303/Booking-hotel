<?php
// Include necessary files
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sewa Hotel/middleware/roleMiddleware.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sewa Hotel/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sewa Hotel/database/koneksi.php';

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email']; // Get the user email from session
} else {
    // Redirect to login page if not logged in
    header("Location: /Sewa Hotel/views/login.php");
    exit();
}

// Ensure the user is an 'admin'
authorize('admin');
?>

<?php
require 'layouts/Header.php';
?>

<div class="wrapper">
    <?php
    require 'layouts/Sidebar.php';
    ?>

    <main id="main" class="main">
        <header class="bg-primary">
            <?php
            require 'layouts/Nav.php';
            ?>

            <?php
            // Get the 'page' parameter from the URL, default to 'dashboard' if not set
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            // Switch case to load the appropriate page
            switch ($page) {
                case 'dashboard':
                    require 'pages/dashboard.php';
                    break;

                case 'users':
                    require 'pages/users.php';
                    break;

                case 'settings':
                    require 'pages/settings.php';
                    break;

                default:
                    echo "<h2>Page not found!</h2>";
                    break;
            }
            ?>
        </header>


    </main>
</div>

<!-- Script -->
<script>
    const sidebarToggle = document.querySelector("#sidebar-toggle");
    sidebarToggle.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
</script>