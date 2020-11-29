<?php 
require_once('./Helpers/function.php');

if(isset($_POST['kode_obat'])) {
    $delete = delete($_POST['kode_obat']);
    if($delete) {
        $_SESSION['success'] = 'obat ' . $delete['nama'] . ' telah dihapus';
        header('Location: ./index.php');
        exit();
    } else {
        header('Location: ./index.php');
        exit();
    }
} else {
    header('Location: ./index.php');
    exit();
}