<?php 
    require_once './Helpers/function.php';

    if(!isset($_GET['kode_obat'])) {
        header('Location: index.php');
        exit();
    }

    $kode_obat = $_GET['kode_obat'];
    $drug = tampilkan("SELECT * FROM obat WHERE kode_obat = '$kode_obat'")[0];

    if(isset($_POST['submit'])) {
        update($_POST, $kode_obat);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="./public/css/styles.css">
    <title>Apotek Indonesia Merdeka </title>
</head>
<body>
    <div class="title">
        <h1>EDIT DATA OBAT</h1>
    </div>
    <div class="form">
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama <span>*</span></label>
                <input type="text" placeholder="nama obat" id="nama" name="nama" autocomplete="off" value="<?= $drug['nama'] ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga <span>*</span></label>
                <input type="number" placeholder="harga obat" id="harga" name="harga" autocomplete="off" value="<?= $drug['harga'] ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit"><i class="zmdi zmdi-floppy"></i> Update</button>
            </div>
        </form>
        <div style="text-align: right; margin: 7px 0">
            <a href="./index.php">Kembali</a>
        </div>
    </div>
    <?php if(isset($_SESSION['success'])) {?>
        <div class="alert">
            <span>Berhasil </span><?= $_SESSION['success'] ?>
        </div>
    <?php unset($_SESSION['success']) ?>
    <?php } ?>
    <div class="bg-rem"><img src="./public/images/rem.png" alt=""></div>
</body>
</html>