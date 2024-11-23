<nav class="navbar navbar-expand">
    <button class="btn" id="sidebar-toggle" type="button">
        <i class="lni lni-menu navbar-toggler-icon"></i>
    </button>

    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <div class="d-flex">
                    <!-- Display logged-in user's email from session -->
                    <p><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest'; ?></p>
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0 me-2 ms-3">
                        <i class="lni lni-network fw-bold fs-3 text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="logout.php" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>