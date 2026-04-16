<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
padding:40px;
}

table{
width:80%;
margin:auto;
border-collapse:collapse;
background:white;
}

th,td{
padding:10px;
border:1px solid #ddd;
text-align:center;
}

th{
background:#3490dc;
color:white;
}
</style>

</head>

<body>

<h2 align="center">Data Barang</h2>

<table>
<tr>
<th>ID</th>
<th>Kode Barang</th>
<th>Nama Barang</th>
<th>Stok</th>
<th>Harga</th>
</tr>

@foreach($barang as $b)
<tr>
<td>{{ $b->id }}</td>
<td>{{ $b->kode_barang }}</td>
<td>{{ $b->nama_barang }}</td>
<td>{{ $b->stok }}</td>
<td>{{ $b->harga }}</td>
</tr>
@endforeach

</table>

</body>
</html>