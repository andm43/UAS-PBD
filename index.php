<?php
// index.php - Halaman utama dengan layout hero dan fitur card
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kepegawaian</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include Bootstrap Icons untuk menampilkan icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Hero Section: Full-screen dengan background image dan overlay gelap */
        .hero-section {
            position: relative;
            height: 100vh;
            background: url('https://via.placeholder.com/1500x900') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }

        /* Overlay untuk memberikan efek gelap pada background image */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        /* Konten hero ditempatkan di atas overlay */
        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Styling untuk card fitur dengan efek hover */
        .feature-card {
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Nama atau logo aplikasi -->
            <a class="navbar-brand" href="index.php">
                <img src="./component/logosmpegawai1.png" alt="Logo Home" height="40px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Hero Section: Menampilkan judul utama dengan background gambar gedung -->
    <div class="hero-section"
        style="background: url('https://i.pinimg.com/736x/7e/4d/35/7e4d3518c73e62fa88dba03054a36708.jpg') no-repeat center center/cover;">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-3">Sistem Manajemen Pegawai</h1>
            <p class="lead">Kelola data karyawan dan departemen secara efisien.</p>
        </div>
    </div>


    <!-- Fitur Section: Menampilkan card-card untuk fitur utama -->
    <div class="features bg-light py-5">
        <div class="container">
            <div class="row text-center">
                <!-- Card Fitur: Data Karyawan -->
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3">Data Karyawan</h5>
                            <p class="card-text">Kelola dan perbarui data karyawan.</p>
                            <a href="read_karyawan.php" class="btn btn-outline-primary">Lihat Karyawan</a>
                        </div>
                    </div>
                </div>
                <!-- Card Fitur: Data Departemen -->
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <i class="bi bi-building" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3">Data Departemen</h5>
                            <p class="card-text">Informasi dan struktur departemen perusahaan.</p>
                            <a href="read_departemen.php" class="btn btn-outline-primary">Lihat Departemen</a>
                        </div>
                    </div>
                </div>
                <!-- Card Fitur: Dashboard -->
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <i class="bi bi-speedometer2" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3">Dashboard</h5>
                            <p class="card-text">Lihat statistik dan informasi banyak karyawan dan departemen.</p>
                            <a href="dashboard.php" class="btn btn-outline-primary">Lihat Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Andre. Sistem Manajemen Pegawai.
            </p>
        </div>
    </footer>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>