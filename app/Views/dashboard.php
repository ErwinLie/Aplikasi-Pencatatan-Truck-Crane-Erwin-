<!DOCTYPE html>
<html lang="en">
<body>
                
<!-- <div class="content-body"> -->

<div class="container-fluid mt-3">
    <div class="row">
        <!-- Wider Boxes -->
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Pemasukan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp <?= number_format($totalPemasukan, 0, ',', '.') ?></h2>
                        <p class="text-white mb-0">Total Pemasukan</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Pengeluaran</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></h2>
                        <p class="text-white mb-0">Total Pengeluaran</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Saldo</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp <?= number_format($saldo, 0, ',', '.') ?></h2>
                        <p class="text-white mb-0">Saldo</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-calculator"></i></span>
                </div>
            </div>
        </div>
    </div>

    


    <script>
        document.querySelector('.gradient-1').addEventListener('click', function() {
            $('#dateRangeModal').modal('show');
        });

        document.querySelector('#dateRangeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var startDate = document.querySelector('#startDate').value;
            var endDate = document.querySelector('#endDate').value;

            if (startDate && endDate) {
                // Redirect to the controller function with the selected date range
                window.location.href = "<?= base_url('dashboard/pemasukanByDateRange') ?>?startDate=" + startDate + "&endDate=" + endDate;
            }
        });
    </script>
    </body>
    </html>

