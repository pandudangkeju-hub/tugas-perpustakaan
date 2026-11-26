<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_perpustakaan';

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die('Koneksi Tidak Terhubung: ' . htmlspecialchars(mysqli_connect_error()));
}
?>