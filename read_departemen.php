<?php
include 'koneksi.php';

// Ambil daftar departemen
$sqlDept = "SELECT id_d, nama_departemen, banyak_anggota FROM departemen";
$resultDept = $conn->query($sqlDept);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Departemen</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Departemen</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Departemen</th>
                    <th>Jumlah Karyawan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop setiap baris departemen
                while ($row = $resultDept->fetch_assoc()) {
                    $idDepartemen = $row['id_d'];
                    $namaDepartemen = $row['nama_departemen'];
                    $banyakAnggota = $row['banyak_anggota'];
                    // Jika Anda belum pakai trigger, kolom ini mungkin 0 dan bisa diganti query COUNT dinamis.
                    // Contoh COUNT dinamis (jika tidak pakai banyak_anggota):
                    // $qCount = "SELECT COUNT(*) AS total FROM karyawan WHERE departemen_id = $idDepartemen";
                    // $resCount = $conn->query($qCount);
                    // $rowCount = $resCount->fetch_assoc();
                    // $banyakAnggota = $rowCount['total'];
                
                    echo "<tr>
                    <td>{$namaDepartemen}</td>
                    <td>{$banyakAnggota}</td>
                    <td>
                        <a href='?id_d={$idDepartemen}' class='btn btn-info btn-sm'>Lihat Karyawan</a>
                    </td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Jika parameter id_d ada, tampilkan daftar karyawan di departemen tersebut
    if (isset($_GET['id_d'])) {
        // Amankan input (casting ke int untuk ID)
        $idD = (int) $_GET['id_d'];

        // Ambil nama departemen (opsional, agar judul lebih jelas)
        $sqlDepName = "SELECT nama_departemen FROM departemen WHERE id_d = $idD";
        $resDepName = $conn->query($sqlDepName);
        $depName = "";
        if ($resDepName && $rowName = $resDepName->fetch_assoc()) {
            $depName = $rowName['nama_departemen'];
        }

        // Ambil data karyawan di departemen ini
        $sqlKaryawan = "SELECT * FROM karyawan WHERE departemen_id = $idD";
        $resultKaryawan = $conn->query($sqlKaryawan);
        ?>
        <div class="container mt-4">
            <h3>Daftar Karyawan di Departemen <?= htmlspecialchars($depName) ?></h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($rowK = $resultKaryawan->fetch_assoc()) {
                        echo "<tr>
                        <td>{$rowK['nip']}</td>
                        <td>{$rowK['nama']}</td>
                        <td>{$rowK['jabatan']}</td>
                        <td>{$rowK['email']}</td>
                        <td><img src='{$rowK['foto']}' width='50'></td>
                      </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <!-- Tombol Kembali -->
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>