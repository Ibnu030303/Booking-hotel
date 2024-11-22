<?php
// Include the roleMiddleware to handle session and authorization
require_once $_SERVER['DOCUMENT_ROOT'] . '/Sewa Hotel/middleware/roleMiddleware.php';

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email']; // Get the user email from session
} else {
    // Redirect to login page if not logged in
    header("Location: /Sewa Hotel/views/login.php");
    exit();
}

// Ensure the user is an 'admin'
authorize('user');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Hello User</h1>
    <p>Your email: <?php echo htmlspecialchars($userEmail); ?></p>
    <a href="/Sewa Hotel/controllers/authController.php?action=logout" class="btn btn-danger">Logout</a>
</body>

</html>