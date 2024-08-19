<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $activepage = basename($_SERVER['REQUEST_URI']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pencatatan</title>
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
                                Total Pendapatan: <span id="totalHargaLunas">0</span>
                                <br>
                                Total Term: <span id="totalHargaTerm">0</span>
                            </div>
                            <div class="table-responsive">
                                
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Truck Crane</th>
                                            <th>Supir</th>
                                            <th>Pelanggan</th>
                                            <!-- <th>Pekerjaan</th>
                                            <th>Lokasi</th> -->
                                            <th>Tanggal</th>
                                            <!-- <th>Total Jam</th> -->
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>No Invoice</th>
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
                                            <td><?= $wkwk->plat_truck?></td>
                                            <td><?= $wkwk->nama?></td>
                                            <td><?= $wkwk->pelanggan?></td>
                                            <!-- <td><?= $wkwk->pekerjaan?></td>
                                            <td><?= $wkwk->lokasi?></td> -->
                                            <td><?= $wkwk->tanggal?></td>
                                            <!-- <td><?= $wkwk->total_jam?></td> -->
                                            <td class="harga" data-harga="<?= $wkwk->harga ?>"><?= number_format($wkwk->harga, 0, ',', '.') ?></td>

                                            <td><?= $wkwk->status?></td>
                                            <td><?= $wkwk->no_invoice?></td>
                                            <td>
                                                <?php if(session()->get('id_level')==1 || session()->get('id_level')==2) { ?>
                                                    <!-- <button class="btn btn-success" 
                                                        data-toggle="modal" 
                                                        data-target="#editModal" 
                                                        data-id="<?= $wkwk->id_pencatatan ?>"
                                                        data-id_truck_crane="<?= $wkwk->id_truck_crane ?>"
                                                        data-id_supir="<?= $wkwk->id_supir ?>"
                                                        data-pelanggan="<?= $wkwk->pelanggan ?>"
                                                        data-pekerjaan="<?= $wkwk->pekerjaan ?>"
                                                        data-lokasi="<?= $wkwk->lokasi ?>"
                                                        data-tanggal="<?= $wkwk->tanggal ?>"
                                                        data-totaljam="<?= $wkwk->total_jam ?>"
                                                        data-harga="<?= $wkwk->harga ?>"
                                                        data-status="<?= $wkwk->status ?>"
                                                        data-invoice="<?= $wkwk->no_invoice ?>"
                                                    >Detail</button>
                                                    <a href="<?= base_url('Home/hapus_restore_pencatatan/'.$wkwk->id_pencatatan)?>">
                                                        <button class="btn btn-danger">Hapus</button>
                                                    </a> -->

                                                    <a href="<?= base_url('Home/hapus_restore_pencatatan/'.$wkwk->id_pencatatan)?>">
                                                        <button class="btn btn-danger">Restore Data</button>
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

    <!-- New Modal for Tes (updated) -->
    <div class="modal fade" id="tesModal" tabindex="-1" aria-labelledby="tesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tesModalLabel">Pilih Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm" action="<?= base_url('Home/filter_pencatatan_by_status') ?>" method="POST">
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
                            <label for="supir">Supir</label>
                            <select class="form-control" id="supir" name="supir">
                                <option value="">Pilih</option>
                                <?php foreach($supirs as $supir): ?>
                                    <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pelanggan">Pelanggan</label>
                            <select class="form-control" id="pelanggan" name="pelanggan">
                                <option value="">Pilih</option>
                                <?php foreach($pelanggans as $pelanggan): ?>
                                    <option value="<?= $pelanggan->pelanggan ?>"><?= $pelanggan->pelanggan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Pilih</option>
                                <option value="Term">Term</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                        
                        <div class="form-group row">
                            <label for="awal2" class="col-sm-3 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="awal2" name="awal2" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="akhir2" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="akhir2" name="akhir2" required>
                            </div>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Pencatatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="<?= base_url('Home/aksi_e_pencatatan') ?>" method="POST">
                        <input type="hidden" id="editId" name="id_pencatatan">
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
                            <label for="editSupir">Supir</label>
                            <select class="form-control" id="editSupir" name="supir">
                                <option value="">Pilih</option>
                                <?php foreach($supirs as $supir): ?>
                                    <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editPelanggan">Pelanggan</label>
                            <input type="text" class="form-control" id="editPelanggan" name="pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="editPekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" id="editPekerjaan" name="pekerjaan">
                        </div>
                        <div class="form-group">
                            <label for="editLokasi">Lokasi</label>
                            <input type="text" class="form-control" id="editLokasi" name="lokasi">
                        </div>
                        <div class="form-group">
                            <label for="editTanggal">Tanggal</label>
                            <input type="date" class="form-control" id="editTanggal" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="editTotalJam">Total Jam</label>
                            <input type="text" class="form-control" id="editTotalJam" name="total_jam">
                        </div>
                        <div class="form-group">
                            <label for="editHarga">Harga</label>
                            <input type="text" class="form-control" id="editHarga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="editStatus" name="status">
                                <option value="">Pilih</option>
                                <option value="Term">Term</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editNoInvoice">No Invoice</label>
                            <input type="text" class="form-control" id="editNoInvoice" name="no_invoice">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
    const totalHargaLunasElement = document.getElementById('totalHargaLunas');
    const totalHargaTermElement = document.getElementById('totalHargaTerm');

    // Filter tabel
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

    // Fungsi untuk menghitung total harga
    function updateTotalHarga() {
        const rows = document.querySelectorAll('#tableBody tr');
        let totalHargaLunas = 0;
        let totalHargaTerm = 0;

        rows.forEach(row => {
            const hargaElement = row.querySelector('.harga');
            const statusElement = row.querySelector('td:nth-child(7)'); // Assuming status is the 7th column

            if (hargaElement && statusElement) {
                const harga = parseFloat(hargaElement.getAttribute('data-harga')) || 0;
                const status = statusElement.textContent.trim();

                if (status === 'Lunas') {
                    totalHargaLunas += harga;
                } else if (status === 'Term') {
                    totalHargaTerm += harga;
                }
            }
        });

        // Format totalHarga menjadi format Rupiah
        totalHargaLunasElement.textContent = formatRupiah(totalHargaLunas);
        totalHargaTermElement.textContent = formatRupiah(totalHargaTerm);
    }

    // Fungsi untuk memformat angka menjadi format Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }

    // Panggil fungsi updateTotalHarga saat halaman dimuat pertama kali
    updateTotalHarga();
});

    // Populate the edit modal with data when the "Detail" button is clicked
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var truck = button.data('truck');
            var supir = button.data('supir');
            var pelanggan = button.data('pelanggan');
            var pekerjaan = button.data('pekerjaan');
            var lokasi = button.data('lokasi');
            var tanggal = button.data('tanggal');
            var totalJam = button.data('totaljam');
            var harga = button.data('harga');
            var status = button.data('status');
            var invoice = button.data('invoice');

            // // Debugging dengan console.log
            // console.log({
            //     id, truck, supir, pelanggan, pekerjaan, lokasi, tanggal, totalJam, harga, status, invoice
            // });

            var modal = $(this);
        modal.find('#editId').val(id);
        modal.find('#editTruckCrane').val(button.data('id_truck_crane'));
        modal.find('#editSupir').val(button.data('id_supir'));
        modal.find('#editPelanggan').val(pelanggan);
        modal.find('#editPekerjaan').val(pekerjaan);
        modal.find('#editLokasi').val(lokasi);
        modal.find('#editTanggal').val(tanggal);
        modal.find('#editTotalJam').val(totalJam);
        modal.find('#editHarga').val(harga);
        modal.find('#editStatus').val(status);
        modal.find('#editNoInvoice').val(invoice);

        });
    });
</script>
</body>
</html>
