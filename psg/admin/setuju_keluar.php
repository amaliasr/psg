<?php
// koneksi database
include '../dbconnect.php';
$id = $_GET['id'];
$sql = "SELECT * FROM barang_keluar WHERE id= '$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$keterangan = 'Disetujui';
// query SQL untuk insert data ke dalam Mysql
$sql = "UPDATE barang_keluar SET keterangan = '$keterangan' WHERE id = '$id'";
mysqli_query($conn, $sql);
// mengalihkan ke halaman keluar.php
echo "<script>alert('Status Sudah Diubah Menjadi Disetujui');window.location='keluar.php'</script>";
