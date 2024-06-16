<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? null;
    $email = $_POST['email'] ?? null;
    $pesan = $_POST['pesan'] ?? null;

    if ($nama === null || $email === null || $pesan === null) {
        echo "Gagal menambahkan data: Data tidak lengkap";
        exit;
    }

    $sql = "INSERT INTO contact (nama, email, pesan) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>