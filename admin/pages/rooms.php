<?php
// Include database connection file
include '../koneksi.php';

// Fetch rooms from the database
$query = "SELECT * FROM rooms";
$result = mysqli_query($conn, $query);

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $alertClass = strpos($message, 'Error') !== false ? 'error' : 'success';
}
?>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <!-- Reports -->
                <div class="col-12">
                    <div class="card shadow-md p-3 d-flex overflow-x-auto">
                        <button class="btn btn-primary btn-sm mb-3 d-block align-self-end py-2 px-4"
                            data-bs-toggle="modal" data-bs-target="#ModalTambah">
                            Tambah
                        </button>
                        <table class="table table-striped table-hover" id="dataTable">
                            <thead class="text-primary">
                                <tr>
                                    <th>Gambar</th>
                                    <th>Tipe Kamar</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Ketersediaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Loop through rooms and display them
                                while ($room = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td><img src='../assets/uploads/{$room['image']}' alt='{$room['room_type']}' width='100'></td>
                                            <td>{$room['room_type']}</td>
                                            <td>{$room['description']}</td>
                                            <td>Rp {$room['price']}</td>
                                            <td>" . ($room['availability'] == 1 ? 'Available' : 'Not Available') . "</td>
                                            <td>
                                                <!-- Trigger Modal for Edit -->
                                                <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#Modal' 
                                                    data-id='{$room['id']}' 
                                                    data-room_type='{$room['room_type']}'
                                                    data-description='{$room['description']}'
                                                    data-price='{$room['price']}'
                                                    data-availability='{$room['availability']}'
                                                    data-image='{$room['image']}'>
                                                    Edit
                                                </button>
                                                <a href='controlers/delete_room.php?id={$room['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Reports -->
            </div>
        </div>
        <!-- End Left side columns -->
    </div>
</section>

<!-- Modal for adding a new room -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kamar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="controlers/add_room.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Tipe Kamar</label>
                        <input type="text" class="form-control" name="room_type" placeholder="Nama Tipe Kamar" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Deskripsi Kamar" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="price" placeholder="Harga Kamar" required />
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Ketersediaan</label>
                        <select class="form-control" name="availability" required>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing a room -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kamar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="roomForm" action="controlers/update_room.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="room_id" />
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Tipe Kamar</label>
                        <input type="text" class="form-control" name="room_type" id="room_type" placeholder="Nama Tipe Kamar" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Deskripsi Kamar" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Harga Kamar" required />
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Ketersediaan</label>
                        <select class="form-control" name="availability" id="availability" required>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="image" />
                        <input type="hidden" name="current_image" id="current_image" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Populate modal with room data when "Edit" button is clicked
    $('#Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var roomId = button.data('id');
        var roomType = button.data('room_type');
        var description = button.data('description');
        var price = button.data('price');
        var availability = button.data('availability');
        var image = button.data('image');

        // Update the modal's content
        var modal = $(this);
        modal.find('.modal-title').text('Edit Kamar');
        modal.find('#room_id').val(roomId);
        modal.find('#room_type').val(roomType);
        modal.find('#description').val(description);
        modal.find('#price').val(price);
        modal.find('#availability').val(availability);
        modal.find('#current_image').val(image);
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

    // DataTable initialization
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
</script>
