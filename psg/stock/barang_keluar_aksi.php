<?php 
  session_start();
  if($_SESSION['user']==""){
		header("location:../index.php?pesan=belum_login");
	}
  
  include '../dbconnect.php';
  $barang=$_POST['barang']; //id barang
  $qty=$_POST['qty'];
  $tanggal=$_POST['tanggal'];
  $nsj=$_POST['nsj'];
  $penerima=$_POST['penerima'];
  $ket=$_POST['ket'];
  $pic=$_SESSION['user'];

  $cekstokskrg = mysqli_query($conn,"select * from stok_barang where idx='$barang'");
  $data = mysqli_fetch_array($cekstokskrg);

  $stokskrg = $data['stock'];

  if($stokskrg >= $qty){
    $sisa = $stokskrg-$qty;
    $query1 = mysqli_query($conn,"update stok_barang set stock='$sisa' where idx='$barang'");
    $query2 = mysqli_query($conn,"insert into barang_keluar (idx,tgl,nsj,jumlah,penerima,keterangan,pic) values('$barang','$tanggal','$nsj','$qty','$penerima','$ket','$pic')");

    if($query1 && $query2){
      header('location:keluar.php');
    }
    else{
      echo 'Gagal';
      header('location:keluar.php');
    }
  }
  else{
    //Barang tidak cukup
    echo'
    <script>
    alert("Stok saat ini tidak mencukupi");
    window.location.href="keluar.php";
    </script>
    ';
  }
?>

<html>
  <head>
    <title>Barang Keluar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
</html>