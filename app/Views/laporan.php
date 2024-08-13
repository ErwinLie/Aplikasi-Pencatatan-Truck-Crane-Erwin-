<main id="main" class="main">
    <!-- Existing sections for Laporan PDF and Laporan Excel -->

    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <!-- First card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pemasukan Print</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pemasukan')?>"
                                            method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal1" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal1" name="tanggalawal1">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir1" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir1" name="tanggalakhir1">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir1" class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">
                                                    <select  type="select" class="form-control" name="status1">
               <option></option>
               <option value="Term">Term</option>
               <option value="Lunas">Lunas</option>
             </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-secondary">
                                                        <i class="ri-printer-fill"> Print</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pemasukan PDF</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pemasukan_pdf')?>"
                                            method="Post" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal2" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal2" name="tanggalawal2">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir2" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir2" name="tanggalakhir2">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="status2" class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">
                                                    <select  type="select" class="form-control" name="status2">
               <option></option>
               <option value="Term">Term</option>
               <option value="Lunas">Lunas</option>
             </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ri-printer-fill"> PDF</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pemasukan Excel</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pemasukan_excel')?>"
                                            method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal3" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal3" name="tanggalawal3">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir3" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir3" name="tanggalakhir3">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir1" class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">
                                                    <select  type="select" class="form-control" name="status3">
               <option></option>
               <option value="Term">Term</option>
               <option value="Lunas">Lunas</option>
             </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="ri-printer-fill"> EXCEL</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional sections -->
            <div class="row">
                <!-- Third card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pengeluaran Print</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pengeluaran')?>"
                                            method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal4" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal4" name="tanggalawal4">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir4" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir4" name="tanggalakhir4">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="kategori" name="kategori4">
                                                            <option value="">Pilih</option>
                                                            <?php foreach($kategoris as $kategori): ?>
                                                                <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-secondary">
                                                        <i class="ri-printer-fill"> Print</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fourth card -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pengeluaran PDF</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pengeluaran_pdf')?>"
                                            method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal5" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal5" name="tanggalawal5">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir5" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir5" name="tanggalakhir5">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="kategori" name="kategori5">
                                                            <option value="">Pilih</option>
                                                            <?php foreach($kategoris as $kategori): ?>
                                                                <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="ri-printer-fill"> PDF</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Laporan Pengeluaran Excel</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                            <form action="<?= base_url('home/print_pengeluaran_excel')?>"
                                            method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="tanggalawal6" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalawal6" name="tanggalawal6">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="tanggalakhir6" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" id="tanggalakhir6" name="tanggalakhir6">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row mb-3">
                                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="kategori" name="kategori6">
                                                            <option value="">Pilih</option>
                                                            <?php foreach($kategoris as $kategori): ?>
                                                                <option value="<?= $kategori->id_kategori ?>"><?= $kategori->kategori ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="ri-printer-fill"> Excel</i>
                                                    </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
