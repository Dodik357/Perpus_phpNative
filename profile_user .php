<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
    .card {
        margin-top: 40px;
    }

    label {
        margin-top: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    #avatar {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Profile</h2>
                    </div>
                    <div class="card-body">
                        <form action="proses_profile.php" method="post" enctype="multipart/form-data">
                            <div class="text-center">
                                <img id="avatar" src="image/profile.png" alt="Profile">
                                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*"
                                    onchange="showAvatarPreview(event)">
                            </div>
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>">
                            <div class="form-group">
                                <label for="nama_user">Nama User</label>
                                <input type="text" name="nama_user" id="nama_user" class="form-control"
                                    value="<?php echo $_SESSION['username'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" name="password_lama" id="password_lama" class="form-control"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" name="password_baru" id="password_baru" class="form-control"
                                    autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password_konfirmasi">Konfirmasi Password Baru</label>
                                <input type="password" name="password_konfirmasi" id="password_konfirmasi"
                                    class="form-control" autocomplete="off">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Ubah
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function showAvatarPreview(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('avatar-preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
    </script>
</body>

</html>