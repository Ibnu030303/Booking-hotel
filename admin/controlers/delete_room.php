<?php
// Include the database connection
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Delete the room from the database
    $query = "DELETE FROM rooms WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the room ID parameter and execute the query
        mysqli_stmt_bind_param($stmt, "i", $room_id);
        $success = mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if ($success) {
            $message = "Room ID {$room_id} deleted successfully";
        } else {
            $error = mysqli_error($conn);
            $message = "Error deleting room: $error";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing query";
    }
} else {
    $message = "Invalid request";
}

// Redirect back to the laporan page with a message
header("Location: ../index.php?page=rooms&message=" . urlencode($message));

// Close the database connection
mysqli_close($conn);
?>
