<?php
session_start();
include "../config/koneksi.php";

$nama = htmlspecialchars($_POST['nama']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

// Insert ke database
mysqli_query($koneksi,"INSERT INTO users VALUES(NULL,'$nama','$email','$password','user')");

header("Location: login.php");
?>