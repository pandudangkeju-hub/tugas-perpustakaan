proses_edit
<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:form_anggota.php');
    exit;
}

$na = trim($_POST['na'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$noHP = trim($_POST['noHP'] ?? '');
$ja = trim($_POST['ja'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$id = $_POST ['id'];

$panjangNo = $noHP;
$ja_db = array('Mahasiswa', 'Dosen', 'Tenaga Kependidikan');
$errors = array();

if (empty($na)){
    $errors[] = 'Nomor Anggota tidak boleh kosong!';
} elseif (strlen($na) > 15) {
    $errors[] = 'Nomor Anggota maksimal 15 angka';
}

if (empty($nama)) {
    $errors[] = 'Nama tidak boleh kosng!';
} elseif (strlen($nama) > 100) {
    $errors[] = 'Nama hanya berisi 100 karakter';
}

if (empty($email)) {
    $errors[] = 'Email harus diisi!';
} elseif (strlen($email) > 100) {
    $errors[] = 'Email hanya terdiri dari 100 karakter';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid';
}

if (empty($noHP)) {
    $errors[] = 'Nomor HP harus diisi!';
} elseif (!ctype_digit($noHP)) {
    $errors[] = 'Nomor HP harus berupa angka!';
} elseif (strlen($panjangNo) < 10) {
    $errors[] = 'Nomor HP minimal 10 angka';
} elseif (strlen($panjangNo) > 13) {
    $errors[] = 'Nomor HP maksimal 13 angka';
}

if (empty($ja)) {
    $errors[] = 'Jenis Anggota harus diisi!';
} elseif (!in_array($ja ,$ja_db, true)) {
    $errors[] = 'Jenis Anggota tidak ada pada list';
}

if (empty($alamat)) {
    $errors[] = 'Alamat Harus diisi!';
}

$berhasil = false;
$pesan_db = '';

if (empty($errors)) {
    require_once ('koneksi.php');

    $sql = "UPDATE anggota SET no_anggota = ?, nama_lengkap = ?, email = ?, no_hp = ?, jenis_anggota = ?, alamat = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssi', $na, $nama, $email, $noHP, $ja, $alamat, $id);
        if (mysqli_stmt_execute($stmt)) {
            $berhasil = true;
        } else {
            $pesan_db = mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $pesan_db = mysqli_error($koneksi);
    }
    mysqli_close($koneksi);

    if ($berhasil) {
        header('Location: data.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penyimpanan Data</title>
    <style>
        body {font-family: Arial, sans-serif; margin: 40px;}
        h1 {color: #1f3864;}
        .gagal {background: #fdecea; border-left: 4px solid #c0392b; padding: 10px;}
    </style>
</head>
<body>
    <?php if (!empty($errors)) { ?>

    <h1>Data Tidak Valid</h1>
    <p class="gagal">Data Tidak Dapat Disimpan. Harap Perbarui Data:</p>
    <ul>
        <?php foreach ($errors as $pesan ) { ?>
            <li><?php echo htmlspecialchars($pesan); ?></li>
        <?php } ?>
    </ul>

    <?php } else { ?>

    <h1>Data Gagal Disimpan</h1>
    <p class='gagal'>Terjadi kesalahan saat menyimpan data ke database</p>
    <p>Pesan dari MySQL: <?php echo htmlspecialchars($pesan_db); ?></p>

    <?php } ?>

    <p><a href="javascript:history.back()">Kembali dan Perbaiki data</a></p>
</body>
</html>