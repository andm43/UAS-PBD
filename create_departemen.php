<?php
include 'koneksi.php';
// Jika form disubmit, proses penambahan departemen baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_departemen = $conn->real_escape_string($_POST['nama_departemen']);
    $sql = "INSERT INTO departemen (nama_departemen) VALUES ('$nama_departemen')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Departemen berhasil ditambahkan.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Departemen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Departemen</h2>
        <!-- Form untuk menambahkan data departemen -->
        <form method="POST">
            <div class="mb-3">
                <label for="nama_departemen" class="form-label">Nama Departemen</label>
                <input type="text" name="nama_departemen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Departemen</button>
            <a href="read_departemen.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>