<?php
include 'koneksi.php';
include 'layout/navbar.html';

$sql = "SELECT username FROM user";
$result = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="style/style.css">
    <title>Perpustakaan</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5">
                <img src="image/9653.jpg" class="img-fluid animate__animated animate__fadeInRight" alt="Illustration">
            </div>
            <div class="col-md-6 mt-5">
                <div class="body-content mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6 mt-5">
                            <h1 class="text-center animate__animated animate__fadeInDown">Selamat Datang Perpustakaan</h1>
                            <p class="text-center animate__animated animate__fadeInUp">Temukan buku yang Anda cari di sini</p>
                            <div class="d-flex justify-content-center mt-5">
                                <a href="buku.php" class="btn btn-primary btn-lg">Cari Buku</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'layout/footer.html';
    ?>
</body>

</html>d