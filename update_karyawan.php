<?php
include 'koneksi.php';

// Memastikan ID karyawan disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Mengambil data karyawan berdasarkan ID
    $result = $conn->query("SELECT * FROM karyawan WHERE id=$id");
    $karyawan = $result->fetch_assoc();

    if (!$karyawan) {
        die("Data karyawan tidak ditemukan.");
    }
} else {
    die("ID karyawan tidak disediakan.");
}

// Proses pembaruan data karyawan ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input dari form
    $nip = $conn->real_escape_string($_POST['nip']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $jabatan = $conn->real_escape_string($_POST['jabatan']);
    $departemen = $conn->real_escape_string($_POST['departemen']); // ENUM sekarang
    $email = $conn->real_escape_string($_POST['email']);

    // Proses upload foto jika ada file baru, jika tidak gunakan foto lama
    $foto = $karyawan['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $foto = $uploadDir . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    // Menyusun query update untuk memperbarui data karyawan
    $sql = "UPDATE karyawan 
            SET nip='$nip', nama='$nama', jabatan='$jabatan', 
                departemen='$departemen', email='$email', foto='$foto' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Data karyawan berhasil diperbarui.</div>";
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
                <input type="text" name="nip" class="form-control" value="<?= $karyawan['nip'] ?>" required>
            </div>
            <!-- Field Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $karyawan['nama'] ?>" required>
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
            <!-- Dropdown untuk Departemen menggunakan ENUM -->
            <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <select name="departemen" class="form-select" required>
                    <?php
                    // ENUM untuk departemen
                    $departemenOptions = ['HRD', 'Keuangan', 'IT', 'Pemasaran', 'Produksi'];
                    foreach ($departemenOptions as $option) {
                        $selected = ($option == $karyawan['departemen']) ? "selected" : "";
                        echo "<option value=\"$option\" $selected>$option</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Field Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= $karyawan['email'] ?>" required>
            </div>
            <!-- Field Foto (opsional) -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
                <?php if ($karyawan['foto']): ?>
                    <img src="<?= $karyawan['foto'] ?>" alt="Foto" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Karyawan</button>
            <a href="read_karyawan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>