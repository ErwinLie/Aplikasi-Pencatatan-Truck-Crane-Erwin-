<!DOCTYPE html>
<html lang="en">
<head>
<?php
    $activepage = basename($_SERVER['REQUEST_URI']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pencatatan Pengeluaran</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <style>
        .card {
            margin-left: -230px; /* Adjust as needed */
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-container h4 {
            margin: 0;
        }
        .header-container input {
            max-width: 300px; /* Adjust width as needed */
        }
        .total-container {
            text-align: right;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .button-group {
            display: flex;
            gap: 10px; /* Adjust gap as needed */
        }
        .back-button {
            margin-left: 10px;
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
                            <div class="header-container">
                                <h4 class="card-title">Data Table</h4>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                            </div>
                            <div class="total-container">
                                Total Pengeluaran: <span id="totalHarga">0</span>
                            </div>
                            <div class="table-responsive">
                                <div class="button-group">
                                    <a href="<?= base_url('Home/t_pencatatan_pengeluaran') ?>">
                                        <button class="btn btn-warning">+ Tambah</button>
                                    </a>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#filterModal">Pilih</button>

                                    <?php if($activepage === 'filter_pencatatan_pengeluaran') { ?>
                                    <a href="<?= base_url('Home/pencatatan_pengeluaran') ?>" class="btn btn-secondary back-button">Kembali</a>
                                    <?php }?>
                                </div>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Supir</th>
                                            <th>Truck Crane</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <?php 
                                        $no=1;
                                        foreach($erwin as $wkwk){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $wkwk->nama?></td>
                                            <td><?= $wkwk->plat_truck?></td>
                                            <td><?= $wkwk->tanggal?></td>
                                            <td><?= $wkwk->deskripsi?></td>
                                            <td class="harga"><?= number_format($wkwk->harga, 0, ',', '.')?></td>
                                            <td><?= $wkwk->kategori?></td>
                                            <td>
                                                <?php if(session()->get('id_level')==1 || session()->get('id_level')==2) { ?>
                                                    <button class="btn btn-success" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editModal" 
                                                    data-id="<?= $wkwk->id_pengeluaran_tc ?>" 
                                                    data-supir="<?= $wkwk->id_supir ?>" 
                                                    data-truck_crane="<?= $wkwk->id_truck_crane ?>" 
                                                    data-tanggal="<?= $wkwk->tanggal ?>" 
                                                    data-deskripsi="<?= $wkwk->deskripsi ?>" 
                                                    data-harga="<?= $wkwk->harga ?>" 
                                                    data-kategori="<?= $wkwk->id_kategori ?>"
                                                    >Detail</button>

                                                    <a href="<?= base_url('Home/hapus_pengeluaran/'.$wkwk->id_pengeluaran_tc)?>">
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

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Pilih Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" action="<?= base_url('Home/filter_pencatatan_pengeluaran') ?>" method="POST">
                        <div class="form-group">
                            <label for="supir">Supir</label>
                            <select class="form-control" id="supir" name="supir">
                                <option value="">Pilih</option>
                                <?php foreach($supirs as $supir): ?>
                                    <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="truck_crane">Truck Crane</label>
                            <select class="form-control" id="truck_crane" name="truck_crane">
                                <option value="">Pilih</option>
                                <?php foreach($truck_cranes as $truck_crane): ?>
                                    <option value="<?= $truck_crane->id_truck_crane ?>"><?= $truck_crane->plat_truck ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="awal2">Tanggal Awal</label>
                            <input type="date" class="form-control" id="awal2" name="awal2" required>
                        </div>
                        <div class="form-group">
                            <label for="akhir2">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="akhir2" name="akhir2" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">Pilih</option>
                                <?php foreach($kategoris as $kategori): ?>
                                    <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="<?= base_url('Home/aksi_e_pengeluaran') ?>" method="POST">
                    <input type="hidden" id="editId" name="id_pengeluaran_tc">
                    <div class="form-group">
                        <label for="editSupir">Supir</label>
                        <select class="form-control" id="editSupir" name="supir">
                            <option value="">Pilih</option>
                            <?php foreach($supirs as $supir): ?>
                                <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTruckCrane">Truck Crane</label>
                        <select class="form-control" id="editTruckCrane" name="truck_crane">
                            <option value="">Pilih</option>
                            <?php foreach($truck_cranes as $truck_crane): ?>
                                <option value="<?= $truck_crane->id_truck_crane ?>"><?= $truck_crane->plat_truck ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTanggal">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="editDeskripsi">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editHarga">Harga</label>
                        <input type="text" class="form-control" id="editHarga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="editKategori">Kategori</label>
                        <select class="form-control" id="editKategori" name="kategori">
                            <option value="">Pilih</option>
                            <?php foreach($kategoris as $kategori): ?>
                                <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="path/to/your/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="path/to/your/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const totalHargaElement = document.getElementById('totalHarga');

            // Function to format number as Indonesian Rupiah
            function formatRupiah(value) {
                return 'Rp ' + value.toLocaleString('id-ID', { minimumFractionDigits: 0 });
            }
            
            // Filter table
            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toUpperCase();
                const rows = document.querySelectorAll('#tableBody tr');

                rows.forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    let isVisible = false;

                    for (let i = 0; i < cells.length; i++) {
                        if (cells[i].textContent.toUpperCase().includes(filter)) {
                            isVisible = true;
                            break;
                        }
                    }

                    row.style.display = isVisible ? '' : 'none';
                });

                updateTotalHarga();
            });

            // Function to update total harga
             // Function to update total harga
    function updateTotalHarga() {
        const hargaElements = document.querySelectorAll('#tableBody .harga');
        let totalHarga = 0;

        hargaElements.forEach(hargaElement => {
            // Remove non-numeric characters (except for decimal point)
            const hargaText = hargaElement.textContent.replace(/[^0-9]/g, '');
            const harga = parseFloat(hargaText) || 0;
            totalHarga += harga;
        });

        totalHargaElement.textContent = formatRupiah(totalHarga);
    }

     // Call updateTotalHarga on page load
     updateTotalHarga();
});

        $(document).ready(function() {
         $('#editModal').on('show.bs.modal', function (event) {
            // console.log('Edit modal is about to be shown');
            var button = $(event.relatedTarget);
            // console.log(button.data());

            var id = button.data('id');
            var supir = button.data('supir');
            var truck_crane = button.data('truck_crane');
            var tanggal = button.data('tanggal');
            var deskripsi = button.data('deskripsi');
            var harga = button.data('harga');
            var kategori = button.data('kategori');

            
            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editSupir').val(supir);
            modal.find('#editTruckCrane').val(truck_crane);
            modal.find('#editTanggal').val(tanggal);
            modal.find('#editDeskripsi').val(deskripsi);
            modal.find('#editHarga').val(harga);
            modal.find('#editKategori').val(kategori);

        //     console.log('Modal fields set', {
        //     id, supir, truck_crane, tanggal, deskripsi, harga, kategori
        // });
        });

         // Function to format number as Indonesian Rupiah
         function formatRupiah(value) {
                return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
            }
    });

    </script>
</body>
</html>
