<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi,"SELECT * FROM ruangan WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// hapus foto dari folder
if($row['foto'] != "" && file_exists("../upload/".$row['foto'])){
    unlink("../upload/".$row['foto']);
}

mysqli_query($koneksi,"DELETE FROM ruangan WHERE id='$id'");

echo "<script>
        alert('Data berhasil dihapus');
        window.location='data_ruangan.php';
      </script>";