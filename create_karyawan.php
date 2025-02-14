<?php
include 'koneksi.php';

// Proses penambahan karyawan baru ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input dari form
    $nip = $conn->real_escape_string($_POST['nip']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']); // Nilai ENUM untuk jabatan
    $departemen = $conn->real_escape_string($_POST['departemen']); // Nilai ENUM untuk departemen
    $email = $conn->real_escape_string($_POST['email']);

    // Proses upload file foto jika ada
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploadDir = "uploads/"; // Direktori penyimpanan foto
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Membuat direktori jika belum ada
        }
        $foto = $uploadDir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    // Menyusun query insert untuk menyimpan data karyawan
    $sql = "INSERT INTO karyawan (nip, nama, jabatan, departemen, email, foto) 
            VALUES ('$nip', '$nama', '$jabatan', '$departemen', '$email', '$foto')";

    // Eksekusi query dan menampilkan pesan hasil proses
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Karyawan berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Karyawan</h2>
        <!-- Form untuk menambah data karyawan -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <!-- Dropdown untuk memilih jabatan (ENUM) -->
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" class="form-select" required>
                    <option value="Direktur">Direktur</option>
                    <option value="Manager">Manager</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>
            <!-- Dropdown untuk memilih departemen (ENUM) -->
            <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <select name="departemen" class="form-select" required>
                    <option value="HRD">HRD</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="IT">IT</option>
                    <option value="Pemasaran">Pemasaran</option>
                    <option value="Produksi">Produksi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
            <a href="read_karyawan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>