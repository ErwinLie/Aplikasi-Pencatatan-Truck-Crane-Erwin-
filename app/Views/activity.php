<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        .card {
            margin-left: -230px; /* Atur nilai ini sesuai kebutuhan Anda */
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
                                <a href="<?= base_url('Home/t_user') ?>">
                                    <button class="btn btn-warning">+ Tambah</button>
                                </a>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Activity</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($erwin as $wkwk){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $wkwk->username ?></td>
                                            <td><?= $wkwk->activity ?></td>
                                            <td><?= $wkwk->timestamp ?></td>
                                            <td>
                                                <a href="<?= base_url('Home/hapus_activity/'.$wkwk->id_activity)?>">
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