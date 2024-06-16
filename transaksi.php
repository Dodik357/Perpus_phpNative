<?php
// Include database connection file
$conn = mysqli_connect('localhost', 'root', '', 'perpus2');
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Include navbar HTML
// include 'layout/navbar.html';

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    // Ensure the database connection is established beforehand
    // Then, capture data from the form
    $id_user = $_POST['id_user'];
    $id_rak = $_POST["id_rak"];
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status']; // Default status is set as 'pinjam' within the form

    // Insert data into the database
    $sql_insert = "INSERT INTO transaksi (id_user, id_rak, id_buku, judul, tanggal_pinjam, tanggal_kembali, status) VALUES ('$id_user', '$id_rak', '$id_buku',  '$judul', '$tanggal_pinjam', '$tanggal_kembali', '$status')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil dikirim.'); window.location.href = 'transaksi.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="style/style.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Perpustakaan Gemilang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Pinjam Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahbuku.php">Buku</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-regular fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="signin.php">Sign in</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 pd-6 mt-5 mb-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Form Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="id_user">ID User</label>
                                    <select class="form-control text-center" id="id_user" name="id_user" disabled>
                                        <?php
                                        // Query untuk mengambil data user
                                        $sql = "SELECT id_user, username FROM user";
                                        $result = mysqli_query($conn, $sql);

                                        // Periksa jika ada hasil
                                        if ($result && $result->num_rows > 0) {
                                            // Output data dari setiap baris
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["id_user"] . '">' . $row["id_user"] . '</option>';
                                            }
                                        } else {
                                            echo '<option disabled>No users available</option>';
                                        }
                                        ?> </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_buku">ID Buku</label>
                                    <select class="form-control text-center" id="id_buku" name="id_buku" disable>
                                        <?php
                                        // Query untuk mengambil data buku
                                        $sql = "SELECT id_buku, judul_buku FROM buku";
                                        $result = mysqli_query($conn, $sql);

                                        // Periksa jika ada hasil
                                        if ($result && $result->num_rows > 0) {
                                            // Output data dari setiap baris
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["id_buku"] . '">' . $row["id_buku"] . '</option>';
                                            }
                                        } else {
                                            echo '<option disabled>No books available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="id_rak">ID Rak</label>
                                    <select class="form-control text-center" id="id_rak" name="id_rak" required>
                                        <?php
                                        // Query untuk mengambil data rak
                                        $sql = "SELECT id_rak, nama_rak FROM rak";
                                        $result = mysqli_query($conn, $sql);

                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["id_rak"] . '">' . $row["nama_rak"] . '</option>';
                                            }
                                        } else {
                                            echo '<option disabled>No raks available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <select class="form-control" id="judul" name="judul" required>
                                    <?php
                                    // Query untuk mengambil data buku
                                    $sql = "SELECT id_buku, judul_buku FROM buku";
                                    $result = mysqli_query($conn, $sql);

                                    // Periksa jika ada hasil
                                    if ($result && $result->num_rows > 0) {
                                        // Output data dari setiap baris
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id_buku"] . '">' . $row["judul_buku"] . '</option>';
                                        }
                                    } else {
                                        echo '<option disabled>No books available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" diasable>
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="pinjam" selected disabled>Pinjam</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                                        required>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>