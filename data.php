<?php
require_once('koneksi.php');
$hasil = mysqli_query($koneksi, "SELECT * FROM anggota");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            padding: 10px;
            background-color: blue;
            color: #ffffff;
        }
        td {
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Data Mahasiswa</h1>
    
    <!-- Tag </a> sudah ditambahkan -->
    <a href="data.php">
        <button>Lihat Data</button>
    </a>

    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>no_anggota</th>
                <th>nama_lengkap</th>
                <th>email</th>
                <th>no_hp</th>
                <th>jenis_anggota</th>
                <th>alamat</th>
                <th>edit</th>
                <th>hapus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($hasil)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['no_anggota']); ?></td>
                    <!-- Kolom nama_lengkap ditambahkan -->
                    <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['no_hp']); ?></td>
                    <td><?= htmlspecialchars($row['jenis_anggota']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>">
                            <button type="button">Edit</button>
                        </a> 
                    </td>
                    <td>
                        <form action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>