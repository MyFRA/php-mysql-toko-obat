<?php 
    require_once './Helpers/function.php';
    unset($_SESSION['user']);
    header('Location: ./login.php');
    exit();
?>