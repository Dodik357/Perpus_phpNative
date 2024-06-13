<?php
include 'layout/navbar.html';

// Memeriksa apakah ada formulir yang dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // Memeriksa apakah password dan konfirmasi password sama
    if ($password === $password2) {
        // Membuat koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "perpustakaan");

        // Memeriksa apakah username sudah digunakan
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "Username sudah digunakan.";
        } else {
            // Menyimpan data ke database
            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($conn, $sql)) {
                echo "Register berhasil. Anda sudah bisa login.";
            } else {
                echo "Register gagal.";
            }
        }

        mysqli_close($conn);
    } else {
        echo "Password dan konfirmasi password tidak sama.";
    }
}
?>