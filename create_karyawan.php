<?php
include 'koneksi.php';

// Proses penambahan karyawan baru ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input dari form
    $nip = $conn->real_escape_string($_POST['nip']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']); // Nilai ENUM untuk jabatan

    // Ambil departemen_id (nilai numerik) dari dropdown
    $departemen_id = intval($_POST['nama_departemen']);

    $email = $conn->real_escape_string($_POST['email']);

    // Proses upload file foto jika ada
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $uploadDir = "uploads/"; // Direktori penyimpanan foto
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Membuat direktori jika belum ada
        }
        $fotoPath = $uploadDir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $fotoPath);
        $foto = $fotoPath; // Simpan path foto ke DB
    }

    // Menyusun query INSERT untuk menyimpan data karyawan
    // Kolom: nip, nama, jabatan, departemen_id, email, foto
    $sql = "INSERT INTO karyawan (nip, nama, jabatan, departemen_id, email, foto) 
            VALUES ('$nip', '$nama', '$jabatan', $departemen_id, '$email', '$foto')";

    // Eksekusi query dan menampilkan pesan hasil proses
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Karyawan <strong>"
            . htmlspecialchars($nama) . "</strong> berhasil ditambahkan!</div>";
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
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Karyawan</h2>
        <!-- Form untuk menambah data karyawan -->
        <form method="POST" enctype="multipart/form-data">
            <!-- NIP -->
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" required>
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <!-- Jabatan (ENUM) -->
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" class="form-select" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Direktur">Direktur</option>
                    <option value="Manager">Manager</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Staff">Staff</option>
                </select>
            </div>

            <!-- Departemen (foreign key) -->
            <div class="mb-3">
                <label for="nama_departemen" class="form-label">Departemen</label>
                <select name="nama_departemen" class="form-select" required>
                    <!-- Nilai option adalah ID departemen sesuai dengan data di tabel `departemen` -->
                    <option value="">-- Pilih Departemen --</option>
                    <option value="1">HRD</option>
                    <option value="2">Keuangan</option>
                    <option value="3">IT</option>
                    <option value="4">Pemasaran</option>
                    <option value="5">Produksi</option>
                </select>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Foto -->
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