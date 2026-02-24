<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM ruangan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Ruangan</title>
    <style>
        body{
            font-family: Arial;
            margin:0;
        }
        .content{
            margin-left:220px;
            padding:20px;
        }
        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }
        table, th, td{
            border:1px solid #ccc;
        }
        th, td{
            padding:10px;
            text-align:center;
        }
        th{
            background:#2c3e90;
            color:white;
        }
        .btn{
            padding:5px 10px;
            text-decoration:none;
            border-radius:4px;
            color:white;
            font-size:13px;
        }
        .btn-edit{
            background:orange;
        }
        .btn-hapus{
            background:red;
        }
        .btn-tambah{
            background:green;
            padding:8px 15px;
            display:inline-block;
            margin-top:10px;
        }
        img{
            width:140px;  
            height:100px;       
            object-fit:cover;   
            border-radius:10px;
            box-shadow:0 3px 10px rgba(0,0,0,0.15);
            transition:0.3s;
            }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">
    <h2>Data Ruangan</h2>

    <a href="tambah_ruangan.php" class="btn btn-tambah">+ Tambah Ruangan</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Kapasitas</th>
            <th>Fasilitas</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $no = 1;
        while($row = mysqli_fetch_assoc($data)) :
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_ruangan']; ?></td>
            <td><?= $row['kapasitas']; ?></td>
            <td><?= $row['fasilitas']; ?></td>
            <td>
                <?php if($row['foto'] != ""){ ?>
                    <img src="../upload/<?= $row['foto']; ?>">
                <?php } else { ?>
                    Tidak ada foto
                <?php } ?>
            </td>
            <td>
                <a href="edit_ruangan.php?id=<?= $row['id']; ?>" 
                   class="btn btn-edit">
                   Edit
                </a>

                <a href="hapus_ruangan.php?id=<?= $row['id']; ?>" 
                   class="btn btn-hapus"
                   onclick="return confirm('Yakin hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>
</div>

</body>
</html>