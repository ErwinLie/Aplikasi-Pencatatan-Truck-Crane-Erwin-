<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pemasukan Truck Crane</title>
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
            width: 90%; /* Reduced width to make the table smaller */
            margin: auto; /* Center the table */
        }
        th, td {
            border: 1px solid black;
            padding: 3px; /* Reduced padding */
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

    <h3><?= 'Tanggal Awal: ' . $tanggalawal1 . ' - Tanggal Akhir: ' . $tanggalakhir1 ?></h3>
    <table border="1" align="center">
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
                    <td width="10%"><?= number_format($wkwk->harga, 0, ',', '.') ?></td>
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

    <script>
        // Script untuk melakukan pencetakan otomatis saat halaman dimuat
        window.onload = function() {
            window.print(); // Melakukan pencetakan otomatis
        }
    </script>

</body>
</html>
