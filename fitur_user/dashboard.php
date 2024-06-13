<?php
include 'koneksi.php';
include 'layout/navbar.html';

// Query SQL untuk mengambil data transaksi
$sql = "SELECT * FROM transaksi";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>

<body>
    <div class="card mb-5  mt-5">
        <div class="card-body mb-5">
            <table class="table table-striped">
                <!-- Header table -->
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <!-- Body table -->
                <tbody>
                    <?php
                    // Melakukan perulangan pada setiap baris data transaksi yang diambil dari database
                    // menggunakan fungsi mysqli_fetch_assoc() yang menghasilkan array asosiatif
                    // satu baris setiap kali iterasi.
                    // Looping data transaksi
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <!-- Menampilkan data transaksi -->
                            <td><?php echo $row["id_transaksi"]; ?></td>
                            <td><?php echo $row["judul"]; ?></td>
                            <td><?php echo $row["tanggal_pinjam"]; ?></td>
                            <td><?php echo $row["tanggal_kembali"]; ?></td>
                            <td style="<?php echo ($row["status"] == 'pinjam') ? 'color: blue; padding: 2px; ' : (($row["status"] == 'kembali') ? 'background-color: green; padding: 5px;' : ''); ?>">
                                <?php echo $row["status"]; ?>
                            </td>
                            <td>
                                <!--link untuk menghapus data transaksi -->
                                <a href="hapus_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pinjaman ini?')" class="btn btn-danger">Batal Pinjam</a>
                                <!-- Link untuk mengedit Update data transaksi -->
                                <a href="edit_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#" id="previousPage">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#" id="nextPage">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <?php include 'layout/footer.html'; ?>
    <script src="js/script.js"></script>
</body>

</html>