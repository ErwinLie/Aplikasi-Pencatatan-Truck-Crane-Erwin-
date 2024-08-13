<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kategori</title>
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
                                <a href="<?= base_url('Home/t_kategori') ?>">
                                    <button class="btn btn-warning">+ Tambah</button>
                                </a>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no=1;
                                        foreach($erwin as $wkwk){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $wkwk->kategori?></td>
                                            <td>
                                                <button class="btn btn-success" 
                                                    data-toggle="modal" 
                                                    data-target="#editKategoriModal" 
                                                    data-id="<?= $wkwk->id_kategori ?>"
                                                    data-kategori="<?= $wkwk->kategori ?>"
                                                >Edit</button>
                                                <a href="<?= base_url('Home/hapus_kategori/'.$wkwk->id_kategori)?>">
                                                    <button class="btn btn-danger">Hapus</button>
                                                </a>
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

    <!-- Edit Kategori Modal -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editKategoriForm" action="<?= base_url('Home/aksi_e_kategori') ?>" method="POST">
                        <input type="hidden" id="id_kategori" name="id_kategori"> <!-- ID ini akan diisi oleh JavaScript -->
                        <div class="mb-3">
                            <label for="edit_kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path/to/your/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editKategoriModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id_kategori = button.data('id'); // Extract info from data-* attributes
                var kategori = button.data('kategori');

                // Update the modal's content
                var modal = $(this);
                modal.find('#id_kategori').val(id_kategori);
                modal.find('#edit_kategori').val(kategori);
            });
        });
    </script>
</body>
</html>
