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

if(isset($_POST['update'])){

    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];

    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];

    if($nama_file != ""){

        // hapus foto lama jika ada
        if($row['foto'] != "" && file_exists("../upload/".$row['foto'])){
            unlink("../upload/".$row['foto']);
        }

        $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = time().".".$ext;
        move_uploaded_file($tmp_file, "../upload/".$nama_baru);

        mysqli_query($koneksi,"UPDATE ruangan SET
            nama_ruangan='$nama',
            kapasitas='$kapasitas',
            fasilitas='$fasilitas',
            foto='$nama_baru'
            WHERE id='$id'
        ");

    } else {

        mysqli_query($koneksi,"UPDATE ruangan SET
            nama_ruangan='$nama',
            kapasitas='$kapasitas',
            fasilitas='$fasilitas'
            WHERE id='$id'
        ");
    }

    echo "<script>
            alert('Data berhasil diupdate');
            window.location='data_ruangan.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Ruangan</title>
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
    background:orange;
    color:white;
    border:none;
    border-radius:5px;
}
img{
    width:120px;
    margin-bottom:10px;
}
</style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">
<h2>Edit Ruangan</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Ruangan</label>
<input type="text" name="nama_ruangan" value="<?= $row['nama_ruangan'] ?>" required>

<label>Kapasitas</label>
<input type="number" name="kapasitas" value="<?= $row['kapasitas'] ?>" required>

<label>Fasilitas</label>
<textarea name="fasilitas" required><?= $row['fasilitas'] ?></textarea>

<label>Foto Lama</label><br>
<?php if($row['foto'] != ""){ ?>
    <img src="../upload/<?= $row['foto'] ?>">
<?php } else { echo "Tidak ada foto"; } ?>

<br><br>
<label>Ganti Foto (Opsional)</label>
<input type="file" name="foto" accept="image/*">

<button type="submit" name="update">Update</button>

</form>
</div>

</body>
</html>