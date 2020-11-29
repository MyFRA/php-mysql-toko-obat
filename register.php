<?php 
    require_once './Helpers/function.php';
    redirectIfAuth();
    
    if(isset($_POST['submit'])) {
        register($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/fonts.css">
    <link rel="stylesheet" href="./public/css/inline-styles.css">
    <link rel="stylesheet" href="./public/css/login.css">
    <title>Register | Apotek Indonesia</title>
</head>
<body>
    <div class="login-container">
        <div class="card-login py-3">
            <div class="illustration">
                <img src="./public/images/register.png" alt="" class="w-lg-80">
                <h5 class="Poppins" style="margin-top: 10px">Apotek Indonesia Merdeka</h5>
            </div>
            <div class="form">
                <h1 class="Poppins text-center">Halaman Register</h1>
                <?php if(isset($_SESSION['failed'])) {?>
                    <div class="alert alert-danger"><?= $_SESSION['failed'] ?></div>
                    <?php unset($_SESSION['failed']) ?>
                <?php } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="Poppins" for="name">Nama <span class="text-danger">*</span></label>
                        <input type="name" name="name" id="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label class="Poppins" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="Poppins" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="Poppins" for="status">Daftar Sebagai <span class="text-danger">*</span></label>
                        <select name="status" id="status" style="height: 40px; margin-top: .2rem">
                            <option value="admin">Admin</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Daftar</button>
                    </div>
                    <div class="form-group">
                        <span class="Poppins">Belum mempunyai akun? <a href="./login.php">Masuk</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>