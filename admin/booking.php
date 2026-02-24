<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

// Hapus booking//
if(isset($_GET['hapus'])){

    $id_booking = mysqli_real_escape_string($koneksi, $_GET['hapus']);

    $delete = mysqli_query($koneksi,
        "DELETE FROM booking WHERE id='$id_booking'"
    );

    if(!$delete){
        die("Error Delete: " . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Booking berhasil dihapus');
            window.location='booking.php';
          </script>";
    exit;
}

//simpan//
if(isset($_POST['simpan'])){

    $id_ruangan   = mysqli_real_escape_string($koneksi, $_POST['id']);
    $tanggal      = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam_mulai    = mysqli_real_escape_string($koneksi, $_POST['jam_mulai']);
    $jam_selesai  = mysqli_real_escape_string($koneksi, $_POST['jam_selesai']);

    // Validasi jam
    if($jam_mulai >= $jam_selesai){
        echo "<script>
                alert('Jam selesai harus lebih besar dari jam mulai!');
                window.location='booking.php';
              </script>";
        exit;
    }

    // CEK BENTROK JADWAL
    $cek = mysqli_query($koneksi,"
        SELECT * FROM booking
        WHERE ruangan_id = '$id_ruangan'
        AND tanggal = '$tanggal'
        AND (
            ('$jam_mulai' < jam_selesai)
            AND
            ('$jam_selesai' > jam_mulai)
        )
    ");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>
                alert('Jadwal bentrok! Silakan pilih jam lain.');
                window.location='booking.php';
              </script>";
        exit;
    }

    // INSERT JIKA TIDAK BENTROK
    $insert = mysqli_query($koneksi,"INSERT INTO booking
        (user_id, ruangan_id, tanggal, jam_mulai, jam_selesai)
        VALUES
        ('$user_id','$id_ruangan','$tanggal','$jam_mulai','$jam_selesai')
    ");

    if(!$insert){
        die("Error Insert: " . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Booking berhasil disimpan');
            window.location='booking.php';
          </script>";
    exit;
}

$data_ruangan = mysqli_query($koneksi,"SELECT * FROM ruangan");

//search//
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$keyword = mysqli_real_escape_string($koneksi, $keyword);

$query = "
    SELECT booking.*, ruangan.nama_ruangan, users.nama
    FROM booking
    JOIN ruangan ON booking.ruangan_id = ruangan.id
    JOIN users ON booking.user_id = users.id
";

if(!empty($keyword)){
    $query .= " WHERE 
        users.nama LIKE '%$keyword%' OR
        ruangan.nama_ruangan LIKE '%$keyword%' OR
        booking.tanggal LIKE '%$keyword%'
    ";
}

$query .= " ORDER BY booking.tanggal DESC, booking.jam_mulai ASC";

$data_booking = mysqli_query($koneksi, $query);

if(!$data_booking){
    die("Query Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Booking Ruangan</title>
<style>
body{
    font-family:Arial;
    margin:0;
}
.content{
    margin-left:220px;
    padding:20px;
}
input, select{
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
    cursor:pointer;
}
button:hover{
    opacity:0.9;
}
.hapus-btn{
    background:red;
}
table{
    border-collapse:collapse;
    width:100%;
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
    background:#1e3a8a;
    color:white;
}
.search-box{
    margin-bottom:15px;
}
.search-box input{
    width:300px;
}
</style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">

<h2>Form Booking Ruangan</h2>

<form method="POST">

<label>Pilih Ruangan</label>
<select name="id" required>
    <option value="">-- Pilih Ruangan --</option>
    <?php while($r = mysqli_fetch_assoc($data_ruangan)){ ?>
        <option value="<?= $r['id'] ?>">
            <?= $r['nama_ruangan'] ?>
        </option>
    <?php } ?>
</select>

<label>Tanggal</label>
<input type="date" name="tanggal" required>

<label>Jam Mulai</label>
<input type="time" name="jam_mulai" required>

<label>Jam Selesai</label>
<input type="time" name="jam_selesai" required>

<button type="submit" name="simpan">Simpan Booking</button>

</form>

<hr>

<h2>Data Booking</h2>

<div class="search-box">
<form method="GET">
    <input type="text" name="keyword" 
        placeholder="Cari nama user / ruangan / tanggal..."
        value="<?= $keyword ?>">
    <button type="submit" style="background:#1e3a8a;">Search</button>
</form>
</div>

<table>
<tr>
    <th>No</th>
    <th>Nama User</th>
    <th>Ruangan</th>
    <th>Tanggal</th>
    <th>Jam</th>
    <!-- <th>Aksi</th> -->
</tr>

<?php 
$no = 1;
while($b = mysqli_fetch_assoc($data_booking)){ 
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $b['nama'] ?></td>
    <td><?= $b['nama_ruangan'] ?></td>
    <td><?= $b['tanggal'] ?></td>
    <td><?= $b['jam_mulai'] ?> - <?= $b['jam_selesai'] ?></td>
    <!-- <td>
        <a href="booking.php?hapus=<?= $b['id'] ?>" 
           onclick="return confirm('Yakin ingin menghapus booking ini?')">
            <button type="button" class="hapus-btn">Hapus</button>
        </a>
    </td> -->
</tr>
<?php } ?>

<?php if(mysqli_num_rows($data_booking) == 0){ ?>
<tr>
    <td colspan="6">Data tidak ditemukan</td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>