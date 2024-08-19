<main id="main" class="main">
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <!-- Form Laporan Pengeluaran -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pengeluaran</h4>
                            </div>
                            <form action="<?= base_url('home/laporan_pengeluaran') ?>" method="POST" enctype="multipart/form-data">
                                <!-- Input Tanggal Awal -->
                                <div class="row mb-3">
                                    <label for="tanggalawal2" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tanggalawal2" name="tanggalawal2" value="<?= isset($tanggalawal2) ? $tanggalawal2 : '' ?>">
                                    </div>
                                </div>

                                <!-- Input Tanggal Akhir -->
                                <div class="row mb-3">
                                    <label for="tanggalakhir2" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tanggalakhir2" name="tanggalakhir2" value="<?= isset($tanggalakhir2) ? $tanggalakhir2 : '' ?>">
                                    </div>
                                </div>

                                <!-- Input Kategori -->
                                <div class="row mb-3">
                                    <label for="kategori2" class="col-sm-4 col-form-label">Kategori</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="kategori2" name="kategori2">
                                            <option value=""></option>
                                            <?php foreach($kategoris as $kategori): ?>
                                                <option value="<?= $kategori->id_kategori ?>" <?= isset($kategori2) && $kategori2 == $kategori->id_kategori ? 'selected' : '' ?>><?= $kategori->kategori ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tombol untuk Filter Data -->
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-filter-fill"> Filter</i>
                                    </button>
                                </div>

                                <!-- Tombol untuk Print, PDF, Excel -->
                                <div class="text-center">
                                    <!-- Tombol Print -->
                                    <button type="submit" class="btn btn-secondary" formaction="<?= base_url('home/print_pengeluaran') ?>">
                                        <i class="ri-printer-fill"> Print</i>
                                    </button>

                                    <!-- Tombol PDF -->
                                    <button type="submit" class="btn btn-danger" formaction="<?= base_url('home/print_pengeluaran_pdf') ?>">
                                        <i class="ri-file-pdf-fill"> PDF</i>
                                    </button>

                                    <!-- Tombol Excel -->
                                    <button type="submit" class="btn btn-success" formaction="<?= base_url('home/print_pengeluaran_excel') ?>">
                                        <i class="ri-file-excel-fill"> Excel</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Display Filtered Data for Laporan Pengeluaran -->
                <?php if (isset($erwin) && !empty($erwin)): ?>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Laporan Pengeluaran</h4>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="3%">No</th>
                                                <th scope="col" width="7%">Tanggal</th>
                                                <th scope="col" width="10%">Supir</th>
                                                <th scope="col" width="10%">Truck Crane</th>
                                                <th scope="col" width="20%">Deskripsi</th>
                                                <th scope="col" width="10%">Kategori</th>
                                                <th scope="col" width="10%">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $total_harga = 0;
                                            foreach ($erwin as $wkwk) {
                                                $total_harga += $wkwk->harga;
                                                ?>
                                                <tr>
                                                    <td width="3%" align="center"><?= $no++ ?></td>
                                                    <td width="7%"><?= $wkwk->tanggal ?></td>
                                                    <td width="10%"><?= $wkwk->nama ?></td>
                                                    <td width="10%"><?= $wkwk->plat_truck ?></td>
                                                    <td width="20%"><?= $wkwk->deskripsi ?></td>
                                                    <td width="10%"><?= $wkwk->kategori ?></td>
                                                    <td width="10%"><?= 'Rp ' . number_format($wkwk->harga, 0, ',', '.') ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="total-row">
                                                <td colspan="6" align="center">Total Harga:</td>
                                                <td><?= 'Rp ' . number_format($total_harga, 0, ',', '.') ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> <!-- End of Container -->
        </div> <!-- End of Container -->
    </section>
</main>
