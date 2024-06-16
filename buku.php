<?php
$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="assets/img/books/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['gambar'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['judul'] ?></h5>
                    <p class="card-text"><?= $row['deskripsi'] ?></p>
                    <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>