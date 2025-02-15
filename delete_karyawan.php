<?php
include 'koneksi.php';

// Inisialisasi pesan
$message = "";

// Memastikan ID karyawan disediakan melalui parameter GET dengan nama 'id_k'
if (isset($_GET['id_k'])) {
    $id = intval($_GET['id_k']);

    // Menyusun query untuk menghapus data karyawan berdasarkan id_k
    $sql = "DELETE FROM karyawan WHERE id_k = $id";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success'>Karyawan berhasil dihapus.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
} else {
    $message = "<div class='alert alert-warning'>ID karyawan tidak disediakan.</div>";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hapus Karyawan</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <?php echo $message; ?>
        <a href="read_karyawan.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>