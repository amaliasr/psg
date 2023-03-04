<?php 
  session_start();
  if($_SESSION['user']==""){
		header("location:../index.php?pesan=belum_login");
	}
  
  include '../dbconnect.php';
  $nama=$_POST['nama'];
  $jenis=$_POST['jenis'];
  $stock=$_POST['stock'];
  $harga=$_POST['harga'];
  $pic=$_SESSION['user'];
	  
  $query = mysqli_query($conn,"insert into stok_barang values('','$nama','$jenis','$stock','$harga','$pic')");
  if ($query){
    header('location:stok.php');
  } 
  else{                 
    echo 'Gagal';
    header('location:stok.php');
  }
?>
 
  <html>
  <head>
    <title>Tambah Barang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>