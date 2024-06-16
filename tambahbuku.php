<!DOCTYPE html>
<html>

<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Tambah Buku</h1>
            </div>
            <div class="card-body">
                <form method="post" action="tambahbuku.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_buku">ID Buku</label>
                        <input type="text" class="form-control" name="id_buku">
                    </div>
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" class="form-control" name="judul_buku">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit">
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" name="pengarang">
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_buku">Jumlah Buku</label>
                        <input type="number" class="form-control" name="jumlah_buku">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_rak">ID Rak</label>
                        <input type="text" class="form-control" name="id_rak">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control-file" name="foto">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_buku = $_POST['id_buku'] ?? null;
        $judul_buku = $_POST['judul_buku'] ?? null;
        $penerbit = $_POST['penerbit'] ?? null;
        $pengarang = $_POST['pengarang'] ?? null;
        $tahun_terbit = $_POST['tahun_terbit'] ?? null;
        $jumlah_buku = $_POST['jumlah_buku'] ?? null;
        $deskripsi = $_POST['deskripsi'] ?? null;
        $id_rak = $_POST['id_rak'] ?? null;

        $foto = $_FILES['foto']['tmp_name'];
        $nama_foto = $_FILES['foto']['name'];

        if ($id_buku === null || $judul_buku === null || $penerbit === null || $pengarang === null || $tahun_terbit === null || $jumlah_buku === null || $deskripsi === null || $id_rak === null || $nama_foto === null) {
            echo "Gagal menambahkan buku: Data tidak lengkap";
            exit;
        }

        // Ensure the directory exists
        $target_dir = "image/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($nama_foto);

        if (move_uploaded_file($foto, $target_file)) {
            $sql = "INSERT INTO buku (id_buku, judul_buku, penerbit, pengarang, tahun_terbit, jumlah_buku, deskripsi, id_rak, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssssss", $id_buku, $judul_buku, $penerbit, $pengarang, $tahun_terbit, $jumlah_buku, $deskripsi, $id_rak, $nama_foto);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Buku berhasil ditambahkan";
            } else {
                echo "Gagal menambahkan buku: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Gagal mengupload foto";
        }
    }
    ?>
</body>

</html>