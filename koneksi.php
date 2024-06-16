<?php
$conn = mysqli_connect('localhost', 'root', '', 'perpus2');
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>