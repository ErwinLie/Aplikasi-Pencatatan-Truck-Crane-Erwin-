<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pemasukan by Month</title>
</head>
<body>
    <div class="container mt-5">
        <h3>Pemasukan for Selected Month</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Pekerjaan</th>
                    <th>Lokasi</th>
                    <th>Total Jam</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if($pemasukanByMonth): ?>
                    <?php $i = 1; foreach($pemasukanByMonth as $row): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['no_invoice'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['pelanggan'] ?></td>
                            <td><?= $row['pekerjaan'] ?></td>
                            <td><?= $row['lokasi'] ?></td>
                            <td><?= $row['total_jam'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No data found for this month</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
