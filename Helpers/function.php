<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'apotek');

function create($data, $table_name) {
    global $conn;

    $keys   = [];
    $values = [];

    foreach($data as $key => $value) {
        $keys[]     = $key;
        $values[]   = "'" . $value . "'";
    }

    $keys   = join($keys, ',');
    $values = join($values, ',');

    $query = "INSERT INTO $table_name ($keys) VALUES($values)";
    $sql   = mysqli_query($conn, $query);

    return [$data, $sql];
}


function tampilkan($query) {
    global $conn;
    $sql = mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    
    return $rows;
}


function delete($kode_obat) {
    global $conn;

    $find_row = mysqli_query($conn, "SELECT * FROM obat WHERE kode_obat = '$kode_obat'");

    if(mysqli_num_rows($find_row) > 0 ) {
        $sql = "DELETE FROM obat WHERE kode_obat = '$kode_obat'";
        $query = mysqli_query($conn, $sql);

        if(mysqli_affected_rows($conn)) {
            return mysqli_fetch_assoc($find_row);
        }
    }

    return null;
}


function update($data, $kode_obat) {
    global $conn;

    $nama      = $data['nama'];
    $harga     = $data['harga'];

    $sql = "UPDATE obat SET nama = '$nama', harga = $harga WHERE kode_obat = '$kode_obat'";
    $query = mysqli_query($conn, $sql);

    $_SESSION['success'] = 'obat ' . $nama . ' telah diupdate';
    header('Location: ./index.php');
    exit();
}

function checkLogedIn()
{
    if(!isset($_SESSION['user'])) {
        header('Location: ./login.php');
    }
}

function redirectIfAuth()
{
    if(isset($_SESSION['user'])) {
        header('Location: ./index.php');
        exit();
    }
}

function logout()
{
    unset($_SESSION['user']);
    header('Location: ./login.php');
    exit();
}

function register($data)
{
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $status = $data['status'];

    foreach ($data as $user) {
        if(is_null($user) || $user == '') {
            $_SESSION['failed'] = 'Field Tidak Boleh Kosong';
            header('Location: ./register.php');
            exit();
        }
    }

    $is_created = create([
        'name'      => $name,
        'email'     => $email,
        'password'  => password_hash($password, PASSWORD_DEFAULT),
        'status'    => $status,
    ], 'users');

    if(!$is_created[1]) {
        $_SESSION['failed'] = 'Email Sudah Digunakan';
        header('Location: ./register.php');
        exit();
    }

    $_SESSION['success'] = 'Registrasi Akun Berhasil';
    header('Location: ./login.php');
    exit();
}

function login($data)
{
    foreach ($data as $user) {
        if(is_null($user) || $user == '') {
            $_SESSION['failed'] = 'Field Tidak Boleh Kosong';
            header('Location: ./login.php');
            exit();
        }
    }

    $email    = $data['email'];
    $password = $data['password'];
    
    $user = tampilkan("SELECT * FROM users WHERE email = '$email'")[0];


    if($user != null) {
        if(password_verify($password, $user['password'])) {
            $_SESSION['user']['id']    = $user['id'];
            $_SESSION['user']['name']  = $user['name'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['status'] = $user['status'];

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['failed'] = 'Password anda salah';
            header('Location: ./login.php');
            exit();
        }
    } else {
        $_SESSION['failed'] = 'Akun tidak ditemukan';
        header('Location: ./login.php');
        exit();
    }
}