<?php include 'koneksi.php'; ?>

<?php
// Menangani parameter room_id
if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    // Pastikan room_id adalah angka
    if (!is_numeric($room_id)) {
        echo "<p>ID kamar tidak valid.</p>";
        exit;
    }

    $query = "SELECT * FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "<p>Kamar tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p>Parameter ID kamar tidak ditemukan.</p>";
    exit;
}
?>

<?php include 'layouts/header.php'; ?>

<!-- Modal for success -->
<?php if (isset($_GET['booking_status']) && $_GET['booking_status'] == 'success'): ?>
    <!-- Modal -->
    <div
        class="modal fade"
        id="successModal"
        tabindex="-1"
        aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle-fill me-2"></i> Pemesanan Berhasil
                    </h5>
                </div>
                <div class="modal-body">
                    <img
                        src="<?php echo base_url('assets/img/anim.gif'); ?>"
                        alt="Success"
                        class="img-fluid mb-3"
                        style="max-width: 150px" />
                    <h5>Nama: <span class="text-success"><?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '-'; ?></span></h5>
                    <h5>Tanggal Check-in: <?php echo isset($_GET['check_in']) ? htmlspecialchars($_GET['check_in']) : '-'; ?></h5>
                    <h5>Tanggal Check-out: <?php echo isset($_GET['check_out']) ? htmlspecialchars($_GET['check_out']) : '-'; ?></h5>
                    <h5>Durasi Menginap: <?php echo isset($_GET['duration']) ? htmlspecialchars($_GET['duration']) : '-'; ?></h5>
                    <h5>Total Biaya: <span class="text-danger"><?php echo isset($_GET['total_price']) ? number_format($_GET['total_price'], 0, ',', '.') : '-'; ?></span></h5>
                </div>
                <div class="text-center mb-4">
                    <a href="index.php" class="btn btn-dark">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Modal for error -->
<?php if (isset($_GET['booking_status']) && $_GET['booking_status'] == 'error'): ?>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal error-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel"><i class="bi bi-x-circle-fill"></i> Terjadi Kesalahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Terjadi kesalahan saat memproses pemesanan.'; ?>
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-danger">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<section class="py-5">
    <header class="header text-center py-5">
        <div class="container">
            <h1>Pemesanan Kamar: <?php echo htmlspecialchars($room['room_type']); ?></h1>
            <p>Harga per malam: <strong>Rp<?php echo number_format($room['price'], 0, ',', '.'); ?></strong></p>
        </div>
    </header>

    <main>
        <div class="container py-5">
            <form action="proses_booking.php" method="POST" id="bookingForm">
                <input type="hidden" name="room" value="<?php echo htmlspecialchars($room['id']); ?>">
                <input type="hidden" name="price" id="price" value="<?php echo htmlspecialchars($room['price']); ?>">
                <input type="hidden" name="total_price" id="totalPrice">

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="mb-3">
                    <label for="check_in" class="form-label">Tanggal Check-In</label>
                    <input type="date" class="form-control" id="check_in" name="check_in" required>
                </div>

                <div class="mb-3">
                    <label for="check_out" class="form-label">Tanggal Check-Out</label>
                    <input type="date" class="form-control" id="check_out" name="check_out" required>
                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Durasi Menginap (hari)</label>
                    <input type="text" class="form-control" id="duration" name="duration" readonly>
                </div>

                <div class="mb-3">
                    <label for="total_price_display" class="form-label">Total Biaya</label>
                    <input type="text" class="form-control" id="total_price_display" readonly>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Lanjutkan Pemesanan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </main>
</section>

<script>
    window.onload = function() {
        // Menampilkan modal berdasarkan status booking
        <?php if (isset($_GET['booking_status']) && $_GET['booking_status'] == 'success'): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php elseif (isset($_GET['booking_status']) && $_GET['booking_status'] == 'error'): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        <?php endif; ?>

        // Hapus query string setelah modal ditampilkan
        if (window.location.search.includes('booking_status=success')) {
            const newURL = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, newURL);
        }

        // Set default tanggal untuk check-in dan check-out
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('check_in').value = today;
        document.getElementById('check_in').setAttribute('min', today);
        document.getElementById('check_out').setAttribute('min', today);
    };

    // Update tanggal minimal check-out saat check-in berubah
    document.getElementById('check_in').addEventListener('change', function() {
        const checkInDate = this.value;
        document.getElementById('check_out').setAttribute('min', checkInDate);
    });

    // Kalkulasi durasi menginap dan total harga
    document.getElementById('check_out').addEventListener('change', function() {
        const checkInDate = new Date(document.getElementById('check_in').value);
        const checkOutDate = new Date(this.value);
        const pricePerNight = parseFloat(document.getElementById('price').value);

        if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
            const duration = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
            const totalPrice = duration * pricePerNight;

            document.getElementById('duration').value = duration;
            document.getElementById('total_price_display').value = 'Rp' + totalPrice.toLocaleString();
            document.getElementById('totalPrice').value = totalPrice;
        }
    });
</script>

<?php include 'layouts/footer.php'; ?>