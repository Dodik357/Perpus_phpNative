<?php
// Mengaktifkan laporan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Menghubungkan ke database
$conn = mysqli_connect('localhost', 'root', '', 'perpus2');
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Mengambil id transaksi dari parameter URL
$id_transaksi = $_GET['id_transaksi'];

// Memeriksa koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Mengambil data transaksi berdasarkan id transaksi
$sql_select = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
$result = mysqli_query($conn, $sql_select);

// Mengecek apakah data transaksi ditemukan
if (mysqli_num_rows($result) > 0) {
    // Mengambil data transaksi
    $row = mysqli_fetch_assoc($result);
    $judul = $row['judul'];
    $tanggal_pinjam = $row['tanggal_pinjam'];
    $tanggal_kembali = $row['tanggal_kembali'];
} else {
    // Menampilkan pesan error jika data transaksi tidak ditemukan
    echo "Data Transaksi tidak ditemukan.";
    exit();
}

// Memeriksa jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $judul = $_POST['judul'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Mengubah data transaksi
    $sql_update = "UPDATE transaksi SET judul = '$judul', tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali' WHERE id_transaksi = '$id_transaksi'";
    if (mysqli_query($conn, $sql_update)) {
        // Mengalihkan ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Menampilkan pesan error jika terjadi kesalahan saat mengubah data
        echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
    }
}

// Menutup koneksi ke database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    .padding-top {
        padding-top: 20px;
    }

    .padding-bottom {
        padding-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 mt">
                <div class="card">
                    <div class="card-header bg-primary text-white padding-top padding-bottom">
                        <h4>Edit Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <select class="form-control" id="judul" name="judul" required>
                                    <?php
                                    // Menghubungkan ulang ke database karena koneksi sebelumnya ditutup
                                    include 'koneksi.php';

                                    // Query untuk mengambil data buku
                                    $sql = "SELECT id_buku, judul_buku FROM buku";
                                    $result = mysqli_query($conn, $sql);

                                    // Periksa jika ada hasil
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        // Output data dari setiap baris
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row["judul_buku"] == $judul) ? 'selected' : '';
                                            echo '<option value="' . $row["judul_buku"] . '" ' . $selected . '>' . $row["judul_buku"] . '</option>';
                                        }
                                    } else {
                                        echo '<option disabled>No books available</option>';
                                    }

                                    // Menutup koneksi ke database
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam"
                                    value="<?php echo $tanggal_pinjam; ?>" required disabled>
                            </div>
                            <div class="form-group mb-5 ">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                                    value="<?php echo $tanggal_kembali; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.html'; ?>
</body>

</html>