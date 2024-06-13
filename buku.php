<?php
include 'koneksi.php';
include 'layout/navbar.html';

// Query database untuk mendapatkan semua buku
$sql = "SELECT * FROM buku";
$result = mysqli_query($conn, $sql);

// Buat array untuk menampung semua buku
if (mysqli_num_rows($result) > 0) {
    $bukus = array();
    while($row = mysqli_fetch_assoc($result)) {
        $bukus[] = $row;
    }

    // Hitung jumlah buku dan kolom yang diperlukan untuk menampilkannya secara responsif
    $num_bukus = count($bukus);
    $num_cols = 4;
    $num_rows = ceil($num_bukus / $num_cols);

    // Tulis tabel buku dengan tampilan responsif
    for ($i = 0; $i < $num_rows; $i++) {
        echo '<div class="row">';
        for ($j = 0; $j < $num_cols && ($i * $num_cols + $j) < $num_bukus; $j++) {
            $buku = $bukus[$i * $num_cols + $j];
            echo '<div class="col-md-3">';
            echo '<div class="card">';
            echo '<img src="images/android' . $buku['foto'] . '" class="card-img-top" alt="' . $buku['foto'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $buku['judul_buku'] . '</h5>';
            echo '<p class="card-text">' . $buku['deskripsi'] . '</p>';
            echo 'Jumlah buku: ' . $buku['jumlah'] . '<br>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div><br><br>';
    }
}

mysqli_close($conn);
include 'layout/footer.html';
?>

