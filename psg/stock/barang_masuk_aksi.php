<?php 
  session_start();
  if($_SESSION['user']==""){
		header("location:../index.php?pesan=belum_login");
	}
  
  include '../dbconnect.php';
  $barang=$_POST['barang']; // ini ID barang nya
  $qty=$_POST['qty'];
  $tanggal=$_POST['tanggal'];
  $npo=$_POST['npo'];
  $ket=$_POST['ket'];
  $pic=$_SESSION['user'];

  $dt=mysqli_query($conn,"select * from stok_barang where idx='$barang'");
  $data=mysqli_fetch_array($dt);
  $sisa=$data['stock']+$qty;
  $query1 = mysqli_query($conn,"update stok_barang set stock='$sisa' where idx='$barang'");
  $query2 = mysqli_query($conn,"insert into barang_masuk (idx,tgl,npo,jumlah,keterangan,pic) values('$barang','$tanggal','$npo','$qty','$ket','$pic')");

  if($query1 && $query2){
    header('location:masuk.php');
  }
  else{
    echo 'Gagal';
    header('location:masuk.php');
  }
?>

<html>
  <head>
    <title>Barang Masuk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
</html>