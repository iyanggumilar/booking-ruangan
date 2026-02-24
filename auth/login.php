<?php
session_start();
if(isset($_SESSION['login'])){
    header("Location: ../admin/dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color:#f8f9fa;
        }
        .login-card{
            width:380px;
            border:none;
            border-radius:12px;
            box-shadow:0 4px 20px rgba(0,0,0,0.08);
        }
        .form-control{
            border-radius:8px;
            padding:10px;
        }
        .btn-primary{
            border-radius:8px;
            padding:10px;
            font-weight:500;
        }
        .small-text{
            font-size:14px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card login-card p-4">
    
    <h4 class="text-center fw-bold mb-2">Masuk ke Akun Anda</h4>
    <p class="text-center text-muted small-text mb-4">
        Masukkan email dan password untuk melanjutkan
    </p>

    <form action="proses_login.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
        </div>

        <div class="mb-2">
            <div class="d-flex justify-content-between">
                <label class="form-label">Password</label>
            </div>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Masuk
        </button>
    </form>

    <p class="text-center mt-3 small-text">
        Belum punya akun? 
        <a href="register.php" class="text-decoration-none">Daftar sekarang</a>
    </p>

</div>

</body>
</html>