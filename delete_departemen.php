<?php
include 'koneksi.php';
// Memastikan ID departemen disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Menyusun query untuk menghapus data departemen berdasarkan ID
    $sql = "DELETE FROM departemen WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Departemen berhasil dihapus.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID departemen tidak disediakan.</div>";
}
?>
<!-- Tombol kembali ke daftar departemen -->
<div class="container mt-4">
    <a href="read_departemen.php" class="btn btn-secondary">Kembali</a>
</div>