<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Supir</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        .card {
            margin-left: -230px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <!-- Sidebar start -->
    <!-- Your sidebar code here -->
    <!-- Sidebar end -->

    <!-- Content body start -->
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Table</h4>
                            <div class="table-responsive">
                                <a href="<?= base_url('Home/t_supir') ?>">
                                    <button class="btn btn-warning">+ Tambah</button>
                                </a>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach ($erwin as $wkwk) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $wkwk->nama?></td>
                                            <td><?= $wkwk->nik?></td>
                                            <td><?= $wkwk->no_hp?></td>
                                            <td><?= $wkwk->alamat?></td>
                                            <td>
                                                <?php if(session()->get('id_level') == 1 || session()->get('id_level') == 2) { ?>
                                                    <button class="btn btn-success" 
                                                        data-toggle="modal" 
                                                        data-target="#editModal" 
                                                        data-id="<?= $wkwk->id_supir ?>"
                                                        data-nama="<?= $wkwk->nama ?>"
                                                        data-nik="<?= $wkwk->nik ?>"
                                                        data-no_hp="<?= $wkwk->no_hp ?>"
                                                        data-alamat="<?= $wkwk->alamat ?>"
                                                    >Edit</button>
                                                    <a href="<?= base_url('Home/hapus_supir/'.$wkwk->id_supir)?>">
                                                        <button class="btn btn-danger">Hapus</button>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Supir</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="<?= base_url('Home/aksi_e_supir') ?>" method="POST">
                        <input type="hidden" value="" id="id" name="id_supir"> <!-- ID ini akan diisi oleh JavaScript -->
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" value="" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" value="" id="edit_nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_no_hp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" value="" id="edit_no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" value="" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your JavaScript files here -->
    <script src="path/to/your/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path/to/your/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var nama = button.data('nama');
                var nik = button.data('nik');
                var no_hp = button.data('no_hp');
                var alamat = button.data('alamat');

                // Update the modal's content
                var modal = $(this);
                modal.find('#id').val(id);
                modal.find('#edit_nama').val(nama);
                modal.find('#edit_nik').val(nik);
                modal.find('#edit_no_hp').val(no_hp);
                modal.find('#edit_alamat').val(alamat);
            });
        });
    </script>
</body>
</html>
