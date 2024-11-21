<?php
include '../koneksi.php';
?>
        <section class="section dashboard">
          <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
              <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-4">
                  <div class="card info-card sales-card shadow-md">
                    <div class="card-body">
                      <h5 class="card-title">Sales</h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="lni lni-cart"></i>
                        </div>
                        <div class="ps-3">
                          <h6>145</h6>
                          <span class="text-success small pt-1 fw-bold">12%</span>
                          <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-4">
                  <div class="card info-card revenue-card shadow-md">
                    <div class="card-body">
                      <h5 class="card-title">Revenue</h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="lni lni-dollar"></i>
                        </div>
                        <div class="ps-3">
                          <h6>$3,264</h6>
                          <span class="text-success small pt-1 fw-bold">8%</span>
                          <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-md-4">
                  <div class="card info-card customers-card shadow-md">
                    <div class="card-body">
                      <h5 class="card-title">Customers</h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="lni lni-users"></i>
                        </div>
                        <div class="ps-3">
                          <h6>1244</h6>
                          <span class="text-danger small pt-1 fw-bold">12%</span>
                          <span class="text-muted small pt-2 ps-1">decrease</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Customers Card -->

                <!-- Reports -->
                <div class="col-12">
                  <div class="card shadow-md">
                    <div class="card-body">
                      <h5 class="card-title">Reports</h5>

                      <!-- Line Chart -->
                      <div id="reportsChart"></div>

                      <!-- End Line Chart -->
                    </div>
                  </div>
                </div>
                <!-- End Reports -->
              </div>
            </div>
            <!-- End Left side columns -->
          </div>
        </section>
