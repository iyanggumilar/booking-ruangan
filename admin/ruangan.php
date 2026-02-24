<?php
include "../config/koneksi.php";

// Proses upload
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp,"../upload/".$foto); // KUK 030 Multimedia

    mysqli_query($koneksi,"INSERT INTO ruangan VALUES(NULL,'$nama','$kapasitas','$fasilitas','$foto')");
}
?>