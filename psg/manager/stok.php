<!doctype html>
<html class="no-js" lang="en">
    <?php 
        include '../dbconnect.php';
        session_start();
        if($_SESSION['user']==""){
            header("location:../index.php?pesan=belum_login");
        }

        if(isset($_POST['update'])){
            $idx = $_POST['idbrg'];
            $nama = $_POST['nama'];
            $jenis = $_POST['jenis'];
            $harga = $_POST['harga'];
            $pic=$_SESSION['user'];

            $updatedata = mysqli_query($conn,"update stok_barang set nama='$nama', jenis='$jenis', harga='$harga', pic='$pic' where idx='$idx'");
        
            //cek apakah berhasil
            if ($updatedata){
                header('location:stok.php');
            }
            else{
                echo 'Gagal';
                header('location:stok.php');
            }
        };

        //Hapus
        if(isset($_POST['hapus'])){
            $idx = $_POST['idbrg'];

            $delete = mysqli_query($conn,"delete from stok_barang where idx='$idx'");
            //hapus juga semua data barang ini di tabel keluar-masuk
            $deltabelkeluar = mysqli_query($conn,"delete from barang_keluar where id='$idx'");
            $deltabelmasuk = mysqli_query($conn,"delete from barang_masuk where id='$idx'");
        
            //cek apakah berhasil
            if ($delete && $deltabelkeluar && $deltabelmasuk){
                header('location:stok.php');
            }
            else{ 
                echo 'Gagal';
                header('location:stok.php');
            }
        };
	?>

    <head>
        <meta charset="utf-8">
	    <link rel="icon" 
        type="image/png" 
        href="../favicon.png">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Stok Barang - Purata Samasta Gemilang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/metisMenu.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.min.css">
	    <!-- Global site tag (gtag.js) - Google Analytics -->
	    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	    <script>
	        window.dataLayer = window.dataLayer || [];
	        function gtag(){dataLayer.push(arguments);}
	        gtag('js', new Date());
	        gtag('config', 'UA-144808195-1');
	    </script>
        <!-- amchart css -->
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	    <!-- Start datatable css -->
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
		<!-- Favicons -->
        <link href="assets/images/icon.png" rel="icon">
        <link href="assets/images/icon.png" rel="apple-touch-icon">
        <!-- others css -->
        <link rel="stylesheet" href="assets/css/typography1.css">
        <link rel="stylesheet" href="assets/css/default-css.css">
        <link rel="stylesheet" href="assets/css/styles5.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- modernizr css -->
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>
        <!-- preloader area start -->
        <div id="preloader">
            <div class="loader"></div>
        </div>
        <!-- preloader area end -->
        <!-- page container area start -->
        <div class="page-container">
            <!-- sidebar menu area start -->
            <div class="sidebar-menu">
                <div class="sidebar-header">
                    <a href="index.php"><img src="../psglogo.jpg" alt="logo" width="100%"></a>
                </div>
                <div class="main-menu">
                    <div class="menu-inner">
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li>
                                    <a href="index.php"><span>Data Admin</span></a>
                                </li>
                                <li>
                                    <a href="stok.php"><span><b>Stok Barang</b></span></a>
                                </li>
                                <li>
                                    <a href="masuk.php"><span>Barang Masuk</span></a> 
                                </li>
                                <li>
                                    <a href="keluar.php"><span>Barang Keluar</span></a>
                                </li>
                                <li>
                                    <a href="supplier.php"><span>Master Supplier</span></a>
                                </li>     
                                <li class="active">
                                    <a href="customer.php"><span>Master Customer</span></a>
                                </li>  
                                <li>
                                    <a href="logout.php"><span>Keluar</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                            <h3><?=$_SESSION['jabatan'];?> : <?=$_SESSION['user'];?></h3>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header area end -->
			<?php 
				$periksa_bahan=mysqli_query($conn,"select * from stok_barang where stock <1");
				while($p=mysqli_fetch_array($periksa_bahan)){	
					if($p['stock']<=1){	
						?>	
						<script>
							$(document).ready(function(){
								$('#pesan_sedia').css("color","white");
								$('#pesan_sedia').append("<i class='ti-flag'></i>");
							});
						</script>
						<?php
						echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>".$p['nama']. "</u> &nbsp <u>"."</u></strong> yang tersisa sudah habis</div>";		
					}
				}
			?>
			
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Barang</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
                                </div>
                                    <div class="datatable-dark table-responsive">
										<table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
											<th>No</th>
                                            <th>Jenis</th>
											<th>Nama Barang</th>
										    <th>Stok</th>
											<th>Harga</th>
                                            <th>PIC</th>
											<th>Aksi</th>
											</tr></thead><tbody>
											<?php 
											    $brgs=mysqli_query($conn,"SELECT * from stok_barang order by nama ASC");
											    $no=1;
											    while($p=mysqli_fetch_array($brgs)){
                                                $idb = $p['idx'];
												?>
												
												<tr>
												<td><?php echo $no++ ?></td>
                                                <td><?php echo $p['jenis'] ?></td>
												<td><?php echo $p['nama'] ?></td>
												<td><?php echo $p['stock'] ?></td>
												<td><?php echo "Rp " . number_format($p['harga'],0,',','.') ?></td>
                                                <td><?php echo $p['pic'] ?></td>
                                                <td><button data-toggle="modal" data-target="#edit<?=$idb;?>" class="btn btn-warning">Edit</button></td>
												</tr>
                                                <!-- The Modal -->
                                                <div class="modal fade" id="edit<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Barang <?php echo $p['nama']?> - <?php echo $p['jenis']?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                            
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <label for="nama">Nama</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $p['nama'] ?>">

                                                                    <label for="jenis">Jenis</label>
                                                                    <select name="jenis" class="custom-select form-control">
                                                                        <option selected><?php echo $p['jenis'] ?></option>
                                                                        <option value="RM">Raw Materials (Bahan Baku)</option>
                                                                        <option value="FG">Finished Goods (Barang Jadi)</option>
                                                                    </select>

                                                                    <label for="stock">Stok</label>
                                                                    <input type="text" id="stock" name="stock" class="form-control" value="<?php echo $p['stock'] ?>" disabled>

                                                                    <label for="harga">Harga</label>
                                                                    <input type="text" id="harga" name="harga" class="form-control" value="<?php echo $p['harga'] ?>">

                                                                    <label>PIC</label>
                                                                    <input name="pic" type="text" class="form-control" value="<?=$_SESSION['user'];?>" disabled>
                                                                    <input type="hidden" name="idbrg" value="<?=$idb;?>">
                                                                </div>
                                                            
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-success" name="update">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- The Modal -->
                                                <div class="modal fade" id="del<?=$idb;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Barang <?php echo $p['nama']?> - <?php echo $p['jenis']?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                            
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus barang ini dari daftar stok barang?
                                                                    <input type="hidden" name="idbrg" value="<?=$idb;?>">
                                                                </div>
                                                            
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

												<?php 
											        }
											    ?>
                                                

										    </tbody>
										</table>
                                    </div>
                                            <p>*RM: Raw Materials (Bahan Baku) , FG: Finished Goods (Bahan Jadi)</p>
                                        <hr>
									<a href="laporanstok.php" target="_blank" class="btn btn-secondary">Export Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->
	
	<!-- modal input -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Masukkan barang</h4>
						</div>
						<div class="modal-body">
							<form action="barang_stok_aksi.php" method="post">
								<div class="form-group">
									<label>Nama</label>
									<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
								</div>
								<div class="form-group">
									<label>Jenis</label>
                                    <select name="jenis" class="custom-select form-control">
                                        <option selected>Pilih Jenis</option>
                                        <option value="RM">Raw Materials (Bahan Baku)</option>
                                        <option value="FG">Finished Goods (Barang Jadi)</option>
                                    </select>
                                </div>
								<div class="form-group">
									<label>Jumlah</label>
									<input name="stock" type="number" min="1" max="1000" class="form-control" placeholder="Jumlah">
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input name="harga" type="text" class="form-control" placeholder="Harga barang">
								</div>

                                <div class="form-group">
                                    <label>PIC</label>
                                    <input name="pic" type="text" class="form-control" value="<?=$_SESSION['user'];?>" disabled>
                                </div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	
	<script>
		$(document).ready(function() {
		$('input').on('keydown', function(event) {
			if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
			   var $t = $(this);
			   event.preventDefault();
			   var char = String.fromCharCode(event.keyCode);
			   $t.val(char + $t.val().slice(this.selectionEnd));
			   this.setSelectionRange(1,1);
			}
		});
	});
	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
	
</body>

</html>
