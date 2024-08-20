<!DOCTYPE html>
<html lang="en">
<head>
    <?php $activepage = basename($_SERVER['REQUEST_URI']); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Pencatatan Pengeluaran</title>
    <link rel="stylesheet" href="<?= base_url('path/to/your/styles.css'); ?>">
    <style>
        .card {
            margin-left: -230px;
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
            max-width: 300px;
        }
        .total-container {
            text-align: right;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        .back-button {
            margin-left: 10px;
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
                            <div class="header-container">
                                <h4 class="card-title">Data Table</h4>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                            </div>
                            <div class="total-container">
                                Total Pengeluaran: <span id="totalHarga">0</span>
                            </div>
                            <div class="table-responsive">
                                
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
        <!-- <button class="btn btn-success" 
    data-toggle="modal" 
    data-target="#editModal" 
    data-id="<?= $wkwk->id_pengeluaran_tc ?>" 
    data-supir="<?= $wkwk->id_supir ?>" 
    data-truck_crane="<?= $wkwk->id_truck_crane ?>" 
    data-tanggal="<?= $wkwk->tanggal ?>" 
    data-deskripsi="<?= $wkwk->deskripsi ?>" 
    data-harga="<?= $wkwk->harga ?>" 
    data-kategori="<?= $wkwk->id_kategori ?>"
>Detail</button> -->


                                                    <a href="<?= base_url('Home/restore_data_edit_pengeluaran/'.$wkwk->id_pengeluaran_tc)?>">
                                                        <button class="btn btn-danger">Restore Edit Data</button>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="<?= base_url('Home/aksi_e_pengeluaran') ?>" method="POST">
                            <input type="hidden" id="id_pengeluaran_tc" name="id_pengeluaran_tc">
                            <div class="form-group">
                                <label for="supirEdit">Supir</label>
                                <select class="form-control" id="supirEdit" name="supir">
                                    <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                                    <?php foreach($supirs as $supir): ?>
                                        <option value="<?= $supir->id_supir ?>"><?= $supir->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="truck_craneEdit">Truck Crane</label>
                                <select class="form-control" id="truck_craneEdit" name="truck_crane">
                                    <optionvalue="<?= $truck_crane->id_truck_crane ?>"><?= $truck_crane->plat_truck ?></option>
                                    <?php foreach($truck_cranes as $truck_crane): ?>
                                        <option value="<?= $truck_crane->id_truck_crane ?>"><?= $truck_crane->plat_truck ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalEdit">Tanggal</label>
                                <input type="date" class="form-control" id="tanggalEdit" name="tanggal">
                            </div>
                            <div class="form-group">
                                <label for="deskripsiEdit">Deskripsi</label>
                                <textarea class="form-control" id="deskripsiEdit" name="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hargaEdit">Harga</label>
                                <input type="text" class="form-control" id="hargaEdit" name="harga">
                            </div>
                            <div class="form-group">
                                <label for="kategoriEdit">Kategori</label>
                                <select class="form-control" id="kategoriEdit" name="kategori">
                                    <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
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
    </div>

    <script src="<?= base_url('path/to/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('path/to/bootstrap.bundle.min.js'); ?>"></script>

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
          // from the 'harga' value and parse it as an integer
          const harga = parseInt(hargaElement.textContent.replace(/[^0-9]/g, ''));
            if (!isNaN(harga)) {
                totalHarga += harga;
            }
        });

        // Format total harga as Rupiah and update the display
        totalHargaElement.textContent = formatRupiah(totalHarga);
    }

    // Update total harga on page load
    updateTotalHarga();

    // Edit Modal: Populate form with selected row data
    $('#editModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const id_pengeluaran_tc = button.data('id');
        const supir = button.data('supir');
        const truck_crane = button.data('truck_crane');
        const tanggal = button.data('tanggal');
        const deskripsi = button.data('deskripsi');
        const harga = button.data('harga');
        const kategori = button.data('kategori');

        const modal = $(this);
        modal.find('#id_pengeluaran_tc').val(id_pengeluaran_tc);
        modal.find('#supirEdit').val(supir);
        modal.find('#truck_craneEdit').val(truck_crane);
        modal.find('#tanggalEdit').val(tanggal);
        modal.find('#deskripsiEdit').val(deskripsi);
        modal.find('#hargaEdit').val(harga);
        modal.find('#kategoriEdit').val(kategori);
    });

});
</script>
</body>
</html>

