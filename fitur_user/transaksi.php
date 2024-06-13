<?php
// Include database connection file
include 'koneksi.php';

// Include navbar HTML
include 'layout/navbar.html';

// Query untuk mengambil data transaksi
$sql = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $sql);

// Check if the form has been submitted
if (isset($_POST["submit"])) {
    // Ensure the database connection is established beforehand
    // Then, capture data from the form
    $id_transaksi = $_POST['id_transaksi'];
    $id_user = $_POST['id_user'];
    $id_rak = $_POST["id_rak"];
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status']; // Default status is set as 'pinjam' within the form

    // Insert data into the database
    $sql_insert = "INSERT INTO transaksi (id_transaksi, id_user, id_rak, id_buku, judul, tanggal_pinjam, tanggal_kembali, status) VALUES ('$id_transaksi', '$id_user', '$id_rak', '$id_buku',  '$judul', '$tanggal_pinjam', '$tanggal_kembali', '$status')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Data berhasil dikirim.'); window.location.href = 'transaksi.php';</script>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// Retrieve book data
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];
    $sql = "SELECT judul_buku, id_rak FROM buku WHERE id_buku = '$id_buku'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
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
                                <div class="form-group col-md-3">
                                    <label for="id_transaksi">ID Transaksi</label>
                                    <input type="number" class="form-control" id="id_transaksi" name="id_transaksi" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="id_user">ID User</label>
                                    <select class="form-control" id="id_user" name="id_user" required>
                                        <?php
                                        // Query untuk mengambil data user
                                        $sql = "SELECT id_user, username FROM user";
                                        $result = mysqli_query($conn, $sql);

                                        // Periksa jika ada hasil
                                        if ($result && $result->num_rows > 0) {
                                            // Output data dari setiap baris
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["id_user"] . '">' . $row["username"] . '</option>';
                                            }
                                        } else {
                                            echo '<option disabled>No users available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="id_buku">ID Buku</label>
                                    <select class="form-control" id="id_buku" name="id_buku" required>
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
                                <div class="form-group col-md-3">
                                    <label for="id_rak">ID Rak</label>
                                    <select class="form-control" id="id_rak" name="id_rak" required>
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
                                            echo '<option value="' . $row["judul_buku"] . '">' . $row["judul_buku"] . '</option>';
                                        }
                                    } else {
                                        echo '<option disabled>No books available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="pinjam" selected>Pinjam</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Kirim</button>
                        </form>
                    </div>

                    <?php
                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include 'layout/footer.html'; 
?>
</html>
