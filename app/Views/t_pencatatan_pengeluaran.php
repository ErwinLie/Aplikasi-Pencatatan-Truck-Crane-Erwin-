<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pencatatan Pengeluaran</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
   
    <style>
        /* CSS tambahan untuk menggeser tabel ke kiri */
        .card {
            margin-left: -220px; /* Atur nilai ini sesuai kebutuhan Anda */
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
                                <!-- General Form Elements -->
                                <form action="<?= base_url('Home/aksi_t_pencatatan_pengeluaran')?>" method="POST">

                                <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Supir</label>
                                        <div class="col-sm-10">
                                        <select name="supir" class="form-control" id="supir">
                            <option value="">Pilih</option>
                            <?php foreach ($s as $key) { ?>
                                <option value="<?= $key->id_supir ?>"><?= $key->nama ?></option>
                            <?php } ?>
                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Truck Crane</label>
                                        <div class="col-sm-10">
                                        <select name="truck_crane" class="form-control" id="truck_crane">
                            <option value="">Pilih</option>
                            <?php foreach ($t as $key) { ?>
                                <option value="<?= $key->id_truck_crane ?>"><?= $key->plat_truck ?></option>
                            <?php } ?>
                        </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name='tanggal'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='deskripsi'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='harga'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-10">
                                             <select  type="select" class="form-control" name="kategori">
               <option>Pilih</option>

               <?php foreach ($k as $key) { ?>
                                <option value="<?= $key->id_kategori ?>"><?= $key->kategori ?></option>
                            <?php } ?>
             </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <!-- End General Form Elements -->