<!-- laporan_pdf_pencatatan_pengeluaran.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pencatatan Pengeluaran</title>
    <!-- Letakkan pustaka TCPDF atau autoload di sini jika diperlukan -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .header-img {
            width: 100%;
            max-width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Menampilkan gambar di atas -->
    <div align="center">
        <img src="<?= base_url('images/img/header cv.png') ?>" alt="Header Image" class="header-img">
    </div>

    <h3><?= 'Tanggal Awal: ' . $tanggalawal5 . ' - Tanggal Akhir: ' . $tanggalakhir5 ?></h3>
    <table border="1" align="center" width="100%">
        <thead>
            <tr>
                <th scope="col" width="5%">No</th>
                <th scope="col" width="15%">Tanggal</th>
                <th scope="col" width="15%">Supir</th>
                <th scope="col" width="15%">Truck Crane</th>
                <th scope="col" width="20%">Deskripsi</th>
                <th scope="col" width="15%">Kategori</th>
                <th scope="col" width="15%">Harga</th>
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
                    <td width="5%" align="center"><?= $no++ ?></td>
                    <td width="15%"><?= $wkwk->tanggal ?></td>
                    <td width="15%"><?= $wkwk->nama ?></td>
                    <td width="15%"><?= $wkwk->plat_truck ?></td>
                    <td width="20%"><?= $wkwk->deskripsi ?></td>
                    <td width="15%"><?= $wkwk->kategori ?></td>
                    <td width="15%"><?= number_format($wkwk->harga, 0, ',', '.') ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" align="center">Total Harga:</td>
                <td colspan="1"><?= 'Rp ' . number_format($total_harga, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
