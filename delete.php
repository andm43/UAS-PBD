<?php
include 'koneksi.php';
// Memastikan ID karyawan disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Menyusun query untuk menghapus data karyawan berdasarkan ID
    $sql = "DELETE FROM karyawan WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Karyawan berhasil dihapus.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID karyawan tidak disediakan.</div>";
}
?>
<!-- Tombol kembali ke daftar karyawan -->
<div class="container mt-4">
    <a href="read_karyawan.php" class="btn btn-secondary">Kembali</a>
</div>