<?php
include 'koneksi.php';

// Gunakan JOIN agar bisa menampilkan nama_departemen
$sql = "
    SELECT 
        k.id_k,
        k.nip,
        k.nama,
        k.jabatan,
        d.nama_departemen,
        k.email,
        k.tanggal_masuk
    FROM karyawan k
    JOIN departemen d ON k.departemen_id = d.id_d
";

// Jalankan query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Karyawan</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Daftar Karyawan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Email</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nip']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['jabatan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_departemen']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
                        <td>
                            <a href="update_karyawan.php?id_k=<?= $row['id_k'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_karyawan.php?id_k=<?= $row['id_k'] ?>"
                                onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="create_karyawan.php" class="btn btn-primary">Tambah Karyawan</a>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>