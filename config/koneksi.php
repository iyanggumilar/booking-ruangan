<?php
// KUK 021 - Akses DB menggunakan MySQLi
$koneksi = mysqli_connect("localhost","root","","booking_db");

if(!$koneksi){
    die("Koneksi Gagal : ".mysqli_connect_error());
}
?>