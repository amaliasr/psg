<?php 
// koneksi database
include '../dbconnect.php';
$id = $_GET['id'];
$sql ="SELECT * FROM barang_masuk WHERE id= '$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$keterangan = 'Disetujui';
// query SQL untuk insert data ke dalam Mysql
$sql = "UPDATE barang_masuk SET keterangan = '$keterangan' WHERE id = '$id'";
mysqli_query($conn, $sql);
// mengalihkan ke halaman masuk.php
echo "<script>alert('Status Sudah Diubah Menjadi Disetujui');window.location='masuk.php'</script>";
?>