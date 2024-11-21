<!-- Hero Section -->
<section class="hero-section text-center text-md-start" id="heroSection">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- Right Side -->
            <div class="col-md-6 order-md-2 mb-md-0 mb-4" id="heroImage">
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <!-- Image -->
                    <img
                        src="<?php echo base_url('assets/img/hero.png'); ?>"
                        alt="A luxurious hotel room with modern design"
                        class="img-fluid rounded-top rounded-bottom"
                        style="border-radius: 0 80px 80px 0;" />

                    <!-- Bottom Card -->
                    <div class="card position-absolute bottom-0 start-0 shadow-sm custom-card-bottom">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-circle-check text-success me-2"></i>
                            <p class="fw-bold mb-0 text-sm">Verified</p>
                        </div>
                        <p class="text-muted small">
                            Fully sanitized and secure environment.
                        </p>
                    </div>

                    <!-- Top Card -->
                    <div class="card position-absolute d-none d-md-flex end-0 top-0 shadow-sm custom-card-top">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-bed text-success me-2"></i>
                            <p class="fw-bold mb-0 text-sm">Luxury Rooms</p>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-utensils text-success me-2"></i>
                            <p class="fw-bold mb-0 text-sm">Fine Dining</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-spa text-success me-2"></i>
                            <p class="fw-bold mb-0 text-sm">Spa & Wellness</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Side END -->

            <!-- Left Side -->
            <div class="col-md-6 order-md-1" id="heroText">
                <!-- Rating -->
                <div class="d-flex align-items-center mb-3">
                    <?php for ($i = 0; $i < 4; $i++) : ?>
                        <i class="fa-solid fa-star text-warning"></i>
                    <?php endfor; ?>
                    <p class="text-muted fst-italic mb-0 ms-2">
                        Exclusive Hotel Booking
                    </p>
                </div>

                <!-- Heading -->
                <h1 class="display-5 fw-bold mb-4">
                    Welcome to
                    <span class="text-success">Makassar Luxury Hotel</span>
                </h1>

                <!-- Description -->
                <p class="text-muted mb-4">
                    Experience the best stay with luxurious rooms, world-class dining,
                    and top-notch amenities. Your perfect getaway awaits.
                </p>

                <!-- Buttons -->
                <div class="d-flex flex-column flex-md-row gap-3">
                    <a href="#" class="btn btn-success d-flex align-items-center justify-content-center gap-2">
                        Book Now <i class="fa-solid fa-caret-right"></i>
                    </a>
                    <a href="#" class="btn btn-outline-success d-flex align-items-center justify-content-center gap-2">
                        View Rooms <i class="fa-solid fa-caret-right"></i>
                    </a>
                </div>
            </div>
            <!-- Left Side END -->
        </div>
    </div>
</section>
<!-- Hero Section END -->