<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bohotel/koneksi.php';

if (!isset($conn)) {
    die("Koneksi database tidak ditemukan.");
}

// Fetch bookings from the database
$query = "SELECT * FROM bookings";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $alertClass = strpos($message, 'Error') !== false ? 'error' : 'success';
}
?>

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-md p-3 d-flex overflow-x-auto">
                        <table class="table table-striped table-hover" id="dataTable">
                            <thead class="text-primary">
                                <tr>
                                    <th>NO</th>
                                    <th>ID</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>ID Kamar</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th>Durasi</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;  // Initialize counter for row number
                                while ($booking = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td>{$no}</td>  <!-- Display the row number -->
                                            <td>{$booking['id']}</td>
                                            <td>{$booking['customer_name']}</td>
                                            <td>{$booking['email']}</td>
                                            <td>{$booking['phone']}</td>
                                            <td>{$booking['room_id']}</td>
                                            <td>{$booking['check_in_date']}</td>
                                            <td>{$booking['check_out_date']}</td>
                                            <td>{$booking['duration']} malam</td>
                                            <td>Rp {$booking['total_price']}</td>
                                            <td>" . ucfirst($booking['status']) . "</td>
                                            <td>
                                                <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#Modal' 
                                                    data-id='{$booking['id']}' 
                                                    data-customer_name='{$booking['customer_name']}'
                                                    data-email='{$booking['email']}'
                                                    data-phone='{$booking['phone']}'
                                                    data-room_id='{$booking['room_id']}'
                                                    data-check_in_date='{$booking['check_in_date']}'
                                                    data-check_out_date='{$booking['check_out_date']}'
                                                    data-duration='{$booking['duration']}'
                                                    data-total_price='{$booking['total_price']}'
                                                    data-status='{$booking['status']}'>
                                                    Edit
                                                </button>
                                                <a href='controlers/delete_booking.php?id={$booking['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                          </tr>";
                                    $no++;  // Increment row number after each iteration
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Edit -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="controlers/edit_booking.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-customer_name" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="edit-customer_name" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="edit-phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-room_id" class="form-label">ID Kamar</label>
                        <input type="text" class="form-control" id="edit-room_id" name="room_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-check_in_date" class="form-label">Tanggal Check-In</label>
                        <input type="date" class="form-control" id="edit-check_in_date" name="check_in_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-check_out_date" class="form-label">Tanggal Check-Out</label>
                        <input type="date" class="form-control" id="edit-check_out_date" name="check_out_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-status" class="form-label">Status</label>
                        <select class="form-select" id="edit-status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari total _MAX_ data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    <?php if (isset($message)): ?>
        Swal.fire({
            title: 'Notification',
            text: "<?php echo $message; ?>",
            icon: '<?php echo $alertClass; ?>',
            showConfirmButton: false,
            timer: 5000  // Automatically close after 5 seconds
        }).then(() => {
            // Remove 'message' parameter from URL after the SweetAlert is shown
            const url = new URL(window.location);
            url.searchParams.delete('message');  // Delete the 'message' parameter
            window.history.replaceState({}, document.title, url.toString());  // Update the URL without refreshing the page
        });
    <?php endif; ?>

    // Load data to modal on edit button click
    const editModal = document.getElementById('Modal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const customerName = button.getAttribute('data-customer_name');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const roomId = button.getAttribute('data-room_id');
        const checkInDate = button.getAttribute('data-check_in_date');
        const checkOutDate = button.getAttribute('data-check_out_date');
        const status = button.getAttribute('data-status');

        // Populate modal fields
        editModal.querySelector('#edit-id').value = id;
        editModal.querySelector('#edit-customer_name').value = customerName;
        editModal.querySelector('#edit-email').value = email;
        editModal.querySelector('#edit-phone').value = phone;
        editModal.querySelector('#edit-room_id').value = roomId;
        editModal.querySelector('#edit-check_in_date').value = checkInDate;
        editModal.querySelector('#edit-check_out_date').value = checkOutDate;
        editModal.querySelector('#edit-status').value = status;
    });

</script>
