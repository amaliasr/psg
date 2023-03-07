<!doctype html>
<html class="no-js" lang="en">
<?php
include '../dbconnect.php';
session_start();
if ($_SESSION['user'] == "") {
    header("location:../index.php?pesan=belum_login");
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $jabatan = $_POST['jabatan'];

    $updatedata = mysqli_query($conn, "UPDATE admin set username='$username', password='$password', nickname='$nickname', email='$email', nohp='$nohp', jabatan='$jabatan' where id='$id'");

    //cek apakah berhasil
    if ($updatedata) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $delete = mysqli_query($conn, "delete from admin where id='$id'");
    //cek apakah berhasil
    header('location:index.php');
};

$sqlBarang = "SELECT * FROM stok_barang";
$rowBarang = mysqli_fetch_array(mysqli_query($conn, $sqlBarang));
?>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
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

        function gtag() {
            dataLayer.push(arguments);
        }
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
                                <a href="stok.php"><span>Stok Barang</span></a>
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
                            <li>
                                <a href="customer.php"><span>Master Customer</span></a>
                            </li>
                            <li>
                                <a href="stock_opname.php"><span>Stock Opname</span></a>
                            </li>
                            <li class="active">
                                <a href="laporan_so.php"><span><b>Laporan Stock Opname</b></span></a>
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
                                <h3><?= $_SESSION['jabatan']; ?> : <?= $_SESSION['user']; ?></h3>
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
                                    <h2>Laporan Stock Opname</h2>
                                    <!-- <button style="margin-bottom:20px" class="btn btn-success col-md-2" onclick="tambahModal()"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button> -->
                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" id="startDate" value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" id="endDate" value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>.</label><br>
                                        <button type="button" class="btn btn-primary" id="search" onclick="search()">Cari</button>
                                    </div>
                                </div>
                                <div class="datatable-dark table-responsive">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Jumlah SO</th>
                                                <th>Jumlah Stok Sistem</th>
                                                <th>Status SO</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataSO">
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
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                </div>
                <div class="modal-body" id="modalBody">
                </div>
                <div class="modal-footer" id="modalFooter">
                </div>
            </div>
        </div>
    </div>
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
        function formatDateIndonesia(orginaldate) {
            var date = new Date(orginaldate);
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tanggal = date.getDate();
            var hari = date.getDay();
            switch (hari) {
                case 0:
                    hari = "Minggu";
                    break;
                case 1:
                    hari = "Senin";
                    break;
                case 2:
                    hari = "Selasa";
                    break;
                case 3:
                    hari = "Rabu";
                    break;
                case 4:
                    hari = "Kamis";
                    break;
                case 5:
                    hari = "Jum'at";
                    break;
                case 6:
                    hari = "Sabtu";
                    break;
            }
            switch (bulan) {
                case 0:
                    bulan = "Januari";
                    break;
                case 1:
                    bulan = "Februari";
                    break;
                case 2:
                    bulan = "Maret";
                    break;
                case 3:
                    bulan = "April";
                    break;
                case 4:
                    bulan = "Mei";
                    break;
                case 5:
                    bulan = "Juni";
                    break;
                case 6:
                    bulan = "Juli";
                    break;
                case 7:
                    bulan = "Agustus";
                    break;
                case 8:
                    bulan = "September";
                    break;
                case 9:
                    bulan = "Oktober";
                    break;
                case 10:
                    bulan = "November";
                    break;
                case 11:
                    bulan = "Desember";
                    break;
            }
            var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
            return tampilTanggal;
        }

        function formatDate(orginaldate) {
            var date = new Date(orginaldate);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = year + "-" + month + "-" + day;
            return date;
        }
        $(document).ready(function() {
            search()
        })

        function search() {
            var end = $('#endDate').val()
            var start = $('#startDate').val()
            simpan(end, start)
        }

        function simpan(end, start) {
            var data = {
                tanggal_awal: start,
                tanggal_akhir: end,
            }
            // test
            $.ajax({
                url: 'laporanStockOpname.php',
                type: 'POST',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    var html = ''
                    $.each(JSON.parse(response), function(key, value) {
                        html += '<tr>'
                        html += '<td>' + (parseInt(key) + 1) + '</td>'
                        html += '<td>' + formatDateIndonesia(value.tanggal) + '</td>'
                        html += '<td>' + value.nama + '</td>'
                        html += '<td>' + value.jumlah_stok_so + '</td>'
                        var selisih = ''
                        if (value.jumlah_stok_so != value.jumlah_stok_sistem) {
                            selisih = '<span class="text-warning"> (' + (parseFloat(value.jumlah_stok_so) - parseFloat(value.jumlah_stok_sistem)) + ') </span>'
                        }
                        html += '<td>' + value.jumlah_stok_sistem + '' + selisih + '</td>'
                        var bg = 'bg-light'
                        if (value.status == 'accept') {
                            bg = 'bg-success text-white'
                        } else if (value.status == 'rejecr') {
                            bg = 'bg-danger text-white'
                        }
                        html += '<td><span class="badge ' + bg + '">' + value.status + '</span></td>'
                        html += '</tr>'
                    })
                    $('#dataSO').html(html)
                }
            })
        }
    </script>

</body>

</html>