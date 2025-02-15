<?php
include 'koneksi.php';

// Mengambil total jumlah karyawan dari tabel karyawan
$totalKaryawan = $conn->query("SELECT COUNT(*) AS total FROM karyawan")->fetch_assoc()['total'];

// Karena departemen disimpan sebagai ENUM di tabel karyawan, kita gunakan array statis untuk opsi departemen
$departemenOptions = ['HRD', 'Keuangan', 'IT', 'Pemasaran', 'Produksi'];
// Total departemen dihitung berdasarkan jumlah opsi yang ada
$totalDepartemen = count($departemenOptions);

// Mengambil 5 data karyawan terbaru berdasarkan tanggal masuk
$recentKaryawan = $conn->query("SELECT nama, nip, tanggal_masuk FROM karyawan ORDER BY tanggal_masuk DESC LIMIT 5");

// Mengambil distribusi jumlah karyawan per jabatan (jabatan juga ENUM)
$jabatanQuery = $conn->query("SELECT jabatan, COUNT(*) AS total FROM karyawan GROUP BY jabatan");
$jabatanLabels = [];
$jabatanData = [];
while ($row = $jabatanQuery->fetch_assoc()) {
    $jabatanLabels[] = $row['jabatan'];
    $jabatanData[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <!-- Menggunakan Bootstrap untuk tampilan responsif -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Chart.js untuk menampilkan grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Dashboard Admin</h2>

        <!-- Baris kartu statistik -->
        <div class="row mb-4">
            <!-- Kartu Total Karyawan -->
            <div class="col-md-6">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Karyawan</h5>
                        <p class="card-text"><?php echo $totalKaryawan; ?></p>
                    </div>
                </div>
            </div>
            <!-- Kartu Total Departemen -->
            <div class="col-md-6">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Departemen</h5>
                        <p class="card-text"><?php echo $totalDepartemen; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik distribusi karyawan per jabatan -->
        <div class="row mb-4">
            <div class="col-md-12">
                <canvas id="jabatanChart"></canvas>
            </div>
        </div>

        <!-- Tabel aktivitas terbaru -->
        <h4>Aktivitas Terbaru</h4>
        <table class="table table-striped mb-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $recentKaryawan->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nip'] ?></td>
                        <td><?= $row['tanggal_masuk'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tombol kembali ke halaman utama -->
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Script untuk membuat grafik dengan Chart.js -->
    <script>
        const ctx = document.getElementById('jabatanChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jabatanLabels); ?>,
                datasets: [{
                    label: 'Jumlah Karyawan per Jabatan',
                    data: <?php echo json_encode($jabatanData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $conn->close(); ?>