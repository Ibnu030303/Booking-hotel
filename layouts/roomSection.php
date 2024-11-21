<?php

// Query untuk mendapatkan data kamar
$query = "SELECT * FROM rooms";
$result = $conn->query($query);

// Simpan hasil ke dalam array
$rooms = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}
?>


<!-- Popular Hotels Section -->
<section class="rooms-section" id="rooms">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="text-success fw-bold">
                    The Rooms <span class="text-secondary">Hotels</span> on TravelFun
                </h2>
            </div>
        </div>
        <!-- Header END -->

        <!-- Hotel Cards -->
        <div class="row">
            <?php
            // Loop untuk menampilkan kartu hotel
            foreach ($rooms as $room) :
            ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card position-relative">
                        <!-- Room Image -->
                        <div class="overflow-hidden rounded img-hover">
                            <img
                                src="<?php echo base_url('assets/uploads/' . $room['image']); ?>"
                                alt="<?php echo $room['room_type']; ?>"
                                class="img-fluid transition-transform" />
                        </div>
                        <!-- Room Image END -->

                        <!-- Card Body -->
                        <div class="card-body position-absolute bg-white shadow card-body-custom">

                            <h5 class="fw-bold text-primary"><?php echo $room['room_type']; ?></h5>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="text-muted small mb-0"><?php echo $room['description']; ?></p>
                                <p class="text-muted small mb-0"><?php echo $room['availability'] ? 'Available' : 'Not Available'; ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold text-secondary">Rp. <?php echo number_format($room['price'], 0, ',', '.'); ?> / night</p>
                                <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="btn btn-primary">Booking</a>
                            </div>
                        </div>
                        <!-- Card Body END -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Hotel Cards END -->
    </div>
</section>

<!-- Popular Hotels Section END -->