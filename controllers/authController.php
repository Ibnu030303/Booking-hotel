<?php
require '../database/koneksi.php';

// Function to handle user login
function login($email, $password, $return_url = '')
{
    global $conn;

    // Clean the email input
    $email = mysqli_real_escape_string($conn, $email);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $role = $row['role'];

            // Start session and set session variables
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            // Redirect user to the appropriate page after login
            if (!empty($return_url)) {
                header("Location: " . urldecode($return_url));
                exit();
            } else {
                if ($role == 'admin') {
                    header("Location: /Sewa%20Hotel/admin/index.php");
                    exit();
                } else {
                    header("Location: /Sewa%20Hotel/user/index.php");
                    exit();
                }
            }
        } else {
            session_start(); // Mulai session sebelum mengatur $_SESSION
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: /Sewa%20Hotel/?page=login");
            exit();
        }
    } else {
        // Email not found
        $_SESSION['error'] = "Invalid email or password.";
        // Redirect to login page with error
        header("Location: ../?page=login");
        exit();
    }
}

// Function to handle user logout
function logout()
{
    session_start();

    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect user to login page after logout
    header("Location: /Sewa Hotel/");
    exit();
}

// Handle login and logout actions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $return_url = isset($_POST['return_url']) ? $_POST['return_url'] : '';
    login($email, $password, $return_url);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Handle logout action
    logout();
}
