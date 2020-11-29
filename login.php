<?php 
    require_once './Helpers/function.php';
    redirectIfAuth();
    
    if(isset($_POST['submit'])) {
        login($_POST);
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
    <title>Login | Apotek Indonesia</title>
</head>
<body>
    <div class="login-container">
        <div class="card-login">
            <div class="illustration">
                <img src="./public/images/login.png" alt="">
                <h3 class="Poppins" style="margin-top: 10px">Apotek Indonesia Merdeka</h3>
            </div>
            <div class="form">
                <h1 class="Poppins text-center">Halaman Login</h1>
                <?php if(isset($_SESSION['success'])) {?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']) ?>
                <?php } ?>
                <?php if(isset($_SESSION['failed'])) {?>
                    <div class="alert alert-danger"><?= $_SESSION['failed'] ?></div>
                    <?php unset($_SESSION['failed']) ?>
                <?php } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="Poppins" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="Poppins" for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Masuk</button>
                    </div>
                    <div class="form-group">
                        <span class="Poppins">Belum mempunyai akun? <a href="./register.php">Daftar</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>