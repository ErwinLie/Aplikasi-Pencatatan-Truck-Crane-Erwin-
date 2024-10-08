<main id="main" class="main">
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <!-- Form Laporan Pemasukan -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pemasukan</h4>
                            </div>
                            <form action="<?= base_url('home/laporan') ?>" method="POST" enctype="multipart/form-data">
                                <!-- Input Tanggal Awal -->
                                <div class="row mb-3">
                                    <label for="tanggalawal" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tanggalawal" name="tanggalawal" value="<?= isset($tanggalawal) ? $tanggalawal : '' ?>">
                                    </div>
                                </div>

                                <!-- Input Tanggal Akhir -->
                                <div class="row mb-3">
                                    <label for="tanggalakhir" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir" value="<?= isset($tanggalakhir) ? $tanggalakhir : '' ?>">
                                    </div>
                                </div>

                                <!-- Input Status -->
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="status" name="status">
                                            <option value=""></option>
                                            <option value="Term" <?= isset($status) && $status == 'Term' ? 'selected' : '' ?>>Term</option>
                                            <option value="Lunas" <?= isset($status) && $status == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tombol untuk Filter Data -->
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-filter-fill"> Filter</i>
                                    </button>
                                      <!-- Tombol untuk Print, PDF, Excel -->
                                <div class="text-center">
                                    <!-- Tombol Print -->
                                    <button type="submit" class="btn btn-secondary" formaction="<?= base_url('home/print_pemasukan') ?>">
                                        <i class="ri-printer-fill"> Print</i>
                                    </button>

                                    <!-- Tombol PDF -->
                                    <button type="submit" class="btn btn-danger" formaction="<?= base_url('home/print_pemasukan_pdf') ?>">
                                        <i class="ri-file-pdf-fill"> PDF</i>
                                    </button>

                                    <!-- Tombol Excel -->
                                    <button type="submit" class="btn btn-success" formaction="<?= base_url('home/print_pemasukan_excel') ?>">
                                        <i class="ri-file-excel-fill"> Excel</i>
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Display Filtered Data for Laporan Pemasukan -->
                <?php if (isset($erwin) && !empty($erwin)): ?>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Laporan Pemasukan</h4>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="3%">No</th>
                                                <th scope="col" width="7%">No Invoice</th>
                                                <th scope="col" width="8%">Tanggal</th>
                                                <th scope="col" width="10%">Truck Crane</th>
                                                <th scope="col" width="5%">Supir</th>
                                                <th scope="col" width="10%">Pelanggan</th>
                                                <th scope="col" width="17%">Pekerjaan</th>
                                                <th scope="col" width="17%">Lokasi</th>
                                                <th scope="col" width="8%">Total Jam</th>
                                                <th scope="col" width="7%">Status</th>
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
                                                    <td width="7%"><?= $wkwk->no_invoice ?></td>
                                                    <td width="8%"><?= $wkwk->tanggal ?></td>
                                                    <td width="10%"><?= $wkwk->plat_truck ?></td>
                                                    <td width="5%"><?= $wkwk->nama ?></td>
                                                    <td width="10%"><?= $wkwk->pelanggan ?></td>
                                                    <td width="17%"><?= $wkwk->pekerjaan ?></td>
                                                    <td width="17%"><?= $wkwk->lokasi ?></td>
                                                    <td width="8%"><?= $wkwk->total_jam ?></td>
                                                    <td width="7%"><?= $wkwk->status ?></td>
                                                    <td width="10%"><?= 'Rp ' . number_format($wkwk->harga, 0, ',', '.') ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="total-row">
                                                <td colspan="10" align="center">Total Harga:</td>
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
