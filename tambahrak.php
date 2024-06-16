<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_rak = $_POST['nama_rak'] ?? null;

    if ($nama_rak === null) {
        echo "Gagal menambahkan data: Data tidak lengkap";
        exit;
    }

    include 'koneksi.php';

    $sql = "INSERT INTO rak (nama_rak) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nama_rak);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="style/style.css" />
    <title>Tambah Rak</title>
</head>

<body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Perpustakaan</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fe fe-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tambahbuku.php">
                                <i class="fe fe-plus-square"></i>
                                Tambah Buku
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tambahrak.php">
                                <i class="fe fe-plus-square"></i>
                                Tambah Rak
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-5 mb-5">
                        <h3>Tambah Rak</h3>
                        <form action="tambahrak.php" method="post">
                            <div class="mb-3">
                                <label for="nama_rak" class="form-label">Nama Rak</label>
                                <input type="text" class="form-control" id="nama_rak" name="nama_rak" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>