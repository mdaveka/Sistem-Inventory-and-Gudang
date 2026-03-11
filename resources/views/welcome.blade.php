<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Inventory Gudang</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    background:#f5f7fb;
}

/* Navbar */
nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 60px;
    background:white;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

nav h2{
    color:#2c3e50;
}

nav a{
    text-decoration:none;
    margin-left:20px;
    color:#333;
    font-weight:bold;
}

/* Hero */
.hero{
    height:90vh;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:20px;
}

.hero h1{
    font-size:48px;
    color:#2c3e50;
}

.hero p{
    margin:20px 0;
    font-size:18px;
    color:#555;
}

.btn{
    padding:12px 25px;
    background:#3498db;
    color:white;
    border:none;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}

/* Features */
.features{
    display:flex;
    justify-content:center;
    gap:30px;
    padding:60px;
}

.card{
    background:white;
    padding:25px;
    width:250px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    text-align:center;
}

.card h3{
    margin-bottom:10px;
}

footer{
    text-align:center;
    padding:20px;
    background:#2c3e50;
    color:white;
}
</style>

</head>
<body>

<!-- Navbar -->
<nav>
<h2>InventoryApp</h2>
<div>
<a href="#">Home</a>
<a href="#">Fitur</a>
<a href="#">Login</a>
</div>
</nav>

<!-- Hero -->
<section class="hero">
<div>
<h1>Sistem Inventory Gudang</h1>
<p>Mengelola stok barang, supplier, dan transaksi gudang dengan mudah.</p>
<a class="btn" href="#">Mulai Sekarang</a>
</div>
</section>

<!-- Features -->
<section class="features">
<div class="card">
<h3>📦 Manajemen Barang</h3>
<p>Mengelola data barang dengan cepat dan rapi.</p>
</div>

<div class="card">
<h3>📊 Monitoring Stok</h3>
<p>Memantau stok masuk dan keluar secara realtime.</p>
</div>

<div class="card">
<h3>🔐 Sistem Aman</h3>
<p>Dilengkapi login dan sistem keamanan data.</p>
</div>
</section>

<footer>
<p>© 2026 Sistem Inventory Gudang</p>
</footer>

</body>
</html>