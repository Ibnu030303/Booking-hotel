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
            // Data hotel
            $hotels = [
                [
                    'name' => 'The Kuta Hotel',
                    'location' => 'Kuta, Bali',
                    'rating' => 4.8,
                    'price' => 'Rp. 1.200.000',
                    'image' => 'assets/img/about1.png'
                ],
                [
                    'name' => 'Jakarta Grand Stay',
                    'location' => 'Jakarta',
                    'rating' => 4.7,
                    'price' => 'Rp. 950.000',
                    'image' => 'assets/img/about2.png'
                ]
            ];

            // Loop untuk menampilkan kartu hotel
            foreach ($hotels as $hotel) :
            ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card position-relative">
                        <!-- Hotel Image -->
                        <div class="overflow-hidden rounded img-hover">
                            <img
                                src="<?php echo base_url($hotel['image']); ?>"
                                alt="<?php echo $hotel['name']; ?>"
                                class="img-fluid transition-transform" />
                        </div>
                        <!-- Hotel Image END -->

                        <!-- Card Body -->
                        <div class="card-body position-absolute bg-white shadow card-body-custom">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-location-dot text-primary me-2"></i>
                                    <p class="text-muted small mb-0"><?php echo $hotel['location']; ?></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-star text-warning me-1"></i>
                                    <p class="text-muted small mb-0"><?php echo $hotel['rating']; ?></p>
                                </div>
                            </div>
                            <h5 class="fw-bold text-primary"><?php echo $hotel['name']; ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-bold text-secondary"><?php echo $hotel['price']; ?> / night</p>
                                <button class="btn btn-primary btn-sm">Book Now</button>
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