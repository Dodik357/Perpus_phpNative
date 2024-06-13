<?php
include 'koneksi.php';

// Periksa apakah ada parameter id_transaksi yang dikirim melalui URL
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Query SQL untuk menghapus data transaksi berdasarkan id_transaksi
    $sql_delete = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";

    if ($conn->query($sql_delete) === TRUE) {
        // Redirect kembali ke halaman transaksi setelah penghapusan berhasil
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
} else {
    echo "ID Transaksi tidak ditemukan.";
}


// Tutup koneksi ke database
$conn->close();
