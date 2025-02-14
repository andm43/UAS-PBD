<?php
include 'koneksi.php';
// Mengambil semua data departemen
$result = $conn->query("SELECT * FROM departemen");
if (!$result) {
    die("Query error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Departemen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Departemen</h2>
        <!-- Tombol kembali ke beranda -->
        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>
        <!-- Link untuk menambahkan departemen baru -->
        <a href="create_departemen.php" class="btn btn-primary mb-3">Tambah Departemen</a>
        <!-- Tabel untuk menampilkan data departemen -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nama_departemen'] ?></td>
                        <td>
                            <a href="update_departemen.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_departemen.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus departemen?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
    </div>
</body>

</html>