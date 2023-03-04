<!doctype html>
<html class="no-js" lang="en">
    <?php 
        include '../dbconnect.php';
        session_start();
        if($_SESSION['user']==""){
            header("location:../index.php?pesan=belum_login");
        }

        if(isset($_POST['update'])){
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $nohp = $_POST['nohp'];
            $jabatan = $_POST['jabatan'];

            $updatedata = mysqli_query($conn,"UPDATE admin set username='$username', password='$password', nickname='$nickname', email='$email', nohp='$nohp', jabatan='$jabatan' where id='$id'");
        
            //cek apakah berhasil
            if ($updatedata){
                header('location:index.php');
            }
            else{
                echo 'Gagal';
                header('location:index.php');
            }
        };

        if(isset($_POST['hapus'])){
            $id = $_POST['id'];

            $delete = mysqli_query($conn,"delete from admin where id='$id'");
            //cek apakah berhasil
            header('location:index.php');

        };
	?>

    <head>
        <meta charset="utf-8">
	    <link rel="icon" 
        type="image/png" 
        href="../favicon.png">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home - Purata Samasta Gemilang</title>
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
                                <li class="active">
                                    <a href="index.php"><span><b>Data Admin</b></span></a>
                                </li>
                                <li>
                                    <a href="stok.php"><span>Stok Barang</span></a>
                                </li>
							    <li>
                                    <a href="masuk.php"><span>Barang Masuk</span></a> 
                                </li>
                                <li>
                                    <a href="keluar.php"><span>Barang Keluar</span></a>
                                </li>
                                <li>
                                    <a href="supplier.php"><span>Data Supplier</span></a>
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
                                <h3>Admin : <?=$_SESSION['user'];?></h3>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header area end -->
			
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Data Admin</h2>
									<!-- <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button> -->
                                </div>
                                    <div class="datatable-dark table-responsive">
										<table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
											<th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
											<th>Email</th>
										    <th>No. HP</th>
											<th>Jabatan</th>
                                            <!-- <th>Aksi</th> -->
											</tr></thead><tbody>
											<?php 
											    $brgs=mysqli_query($conn,"SELECT * from admin");
											    $no=1;
											    while($p=mysqli_fetch_array($brgs)){
                                                    $id = $p['id'];
												?>
												
												<tr>
												<td><?php echo $no++ ?></td>
                                                <td><?php echo $p['nickname'] ?></td>
                                                <td><?php echo $p['username'] ?></td>
												<td><?php echo $p['email'] ?></td>
												<td><?php echo $p['nohp'] ?></td>
                                                <td><?php echo $p['jabatan'] ?></td>
                                                <!-- <td>
                                                    <button data-toggle="modal" data-target="#edit<?=$id;?>" class="btn btn-warning">Edit</button> 
                                                    <button data-toggle="modal" data-target="#del<?=$id;?>" class="btn btn-danger">Hapus</button>
                                                </td> -->
												</tr>
                                                <!-- The Modal -->
                                                <div class="modal fade" id="edit<?=$id;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Data</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                            
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <label for="username">Username</label>
                                                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $p['username'] ?>">

                                                                    <label for="password">Password</label>
                                                                    <input type="text" id="password" name="password" class="form-control" value="<?php echo $p['password'] ?>">

                                                                    <label for="nickname">Nama</label>
                                                                    <input type="text" id="nickname" name="nickname" class="form-control" value="<?php echo $p['nickname'] ?>">

                                                                    <label for="email">Email</label>
                                                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $p['email'] ?>">

                                                                    <label for="nohp">No. HP</label>
                                                                    <input type="text" id="nohp" name="nohp" class="form-control" value="<?php echo $p['nohp'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">

                                                                    <label for="jabatan">Jabatan</label>
                                                                    <select name="jabatan" class="custom-select form-control">
                                                                        <option selected><?php echo $p['jabatan'] ?></option>
                                                                        <option value="Manager">Manager</option>
                                                                        <option value="Direktur">Direktur</option>
                                                                        <option value="Karyawan">Karyawan</option>
                                                                    </select>

                                                                    <input type="hidden" name="id" value="<?=$id;?>">
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
                                                <div class="modal fade" id="del<?=$id;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="post">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Data Admin <?php echo $p['nickname']?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                            
                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data ini dari data admin?
                                                                    <input type="hidden" name="id" value="<?=$id;?>">
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
			<!-- <div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Data</h4>
						</div>
						<div class="modal-body">
							<form action="admin_aksi.php" method="post">
                                <div class="form-group">
									<label>Username</label>
									<input name="username" type="text" class="form-control" placeholder="Username" required>
								</div>
                                <div class="form-group">
									<label>Password</label>
									<input name="password" type="text" class="form-control" placeholder="password" required>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input name="nickname" type="text" class="form-control" placeholder="Nama" required>
								</div>
                                <div class="form-group">
									<label>Email</label>
									<input name="email" type="email" class="form-control" placeholder="Email" required>
								</div>
                                <div class="form-group">
									<label>No. HP</label>
									<input name="nohp" type="text" class="form-control" placeholder="No. HP" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
								</div>
								<div class="form-group">
									<label>Jabatan</label>
                                    <select name="jabatan" class="form-control">
                                        <option selected>Pilih Jabatan</option>
                                        <option value="Direktur">Direktur</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Karyawan">Karyawan</option>
                                    </select>
                                </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div> -->
	
	<!-- <script>
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
	</script> -->
	
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
