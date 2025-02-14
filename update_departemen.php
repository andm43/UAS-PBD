<?php
include 'koneksi.php';
// Memastikan ID departemen disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Mengambil data departemen berdasarkan ID
    $result = $conn->query("SELECT * FROM departemen WHERE id=$id");
    $departemen = $result->fetch_assoc();
    if (!$departemen) {
        die("Data departemen tidak ditemukan.");
    }
} else {
    die("ID departemen tidak disediakan.");
}

// Jika form disubmit, proses pembaruan data departemen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_departemen = $conn->real_escape_string($_POST['nama_departemen']);
    $sql = "UPDATE departemen SET nama_departemen='$nama_departemen' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data departemen berhasil diperbarui.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Departemen</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Departemen</h2>
        <!-- Form untuk mengedit data departemen -->
        <form method="POST">
            <div class="mb-3">
                <label for="nama_departemen" class="form-label">Nama Departemen</label>
                <input type="text" name="nama_departemen" class="form-control"
                    value="<?= $departemen['nama_departemen'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Departemen</button>
            <a href="read_departemen.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>