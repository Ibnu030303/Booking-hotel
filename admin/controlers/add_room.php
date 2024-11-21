<?php
// Include the database connection
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    
    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "../../assets/uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    // Check if the directory exists, if not create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create uploads folder with full permissions
    }

    // Validate the uploaded file
    if (!in_array($imageFileType, $allowed_types)) {
        $message = "Invalid file type. Only jpg, jpeg, png, and gif are allowed.";
        header("Location: ../index.php?page=rooms&message=" . urlencode($message));
        exit();
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Insert room data into the database
        $query = "INSERT INTO rooms (room_type, description, price, availability, image) 
                  VALUES ('$room_type', '$description', '$price', '$availability', '$image')";
        
        if (mysqli_query($conn, $query)) {
            $message = "Room added successfully";
        } else {
            $error = mysqli_error($conn);
            $message = "Error adding room: $error";
        }
    } else {
        $message = "Error uploading file.";
    }

    // Redirect back with the message
    header("Location: ../index.php?page=rooms&message=" . urlencode($message));

    // Close the database connection
    mysqli_close($conn);
}
?>
