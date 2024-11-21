<?php
// Include database connection file
include '../../koneksi.php';

// Check if 'id' is set in the URL and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the booking ID from the URL
    $booking_id = intval($_GET['id']);

    // Prepare SQL query to delete the booking
    $query = "DELETE FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind the parameter and execute the query
        mysqli_stmt_bind_param($stmt, "i", $booking_id);
        $success = mysqli_stmt_execute($stmt);

        // Check if the deletion was successful
        if ($success) {
            $message = "Booking ID {$booking_id} deleted successfully";
        } else {
            $error = mysqli_error($conn);
            $message = "Error deleting booking: $error";
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
header("Location: ../index.php?page=laporan&message=" . urlencode($message));

// Close the database connection
mysqli_close($conn);
