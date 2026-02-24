<?php
session_start();
include "../config/koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$data = mysqli_query($koneksi,"SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($data);

if($user){
    if(password_verify($password,$user['password'])){
        $_SESSION['login'] = true;
        $_SESSION['user'] = $user;
        header("Location: ../admin/dashboard.php");
    }else{
        echo "Password Salah"; // Debug sederhana
    }
}else{
    echo "User Tidak Ditemukan";
}
?>