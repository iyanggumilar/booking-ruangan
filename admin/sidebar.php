<!-- Tambahkan ini di <head> jika belum ada -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="sidebar">
    <h2 class="logo">Booking App</h2>

    <ul class="menu">
        <li>
            <a href="dashboard.php">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="data_ruangan.php">
                <i class="bi bi-building"></i> Data Ruangan
            </a>
        </li>
        <li>
            <a href="booking.php">
                <i class="bi bi-calendar-check"></i> Booking Ruangan
            </a>
        </li>
    </ul>

    <div class="logout">
        <a href="../auth/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
}

.sidebar{
    width:220px;
    height:100vh;
    background:#261CC1;
    color:white;
    position:fixed;
    display:flex;
    flex-direction:column;
    padding-top:25px;
}

.logo{
    text-align:center;
    font-weight:600;
    font-size:20px;
    margin-bottom:40px;
}

.menu{
    list-style:none;
    padding:0;
    margin:0;
}

.menu li{
    margin:5px 10px;
}

.menu li a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px 12px;
    color:white;
    text-decoration:none;
    font-size:15px;
    border-radius:8px;
    transition:0.3s;
}

.menu li a:hover{
    background:#3b82f6;
}

.logout{
    margin-top:auto;
    padding:0 20px 40px 20px; 
}

.logout a{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    background:#dc3545;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    font-weight:500;
    transition:0.3s;
}

.logout a:hover{
    background:#bb2d3b;
}
</style>