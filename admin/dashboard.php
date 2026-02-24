<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$jml_user = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM users"));
$jml_ruangan = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM ruangan"));
$jml_booking = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM booking"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body{
            margin:0;
            background:#f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .content{
            margin-left:220px;
            padding:30px;
        }

        .dashboard-card{
            background:white;
            border-radius:12px;
            padding:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .icon-box{
            width:50px;
            height:50px;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
        }

        .icon-blue{ background:#e0edff; color:#3b82f6; }
        .icon-green{ background:#d1fae5; color:#10b981; }
        .icon-orange{ background:#fef3c7; color:#f59e0b; }

        .card-title{
            font-size:14px;
            color:#6c757d;
            margin-bottom:5px;
        }

        .card-value{
            font-size:22px;
            font-weight:600;
        }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content">
    <h4 class="mb-4">Dashboard</h4>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="dashboard-card">
                <div>
                    <div class="card-title">Total User</div>
                    <div class="card-value"><?= $jml_user ?></div>
                </div>
                <div class="icon-box icon-blue">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div>
                    <div class="card-title">Total Ruangan</div>
                    <div class="card-value"><?= $jml_ruangan ?></div>
                </div>
                <div class="icon-box icon-green">
                    <i class="bi bi-building"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card">
                <div>
                    <div class="card-title">Total Booking</div>
                    <div class="card-value"><?= $jml_booking ?></div>
                </div>
                <div class="icon-box icon-orange">
                    <i class="bi bi-calendar-check"></i>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>