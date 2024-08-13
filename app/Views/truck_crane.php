<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Truck Crane</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        /* CSS tambahan untuk menggeser tabel ke kiri */
        .card {
            margin-left: -230px; /* Atur nilai ini sesuai kebutuhan Anda */
        }
    </style>
</head>
<body>
    <!--************
        Sidebar start
    *************-->
    <!-- Your sidebar code here -->

    <!--************
        Sidebar end
    *************-->

    <!--************
        Content body start
    *************-->
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
                                <a href="<?= base_url('Home/t_truck_crane') ?>">
                                    <button class="btn btn-warning">+ Tambah</button>
                                </a>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Merk Truk</th>
                                            <th>Plat Truk</th>
                                            <th>Merk Crane</th>
                                            <th>Kapasitas Crane</th>
                                            <th>Bobot Truk Crane</th>
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
                                            <td><?= $wkwk->merk_truck?></td>
                                            <td><?= $wkwk->plat_truck?></td>
                                            <td><?= $wkwk->merk_crane?></td>
                                            <td><?= $wkwk->kapasitas_crane?></td>
                                            <td><?= $wkwk->bobot_truck_crane?></td>
                                            <td>
                                                <?php if(session()->get('id_level') == 1 || session()->get('id_level') == 2) { ?>
                                                    <button class="btn btn-success" 
                                                        data-toggle="modal" 
                                                        data-target="#editModal" 
                                                        data-id="<?= $wkwk->id_truck_crane ?>"
                                                        data-merk_truck="<?= $wkwk->merk_truck ?>"
                                                        data-tipe_truck="<?= $wkwk->tipe_truck ?>"
                                                        data-plat_truck="<?= $wkwk->plat_truck ?>"
                                                        data-tahun_truck="<?= $wkwk->tahun_truck ?>"
                                                        data-merk_crane="<?= $wkwk->merk_crane ?>"
                                                        data-tipe_crane="<?= $wkwk->tipe_crane ?>"
                                                        data-kapasitas_crane="<?= $wkwk->kapasitas_crane ?>"
                                                        data-bobot_truck_crane="<?= $wkwk->bobot_truck_crane ?>"
                                                    >Edit</button>
                                                    <a href="<?= base_url('Home/hapus_truck_crane/'.$wkwk->id_truck_crane)?>">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Truck Crane</h5>
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="<?= base_url('Home/aksi_e_truck_crane') ?>" method="POST">
                        <input type="hidden" value="" id="id" name="id"> <!-- ID ini akan diisi oleh JavaScript -->
                        <div class="mb-3">
                            <label for="edit_merk_truck" class="form-label">Merk Truk</label>
                            <input type="text" class="form-control" value="" id="edit_merk_truck" name="merk_truck" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tipe_truck" class="form-label">Tipe Truk</label>
                            <input type="text" class="form-control" value="" id="edit_tipe_truck" name="tipe_truck" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_plat_truck" class="form-label">Plat Truk</label>
                            <input type="text" class="form-control" value="" id="edit_plat_truck" name="plat_truck" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tahun_truck" class="form-label">Tahun Truk</label>
                            <input type="text" class="form-control" value="" id="edit_tahun_truck" name="tahun_truck" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_merk_crane" class="form-label">Merk Crane</label>
                            <input type="text" class="form-control" value="" id="edit_merk_crane" name="merk_crane" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tipe_crane" class="form-label">Tipe Crane</label>
                            <input type="text" class="form-control" value="" id="edit_tipe_crane" name="tipe_crane" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kapasitas_crane" class="form-label">Kapasitas Crane</label>
                            <input type="text" class="form-control" value="" id="edit_kapasitas_crane" name="kapasitas_crane" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bobot_truck_crane" class="form-label">Bobot Truck Crane</label>
                            <input type="text" class="form-control" value="" id="edit_bobot_truck_crane" name="bobot_truck_crane" required>
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
                var merk_truck = button.data('merk_truck');
                var tipe_truck = button.data('tipe_truck');
                var plat_truck = button.data('plat_truck');
                var tahun_truck = button.data('tahun_truck');
                var merk_crane = button.data('merk_crane');
                var tipe_crane = button.data('tipe_crane');
                var kapasitas_crane = button.data('kapasitas_crane');
                var bobot_truck_crane = button.data('bobot_truck_crane');

                // Update the modal's content
                var modal = $(this);
                modal.find('#id').val(id);
                modal.find('#edit_merk_truck').val(merk_truck);
                modal.find('#edit_tipe_truck').val(tipe_truck);
                modal.find('#edit_plat_truck').val(plat_truck);
                modal.find('#edit_tahun_truck').val(tahun_truck);
                modal.find('#edit_merk_crane').val(merk_crane);
                modal.find('#edit_tipe_crane').val(tipe_crane);
                modal.find('#edit_kapasitas_crane').val(kapasitas_crane);
                modal.find('#edit_bobot_truck_crane').val(bobot_truck_crane);
            });
        });
    </script>
</body>
</html>
