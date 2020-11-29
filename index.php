<?php 
    require_once './Helpers/function.php';

    checkLogedIn();

    $drugs = tampilkan("SELECT * FROM obat");

    if(isset($_POST['submit'])) {
        $insert = create([
            'nama'   => $_POST['nama'],
            'harga'  => $_POST['harga'],
        ], 'obat');

        if($insert[1]) {
            $_SESSION['success'] = 'obat ' . $insert[0]['nama'] . ' telah ditambahkan';
            header('Location: ./index.php');
            exit();
        }
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
        <h1 class="text-center">DAFTAR OBAT</h1>
        <br>
        <h3>Selamat Datang <?= $_SESSION['user']['name'] ?> anda adalah seorang <?= $_SESSION['user']['status'] ?></h3>
    </div>
    <div class="form">
        <form action="./" method="post">
        <?php if($_SESSION['user']['status'] == 'admin') {?>
            <div class="form-group">
                <label for="nama">Nama <span>*</span></label>
                <input type="text" placeholder="nama obat" id="nama" name="nama" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga <span>*</span></label>
                <input type="number" placeholder="harga obat" id="harga" name="harga" autocomplete="off" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit"><i class="zmdi zmdi-floppy"></i> Simpan</button>
            </div>
        <?php } ?>
            <div class="form-group">
                <a class="" href="./logout.php" style="background-color: red; color: #fff; padding: .5rem 1rem; text-decoration: none; border-radius: 5px; font-size: .8rem"><i class="zmdi zmdi-power-off"></i> Logout</a>
            </div>
        </form>
    </div>
    <?php if(isset($_SESSION['success'])) {?>
        <div class="alert">
            <span>Berhasil </span><?= $_SESSION['success'] ?>
        </div>
    <?php unset($_SESSION['success']) ?>
    <?php } ?>
    <div class="table">
        <table border>
            <tr>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama</th>
                <th>Harga</th>
                <?php if($_SESSION['user']['status'] == 'admin') {?>
                    <th>Aksi</th>
                <?php } ?>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($drugs as $drug) {?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $drug['kode_obat'] ?></td>
                    <td><?= $drug['nama'] ?></td>
                    <td>Rp. <?= number_format($drug['harga'], 0, '.', '.') ?></td>
                    <?php if($_SESSION['user']['status'] == 'admin') {?>
                        <td>
                            <a href="./edit.php?kode_obat=<?= $drug['kode_obat'] ?>" class="btn-primary"><i class="zmdi zmdi-edit"></i> Edit</a> |
                            <a href="" class="btn-danger" onclick="askToDelete('./hapus.php', '<?= $drug['nama'] ?>', '<?= $drug['kode_obat'] ?>')"><i class="zmdi zmdi-delete"></i> Hapus</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php $i++ ?>
            <?php } ?>
        </table>
    </div>
    <form action="" id="form-delete" method="POST">
        <input type="hidden" name="kode_obat" value="">
    </form>
    <div class="bg-rem"><img src="./public/images/rem.png" alt=""></div>
    <script>
        function askToDelete(url, nama_obat, kode_buku) {
            event.preventDefault();

            if(confirm(`Apakah kamu yakin akan akan menghapus obat ${nama_obat}`)) {
                const form_data = document.querySelector('#form-delete');
                form_data.setAttribute('action', url);
                form_data.querySelector('input').setAttribute('value', kode_buku);
                form_data.submit();
            }
        }
    </script>
</body>
</html>