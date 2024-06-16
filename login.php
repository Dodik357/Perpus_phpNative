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
             header("Location: index.php");
             exit;
         } else {
           $error = 'Password salah!';

         }
     } else {
       $error = 'Username tidak ditemukan!';

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
        <div class="row justify-content-center my-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow p-4">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        <?php if(isset($error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                        <?php } ?>
                        <form method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Username" id="username" +
                                    name="username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" id="password" +
                                    name="password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="showPassword"><i
                                            class="fa-solid fa-eye"></i></button>
                                    <button class="btn btn-outline-secondary" type="button" id="hidePassword"
                                        style="display: none;"><i class="fa-solid fa-eye-slash"></i></button>
                                </div>
                            </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit" name="submit">Login</button>
                        <p>Belum memiliki akun ? <a href="register.php">Register disini</a></p>
                    </div>
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