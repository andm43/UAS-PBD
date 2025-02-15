<?php
include 'koneksi.php';

// Pastikan ID karyawan disediakan melalui parameter GET
if (isset($_GET['id_k'])) {
    $id = intval($_GET['id_k']);

    // Mengambil data karyawan berdasarkan id_k
    $result = $conn->query("SELECT * FROM karyawan WHERE id_k=$id");
    $karyawan = $result->fetch_assoc();

    if (!$karyawan) {
        die("Data karyawan tidak ditemukan.");
    }
} else {
    die("ID karyawan tidak disediakan.");
}

// Mapping departemen: id => nama departemen
$departemenMapping = [
    1 => 'HRD',
    2 => 'Keuangan',
    3 => 'IT',
    4 => 'Pemasaran',
    5 => 'Produksi'
];

// Proses pembaruan data karyawan ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input dari form
    $nip = $conn->real_escape_string($_POST['nip']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']);
    // Ambil departemen_id (bukan departemen, karena kolom di tabel adalah departemen_id)
    $departemen_id = intval($_POST['departemen']);
    $email = $conn->real_escape_string($_POST['email']);

    // Proses upload foto jika ada file baru, jika tidak gunakan foto lama
    $foto = $karyawan['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fotoPath = $uploadDir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $fotoPath);
        $foto = $fotoPath;
    }

    // Menyusun query UPDATE untuk memperbarui data karyawan
    $sql = "UPDATE karyawan 
            SET nip='$nip', 
                nama='$nama', 
                jabatan='$jabatan', 
                departemen_id=$departemen_id, 
                email='$email', 
                foto='$foto' 
            WHERE id_k=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data karyawan berhasil diperbarui.</div>";
        // Update data $karyawan agar form menampilkan perubahan tanpa reload
        $karyawan['nip'] = $nip;
        $karyawan['nama'] = $nama;
        $karyawan['jabatan'] = $jabatan;
        $karyawan['departemen_id'] = $departemen_id;
        $karyawan['email'] = $email;
        $karyawan['foto'] = $foto;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link rel="icon" type="image/png" href="./component/logosmpegawai1.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Karyawan</h2>
        <!-- Form untuk mengedit data karyawan -->
        <form method="POST" enctype="multipart/form-data">
            <!-- Field NIP -->
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($karyawan['nip']) ?>"
                    required>
            </div>
            <!-- Field Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($karyawan['nama']) ?>"
                    required>
            </div>
            <!-- Dropdown untuk Jabatan -->
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" class="form-select" required>
                    <?php
                    // Nilai-nilai ENUM untuk jabatan
                    $jabatanOptions = ['Direktur', 'Manager', 'Supervisor', 'Staff'];
                    foreach ($jabatanOptions as $option) {
                        $selected = ($option == $karyawan['jabatan']) ? "selected" : "";
                        echo "<option value=\"$option\" $selected>$option</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Dropdown untuk Departemen -->
            <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <select name="departemen" class="form-select" required>
                    <?php
                    // Tampilkan option berdasarkan mapping departemen
                    foreach ($departemenMapping as $id_dep => $depName) {
                        $selected = ($id_dep == $karyawan['departemen_id']) ? "selected" : "";
                        echo "<option value=\"$id_dep\" $selected>$depName</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Field Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= htmlspecialchars($karyawan['email']) ?>" required>
            </div>
            <!-- Field Foto (opsional) -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
                <?php if ($karyawan['foto']): ?>
                    <img src="<?= htmlspecialchars($karyawan['foto']) ?>" alt="Foto" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Karyawan</button>
            <a href="read_karyawan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>