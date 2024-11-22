<!-- Things to Prepare Section -->
<section class="bg-light" id="about">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <!-- Left Side -->
            <div class="col-12 col-md-6 position-relative" id="leftImages">
                <!-- Image One -->
                <div class="image-frame">
                    <img src="<?php echo base_url('assets/img/about1.png'); ?>" alt="hotelImageOne" class="image-style" />
                </div>
                <!-- Image Two -->
                <div class="image-frame shadow-frame position-two">
                    <img src="<?php echo base_url('assets/img/about2.png'); ?>" alt="hotelImageTwo" class="image-style" />
                </div>
            </div>
            <!-- Left Side END -->

            <!-- Right Side -->
            <div class="col-12 col-md-6 ps-md-5" id="rightContent">
                <h2 class="text-success mb-5 fw-bold fs-3">
                    Things You Need to Prepare
                    <span class="text-success">Before Booking Your Hotel</span>
                </h2>

                <?php
                // Data poin
                $points = [
                    ["number" => "01.", "title" => "Best Rooms", "description" => "We offer a variety of comfortable rooms to make your stay unforgettable."],
                    ["number" => "02.", "title" => "Best Amenities", "description" => "Enjoy top-notch facilities and services during your stay with us."],
                    ["number" => "03.", "title" => "Great Deals", "description" => "Take advantage of our special offers and discounts for a perfect vacation."]
                ];

                // Loop untuk setiap poin
                foreach ($points as $point) : ?>
                    <div class="text-success mb-4">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <h3 class="fs-5 fw-normal"><?= $point['number']; ?></h3>
                            <h3 class="fs-5 fw-semibold"><?= $point['title']; ?></h3>
                        </div>
                        <p class="text-secondary ms-4">
                            <?= $point['description']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Right Side END -->
        </div>
    </div>
</section>
<!-- Things to Prepare Section END -->