<?php 
  session_start();
  if($_SESSION['user']==""){
		header("location:../index.php?pesan=belum_login");
	}
  
  include '../dbconnect.php';
  $id=$_POST['id'];
  $namasupplier=$_POST['namasupplier'];
  $namaperusahaan=$_POST['namaperusahaan'];
  $alamat=$_POST['alamat'];
  $email=$_POST['email'];
  $nohp=$_POST['nohp'];
	  
  $query = mysqli_query($conn,"INSERT INTO supplier VALUES('$id','$namasupplier','$namaperusahaan','$alamat','$email','$nohp')");
  if ($query){
    header('location:supplier.php');
  } 
  else{                 
    echo 'Gagal';
    header('location:supplier.php');
  }
?>
 
  <html>
  <head>
    <title>Tambah Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>