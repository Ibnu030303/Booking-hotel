<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb mt-1">
            <li class="breadcrumb-item">
                <a href="" class="text-white-50">Home</a>
            </li>
            <li class="breadcrumb-item active text-white-50">Users</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <!-- Reports -->
                <div class="col-12">
                    <div class="card shadow-md p-3 d-flex overflow-x-auto">

                        <?php
                        // Fungsi untuk menampilkan pesan
                        function showAlert($type, $message)
                        {
                            echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
                                    $message
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
                        }

                        if (isset($_SESSION['success_message'])) {
                            showAlert('success', $_SESSION['success_message']);
                            unset($_SESSION['success_message']);
                        }

                        if (isset($_SESSION['error_message'])) {
                            showAlert('danger', $_SESSION['error_message']);
                            unset($_SESSION['error_message']);
                        }
                        ?>

                        <button class="btn btn-primary btn-sm mb-4 d-block align-self-end py-2 px-4" data-bs-toggle="modal" data-bs-target="#Modal">
                            Tambah
                        </button>

                        <table class="table table-striped table-hover mt-5 py-3 mb-4" id="dataTable">
                            <thead class="text-primary">
                                <tr>
                                    <th>NO</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT user_id, name, email, role FROM users";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    $no = 1; // Counter for row number
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$no}</td>
                                            <td>" . htmlspecialchars($row['user_id']) . "</td>
                                            <td>" . htmlspecialchars($row['name']) . "</td>
                                            <td>" . htmlspecialchars($row['email']) . "</td>
                                            <td>" . htmlspecialchars($row['role']) . "</td>
                                            <td>
                                                <a href='userController.php?action=edit&id=" . htmlspecialchars($row['user_id']) . "' class='btn btn-outline-warning btn-sm'>Edit</a>
                                                <form action='" . base_url('controllers/usersController.php') . "' method='POST' style='display:inline-block; margin-left:5px;'>
                                                    <input type='hidden' name='action' value='delete'>
                                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['user_id']) . "'>
                                                     <input type='hidden' name='user_id' value=" . htmlspecialchars($row['user_id']) . ">
                                                    <button type='submit' class='btn btn-outline-danger btn-sm' onclick='confirmDelete(event)'>Delete</button>
                                                </form>
                                            </td>
                                        </tr>";
                                        $no++;
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
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

<!-- Modal for adding new user -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg text-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="<?php echo base_url('controllers/usersController.php'); ?>" method="POST">
                    <input type="hidden" name="action" value="create">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <div class="mb-3">
                        <label for="passwordVerify" class="form-label">Password Verify</label>
                        <input type="password" class="form-control" id="passwordVerify" name="passwordVerify" required />
                        <div id="passwordError" class="text-danger mt-2" style="display: none; font-size: 0.9em;">
                            Password dan Password Verify tidak cocok!
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Timeout for alerts
    const ALERT_TIMEOUT = 1500;
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.classList.add('fade-out');
            setTimeout(() => alert.remove(), 500);
        });
    }, ALERT_TIMEOUT);

    document.querySelector('#addUserForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const passwordVerify = document.getElementById('passwordVerify').value;
        const passwordError = document.getElementById('passwordError');

        if (password !== passwordVerify) {
            e.preventDefault();
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    });

    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest("form").submit();
            }
        });
    }

    // Initialize DataTable
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

<style>
    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>s