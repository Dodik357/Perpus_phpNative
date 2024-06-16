<?php

// Memeriksa apakah ada formulir yang dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // Memeriksa apakah username hanya berisi huruf dan angka
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        echo "Username hanya boleh berisi huruf dan angka.";
        exit;
    }

    // Menghapus semua karakter yang bukan huruf dan angka
    $username = preg_replace("/[^a-zA-Z0-9]/", "", $username);
    
    // Memeriksa apakah username dan password tidak kosong
    if (empty($username) || empty($password) || empty($password2)) {
        echo "Username, password, dan konfirmasi password harus diisi.";
        exit;
    }

    // Memeriksa apakah password dan konfirmasi password sama
    if ($password === $password2) {
        // Membuat koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "perpus2");

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="style/style.css" />
    <title>Document</title>
</head>

<body>

    <style>
    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }
    </style>

    <div class="container">
        <h2>Registrasi</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" id="password2" name="password2" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn">Register</button>
            </div>
            <p> Sudah memiliki akun ? <a href="login.php">Login disini</a></p>
        </form>
    </div>

</body>

</html>