<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Supir</title>
    <link rel="stylesheet" href="path/to/your/styles.css">

    <style>
        .card {
            margin-left: -220px;
        }
    </style>
</head>
<body>
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Supir</h4>

                            <!-- Tampilkan Pesan Notifikasi -->
                            <?php if(session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if(session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <form action="<?= base_url('Home/aksi_t_supir') ?>" method="POST">

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='nama' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">No Hp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='no_hp' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='alamat' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nik</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='nik' required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
