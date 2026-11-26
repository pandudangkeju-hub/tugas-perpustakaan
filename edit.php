<?php
require_once('koneksi.php');

// Validasi jika ID tidak ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: data.php');
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Jika data dengan ID tersebut tidak ditemukan di database
if (!$data) {
    header('Location: data.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="email"], select, textarea { width: 320px; padding: 6px; }
        button { margin-top: 16px; padding: 8px 20px; }
    </style>
</head>
<body>
    <h1>Edit Data Anggota</h1>

    <form action="proses_edit.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

        <label for="na">Nomor Anggota:</label>
        <input type="number" id="na" name="na" value="<?= htmlspecialchars($data['no_anggota']); ?>" required><br>

        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" maxlength="100" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']); ?>" maxlength="100" required><br>

        <label for="noHP">Nomor HP:</label>
        <input type="number" id="noHP" name="noHP" value="<?= htmlspecialchars($data['no_hp']); ?>" required><br>

        <label for="ja">Jenis Anggota:</label>
        <select id="ja" name="ja" required>
            <option value="">==Pilih Jenis Anggota==</option>
            <option value="Mahasiswa" <?= ($data['jenis_anggota'] === 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
            <option value="Dosen" <?= ($data['jenis_anggota'] === 'Dosen') ? 'selected' : ''; ?>>Dosen</option>
            <option value="Tenaga Kependidikan" <?= ($data['jenis_anggota'] === 'Tenaga Kependidikan') ? 'selected' : ''; ?>>Tenaga Kependidikan</option>
        </select><br>

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?= htmlspecialchars($data['alamat']); ?></textarea><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="data.php" style="margin-left: 10px;">Batal</a>
    </form>
</body>
</html>