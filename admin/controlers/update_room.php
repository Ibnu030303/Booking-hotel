<?php
// Include the database connection
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $room_id = mysqli_real_escape_string($conn, $_POST['id']);
    $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    
    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
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
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $message = "Error uploading file.";
            header("Location: ../index.php?page=rooms&message=" . urlencode($message));
            exit();
        }
    } else {
        // If no new image is uploaded, retain the old image from the current data
        $image = mysqli_real_escape_string($conn, $_POST['current_image']);
    }

    // Update the room data in the database
    $query = "UPDATE rooms 
              SET room_type = '$room_type', description = '$description', price = '$price', 
                  availability = '$availability', image = '$image' 
              WHERE id = '$room_id'";

    if (mysqli_query($conn, $query)) {
        $message = "Room updated successfully";
    } else {
        $error = mysqli_error($conn);
        $message = "Error updating room: $error";
    }

    // Redirect back with the message
    header("Location: ../index.php?page=rooms&message=" . urlencode($message));

    // Close the database connection
    mysqli_close($conn);
}
?>
