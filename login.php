<?php

session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database
    $conn = mysqli_connect('localhost', 'root', '', 'perpus2');

    // Query untuk mengambil data user
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Periksa apakah ada hasil query
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Periksa apakah password cocok
        if (password_verify($password, $row['password'])) {
            // Login berhasil, simpan data user ke session
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['status'] = $row['status'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">Password salah!</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Username tidak ditemukan!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button type="button" class="btn btn-outline-secondary" id="showPassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" id="hidePassword"
                                        style="display: none;">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" name="submit" class="btn btn-primary ">Login</button>
                            </div>
                            <p class="text-start"> <a href="register.php">register disini</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const showPasswordButton = document.getElementById('showPassword');
    const hidePasswordButton = document.getElementById('hidePassword');
    const passwordInput = document.getElementById('password');

    showPasswordButton.addEventListener('click', function() {
        passwordInput.type = 'text';
        showPasswordButton.style.display = 'none';
        hidePasswordButton.style.display = 'block';
    });

    hidePasswordButton.addEventListener('click', function() {
        passwordInput.type = 'password';
        showPasswordButton.style.display = 'block';
        hidePasswordButton.style.display = 'none';
    });
    </script>
</body>

</html>