<!doctype html>
<html class="no-js" lang="en">

<?php 
    include '../dbconnect.php';
    session_start();
    if($_SESSION['user']==""){
		header("location:../index.php?pesan=belum_login");
	}

    if(isset($_POST['update'])){
        $id = $_POST['id']; //iddata
        $idx = $_POST['idx']; //idbarang
        $jumlah = $_POST['jumlah'];
        $penerima = $_POST['penerima'];
        $keterangan = $_POST['keterangan'];
        $tanggal = $_POST['tanggal'];
        $nsj = $_POST['nsj'];
        $pic=$_SESSION['user'];

        //stok barang saat ini
        $lihatstock = mysqli_query($conn,"select * from stok_barang where idx='$idx'");
        $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
        $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

        //jumlah stok barang saat ini
        $jumlahskrg = mysqli_query($conn,"select * from barang_keluar where id='$id'");
        $preqtyskrg = mysqli_fetch_array($jumlahskrg); 
        $qtyskrg = $preqtyskrg['jumlah'];//jumlah skrg

        if($jumlah >= $qtyskrg){
            //ternyata inputan baru lebih besar jumlah keluarnya, maka kurangi lagi stock barang
            $hitungselisih = $jumlah - $qtyskrg;
            $kurangistock = $stockskrg - $hitungselisih;

            if($hitungselisih <= $stockskrg){
                $queryx = mysqli_query($conn,"update stok_barang set stock='$kurangistock' where idx='$idx'");
                $updatedata1 = mysqli_query($conn,"update barang_keluar set tgl='$tanggal', nsj='$nsj', jumlah='$jumlah',penerima='$penerima',keterangan='$keterangan',pic='$pic' where id='$id'");
            
                //cek apakah berhasil
                if ($updatedata1 && $queryx){
                    header('location:keluar.php');
                    }
                else {
                    echo 'Gagal';
                    header('location:keluar.php');
                };
            }
            else{
                echo'
                <script>
                    alert("Jumlah barang yang diinputkan melebihi stok barang saat ini");
                    window.location.href="keluar.php";
                </script>
                ';
            }

            

        } else {
            //ternyata inputan baru lebih kecil jumlah keluarnya, maka tambahi lagi stock barang
            $hitungselisih = $qtyskrg-$jumlah;
            $tambahistock = $stockskrg+$hitungselisih;

            $query1 = mysqli_query($conn,"update stok_barang set stock='$tambahistock' where idx='$idx'");

            $updatedata = mysqli_query($conn,"update barang_keluar set tgl='$tanggal', nsj='$nsj', jumlah='$jumlah', penerima='$penerima', keterangan='$keterangan' where id='$id'");
            
            //cek apakah berhasil
            if ($query1 && $updatedata){
                header('location:keluar.php');
                } 
            else{ 
                echo 'Gagal';
                header('location:keluar.php');
            };

        };


        
    };

    if(isset($_POST['hapus'])){
        $id = $_POST['id'];
        $idx = $_POST['idx'];

        $lihatstock = mysqli_query($conn,"select * from stok_barang where idx='$idx'"); //lihat stock barang itu saat ini
        $stocknya = mysqli_fetch_array($lihatstock); //ambil datanya
        $stockskrg = $stocknya['stock'];//jumlah stocknya skrg

        $lihatdataskrg = mysqli_query($conn,"select * from barang_keluar where id='$id'"); //lihat qty saat ini
        $preqtyskrg = mysqli_fetch_array($lihatdataskrg); 
        $qtyskrg = $preqtyskrg['jumlah'];//jumlah skrg

        $adjuststock = $stockskrg+$qtyskrg;

        $queryx = mysqli_query($conn,"update stok_barang set stock='$adjuststock' where idx='$idx'");
        $del = mysqli_query($conn,"delete from barang_keluar where id='$id'");

        
        //cek apakah berhasil
        if ($queryx && $del){
            header('location:keluar.php');
            } 
        else{ 
            echo 'Gagal';
            header('location:keluar.php');
        }
    };
	?>

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Barang Keluar - Purata Samasta Gemilang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
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
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography1.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles5.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start-->
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
                                    <a href="stok.php"><span>Stok Barang</span></a>
                                </li>
							    <li>
                                    <a href="masuk.php"><span>Barang Masuk</span></a> 
                                </li>
                                <li class="active">
                                    <a href="keluar.php"><span><b>Barang Keluar</b></span></a>
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
									<h2>Barang Keluar</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-success col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
                                </div>
                                <div class="market-status-table mt-4">
                                    <div class="datatable-dark table-responsive">
										 <table id="dataTable3" class="table table-hover"><thead class="thead-dark">
											<tr>
											<th>No</th>
											<th>Tanggal</th>
                                            <th>Nomor Surat Jalan</th>
                                            <th>Jenis Barang</th>
											<th>Nama Barang</th>
											<th>Jumlah</th>
											<th>Penerima</th>
											<th>Keterangan</th>
                                            <th>PIC</th>
											<th>Aksi</th>
											</tr></thead><tbody>
											<?php 
											$brg=mysqli_query($conn,"SELECT * FROM barang_keluar sb, stok_barang st where st.idx=sb.idx ORDER BY id DESC");
											$no=1;
											while($b=mysqli_fetch_array($brg)){
                                                $idb = $b['idx'];
                                                $id = $b['id'];

												?>
												
												<tr>
												<td><?php echo $no++ ?></td>
												<td><?php $tanggals=$b['tgl']; echo date("d-M-Y", strtotime($tanggals)) ?></td>
                                                <td><?php echo $b['nsj'] ?></td>
                                                <td><?php echo $b['jenis'] ?></td>
												<td><?php echo $b['nama'] ?></td>
												<td><?php echo $b['jumlah'] ?></td>
												<td><?php echo $b['penerima'] ?></td>
												<td><?php echo $b['keterangan'] ?></td>
                                                <td><?php echo $b['pic'] ?></td>
                                                <td><button data-toggle="modal" data-target="#edit<?=$id;?>" class="btn btn-warning">Edit</button> <button data-toggle="modal" data-target="#del<?=$id;?>" class="btn btn-danger">Hapus</button></td>
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

                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo $b['tgl'] ?>">

                                                            <label for="nsj">Nomor Surat Jalan</label>
                                                            <input type="text" id="nsj" name="nsj" class="form-control" value="<?php echo $b['nsj'] ?>">
                                                            
                                                            <label for="nama">Nama Barang</label>
                                                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $b['nama'] ?> <?php echo $b['jenis'] ?>" disabled>
                                                   
                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" id="jumlah" name="jumlah" min="1" max="1000" class="form-control" value="<?php echo $b['jumlah'] ?>">

                                                            <label for="penerima">Penerima</label>
                                                            <input type="text" id="penerima" name="penerima" class="form-control" value="<?php echo $b['penerima'] ?>">

                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?php echo $b['keterangan'] ?>">

                                                            <label>PIC</label>
                                                            <input name="pic" type="text" class="form-control" value="<?=$_SESSION['user'];?>" disabled>
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">

                                                            
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
                                                            <h4 class="modal-title">Hapus Barang <?php echo $b['nama']?> - <?php echo $b['jenis']?></h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus barang ini dari data barang keluar?
                                                            <br>
                                                            *Stok barang akan bertambah
                                                            <input type="hidden" name="id" value="<?=$id;?>">
                                                            <input type="hidden" name="idx" value="<?=$idb;?>">
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
                                </div>
									<a href="laporankeluar.php" target="_blank" class="btn btn-secondary">Export Data</a>
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
							<h4 class="modal-title">Input Barang Keluar</h4>
						</div>
						<div class="modal-body">
							<form action="barang_keluar_aksi.php" method="post">
								<div class="form-group">
									<label>Tanggal</label>
									<input name="tanggal" type="date" class="form-control">
								</div>
                                <div class="form-group">
									<label>Nomor Surat Jalan</label>
									<input name="nsj" type="text" class="form-control" placeholder="Nomor Surat Jalan">
								</div>
								<div class="form-group">
									<label>Nama Barang</label>
									<select name="barang" class="custom-select form-control">
									<option selected>Pilih barang</option>
									<?php
									$det=mysqli_query($conn,"select * from stok_barang order by nama ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idx'] ?>"><?php echo $d['nama'] ?> <?php echo $d['jenis'] ?> --- Stock : <?php echo $d['stock'] ?></option>
										<?php
								}
								?>		
									</select>
									
								</div>
								<div class="form-group">
									<label>Jumlah</label>
									<input name="qty" type="number" min="1" max="1000" class="form-control" placeholder="Jumlah">
								</div>
								<div class="form-group">
									<label>Penerima</label>
									<input name="penerima" type="text" class="form-control" placeholder="Penerima barang">
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<input name="ket" type="text" class="form-control" placeholder="Keterangan">
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
	</script>
</body>

</html>
