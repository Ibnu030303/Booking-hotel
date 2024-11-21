<?php
include '../../koneksi.php'; // Ensure your path to koneksi.php is correct

// Check if the form is submitted and all necessary data is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Sanitize and validate inputs
    $id = intval($_POST['id']);  // Ensure id is an integer
    $customerName = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $roomId = mysqli_real_escape_string($conn, $_POST['room_id']);
    $checkInDate = mysqli_real_escape_string($conn, $_POST['check_in_date']);
    $checkOutDate = mysqli_real_escape_string($conn, $_POST['check_out_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Prepare SQL query for updating booking data
    $query = "UPDATE bookings SET 
                customer_name = ?, 
                email = ?, 
                phone = ?, 
                room_id = ?, 
                check_in_date = ?, 
                check_out_date = ?, 
                status = ? 
              WHERE id = ?";

    // Prepare and bind parameters
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssssssi", $customerName, $email, $phone, $roomId, $checkInDate, $checkOutDate, $status, $id);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Booking ID {$booking_id} editing successfully";
        } else {
            $error = mysqli_error($conn);
            $message = "Error editing booking: $error";
        }

       // Close the statement
       mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing query";
    }
} else {
    $message = "Invalid request";
}

header("Location: ../index.php?page=laporan&message=" . urlencode($message));

// Close the database connection
mysqli_close($conn);
?>
