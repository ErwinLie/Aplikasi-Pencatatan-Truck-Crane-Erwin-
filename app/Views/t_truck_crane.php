<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pencatatan</title>
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
                                <form action="<?= base_url('Home/aksi_t_truck_crane')?>" method="POST">

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Merk Truck</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='merk_truck'>
                                        </div>
                                     </div>

                                      <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tipe Truck</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='tipe_truck'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Plat Truck</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='plat_truck'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tahun Truck</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='tahun_truck'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Merk Crane</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='merk_crane'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tipe Crane</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='tipe_crane'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Kapasitas Crane</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='kapasitas_crane'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-2 col-form-label">Bobot Truck Crane</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name='bobot_truck_crane'>
                                        </div>
                                    </div>
                                    
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <!-- End General Form Elements -->