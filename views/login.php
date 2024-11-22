<?php
session_start(); // Start the session to access session variables
require_once dirname(__DIR__) . '/components/Header.php';
?>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="row">
        <div class="col">
            <div class="card shadow-lg border-0" style="width: 30rem;">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">Login to Your Account</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('controllers/authController.php'); ?>" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                        </div>
                        <input type="hidden" name="return_url" value="<?php echo isset($_GET['return_url']) ? htmlspecialchars($_GET['return_url']) : ''; ?>">

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="/Sewa Hotel" class="text-decoration-none text-secondary">
                            <i class="bi bi-house-door-fill me-1"></i> Back to home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>