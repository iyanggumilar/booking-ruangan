<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

// PROSES SIMPAN DATA
if(isset($_POST['simpan'])){

    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];

    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];

    if($nama_file != ""){
        $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = time().".".$ext;
        move_uploaded_file($tmp_file, "../upload/".$nama_baru);
    } else {
        $nama_baru = "";
    }

    mysqli_query($koneksi,"INSERT INTO ruangan 
        (nama_ruangan, kapasitas, fasilitas, foto)
        VALUES ('$nama','$kapasitas','$fasilitas','$nama_baru')
    ");

    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location='data_ruangan.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ruangan</title>
    <style>
        body{font-family:Arial;margin:0;}
        .content{margin-left:220px;padding:20px;}
        input, textarea{
            width:100%;
            padding:8px;
            margin:5px 0 15px 0;
        }
        button{
            padding:8px 15px;
            background:green;
            color:white;
            border:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">
    <h2>Tambah Ruangan</h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Nama Ruangan</label>
        <input type="text" name="nama_ruangan" required>

        <label>Kapasitas</label>
        <input type="number" name="kapasitas" required>

        <label>Fasilitas</label>
        <textarea name="fasilitas" required></textarea>

        <label>Foto Ruangan</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit" name="simpan">Simpan</button>
    </form>
</div>

</body>
</html>