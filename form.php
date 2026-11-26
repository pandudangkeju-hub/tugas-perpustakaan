<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        label.pilihan { display: inline; font-weight: normal; margin-right: 16px; }
        input[type="text"], select, textarea { width: 320px; padding: 6px; }
        button { margin-top: 16px; padding: 8px 20px; }
    </style>
</head>
<body>
    <h1>Isi Data Dirimu</h1>

    <form action="proses_anggota.php" method="post">
        <label for="na">Nomor Aggota:</label>
        <input type="number" id="na" name="na" placeholder="Masukkan Nomor Anggota" onclick="this.select()"><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" onclick="this.select()"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email '@'"><br>

        <label for="noHP">Nomor Hp:</label>
        <input type="number" id="noHP" name="noHP" placeholder="Masukkan Nomor HP"><br>

        <label for="ja">Jenis Anggota</label>
        <select id="ja" name="ja">
            <option value="">==Pilih Jenis Anggota==</option>
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Dosen">Dosen</option>
            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
        </select><br>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat"></textarea><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>