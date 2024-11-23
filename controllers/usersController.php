<?php
require '../database/koneksi.php';

session_start(); // Pastikan session dimulai di awal file

class UserController
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }


    // Function to create a new user
    public function createUser($name, $email, $password, $role)
    {
        // Check if email already exists
        $checkQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // If email already exists, return an error message
        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = 'Email already exists!';
            header("Location: /Sewa%20Hotel/admin/index.php?page=users");
            exit();
        }

        // If email does not exist, proceed with creating the user
        $hashedPassword = password_hash(
            $password,
            PASSWORD_BCRYPT
        );

        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssss', $name, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'User created successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to create user.';
        }

        header("Location: /Sewa%20Hotel/admin/index.php?page=users");
        exit();
    }

    public function updateUser($userId, $name, $email, $role, $password = null)
    {
        $query = $password
            ? "UPDATE users SET name = ?, email = ?, role = ?, password = ? WHERE user_id = ?"
            : "UPDATE users SET name = ?, email = ?, role = ? WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bind_param('ssssi', $name, $email, $role, $hashedPassword, $userId);
        } else {
            $stmt->bind_param('sssi', $name, $email, $role, $userId);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'User updated successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to update user.';
        }
        header("Location: /Sewa%20Hotel/admin/index.php?page=users");
        exit();
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $userId);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'User deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete user: ' . $stmt->error;
        }
        header("Location: /Sewa%20Hotel/admin/index.php?page=users");
        exit();
    }
}


// Instantiate the controller
$userController = new UserController($conn);

// Handle incoming requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'create') {
        // Create a new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        echo $userController->createUser($name, $email, $password, $role);
    } elseif ($action === 'update') {
        $userId = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $password = !empty($_POST['passwordBaru']) ? $_POST['passwordBaru'] : null;

        $userController->updateUser($userId, $name, $email, $role, $password);
    } elseif ($action === 'delete') {
        // Delete a user
        $userId = $_POST['user_id'];

        echo $userController->deleteUser($userId);
    }
}
