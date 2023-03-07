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
                            <li class="active">
                                <a href="stock_opname.php"><span><b>Stock Opname</b></span></a>
                            </li>
                            <li>
                                <a href="laporan_so.php"><span>Laporan Stock Opname</span></a>
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
                                    <h2>Stock Opname</h2>
                                    <button style="margin-bottom:20px" class="btn btn-success col-md-2" onclick="tambahModal()"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
                                </div>
                                <div class="datatable-dark table-responsive">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $brgs = mysqli_query($conn, "SELECT * from stock_opname");
                                            $no = 1;
                                            while ($p = mysqli_fetch_array($brgs)) {
                                                $id = $p['id'];
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= date('d-m-Y', strtotime($p['tanggal'])) ?></td>
                                                    <td><?= $p['notes'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" onclick="lihatModal(<?= $id ?>)">Lihat</button>
                                                        <?php if ($p['status'] == 'pending') { ?>
                                                            <button type="button" class="btn btn-sm btn-primary" onclick="editModal(<?= $id ?>)">Edit</button>
                                                            <button type="button" class="btn btn-sm btn-primary" onclick="hapusModal(<?= $id ?>)">Hapus</button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
            getData()
        })

        var data_barang = ''
        var data_so = ''

        function getData() {
            $.ajax({
                url: 'showBarang.php',
                type: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    data_barang = JSON.parse(response)
                    getDataStockOpnameComplete()
                }
            })
        }

        function getDataStockOpnameComplete() {
            $.ajax({
                url: 'showStockOpname.php',
                type: 'GET',
                beforeSend: function() {},
                success: function(response) {
                    data_so = JSON.parse(response)
                    console.log(data_so)
                }
            })
        }

        function tambahModal() {
            item = 0
            $('#myModal').modal('show')
            $('#modalTitle').html('Tambah Stock Opname')
            var html_body = ''
            html_body += '<div class="form-group">'
            html_body += '<label>Tanggal</label>'
            html_body += '<input type="date" class="form-control" placeholder="" id="tanggal" required>'
            html_body += '</div>'

            html_body += '<div class="form-group">'
            html_body += '<label>Catatan</label>'
            html_body += '<textarea class="form-control" id="notes"></textarea>'
            html_body += '</div>'

            html_body += '<div id="detailOpname">'
            html_body += '</div>'
            html_body += '<div class="row">'
            html_body += '<div class="col-12">'
            html_body += '<button class="btn btn-sm btn-success mt-2" onclick="addDetailOpname()">New Items</button>'
            html_body += '<div>'
            html_body += '<div>'
            $('#modalBody').html(html_body)

            var html_footer = ''
            html_footer += '<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>'
            html_footer += '<button class="btn btn-success" onclick="simpan()">Simpan</button>'
            $('#modalFooter').html(html_footer)
            addDetailOpname()
        }

        function lihatModal(id) {
            var data = data_so.find((value, key) => {
                if (value.id == id) return true
            })
            $('#myModal').modal('show')
            $('#modalTitle').html('Detail Stock Opname')
            var html_body = ''
            html_body += '<div class="container">'
            html_body += '<div class="row">'
            html_body += '<div class="col-2">Tanggal</div>'
            html_body += '<div class="col-auto">:</div>'
            html_body += '<div class="col">' + formatDateIndonesia(data.tanggal) + '</div>'
            html_body += '</div>'
            html_body += '<div class="row">'
            html_body += '<div class="col-2">Notes</div>'
            html_body += '<div class="col-auto">:</div>'
            html_body += '<div class="col">' + data.notes + '</div>'
            html_body += '</div>'
            html_body += '<div class="row">'
            html_body += '<div class="col-12 pt-3">'

            html_body += '<table class="table table-bordered table-hover">'
            html_body += '<thead>'
            html_body += '<tr>'
            html_body += '<th>Nama Barang</th>'
            html_body += '<th>Jumlah SO</th>'
            html_body += '<th>Jumlah Stok Sistem</th>'
            html_body += '<th>Status</th>'
            html_body += '</tr>'
            html_body += '</thead>'
            html_body += '<tbody>'
            $.each(data.detail, function(key, value) {
                html_body += '<tr>'
                html_body += '<td>' + value.nama_barang + '</td>'
                html_body += '<td>' + value.jumlah_stok_so + '</td>'
                html_body += '<td>' + value.jumlah_stok_sistem + '</td>'
                html_body += '<td>' + value.status + '</td>'
                html_body += '</tr>'
            })
            html_body += '</tbody>'
            html_body += '</table>'

            html_body += '</div>'
            html_body += '</div>'
            html_body += '</div>'
            $('#modalBody').html(html_body)

            var html_footer = ''
            html_footer += '<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>'
            $('#modalFooter').html(html_footer)
        }
        var item = 0

        function addDetailOpname() {
            var html = ''
            html += '<div class="row" id="fieldBarang' + item + '">'

            html += '<div class="col-6">'
            html += '<div class="form-group">'
            html += '<label>Items</label>'
            html += '<select name="" id="items" class="form-control items" required="required">'
            $.each(data_barang, function(key, value) {
                html += '<option value="' + value.id + '">' + value.nama + '</option>'
            })
            html += '</select>'
            html += '</div>'
            html += '</div>'

            html += '<div class="col-4">'
            html += '<div class="form-group">'
            html += '<label>Jumlah</label>'
            html += '<input type="number" class="form-control jumlah" placeholder="" id="jumlah" required>'
            html += '</div>'
            html += '</div>'

            html += '<div class="col-2">'
            html += '<label>Action</label>'
            html += '<button class="btn btn-sm btn-danger" onclick="hapusItems(' + item + ')">Hapus</button>'
            html += '</div>'

            html += '</div>'
            $('#detailOpname').append(html)
            item++
        }

        function editModal(id) {
            var data = data_so.find((value, key) => {
                if (value.id == id) return true
            })
            $('#myModal').modal('show')
            $('#modalTitle').html('Edit Stock Opname')
            var html_body = ''
            html_body += '<p class="text-danger"><b>*) Stock Opname dapat Diubah ketika Manager belum melakukan Persetujuan</b></p>'
            html_body += '<div class="form-group">'
            html_body += '<label>Tanggal</label>'
            html_body += '<input type="date" class="form-control" placeholder="" id="tanggal" required value="' + formatDate(data.tanggal) + '">'
            html_body += '</div>'

            html_body += '<div class="form-group">'
            html_body += '<label>Catatan</label>'
            html_body += '<textarea class="form-control" id="notes">' + data.notes + '</textarea>'
            html_body += '</div>'

            html_body += '<div id="detailOpnameEdit">'
            html_body += '</div>'
            $('#modalBody').html(html_body)

            var html_footer = ''
            html_footer += '<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>'
            html_footer += '<button class="btn btn-success" onclick="simpanEdit(' + data.id + ')">Simpan</button>'
            $('#modalFooter').html(html_footer)
            $.each(data.detail, function(key, value) {
                addDetailOpnameEdit(value.id, value.id_barang, value.jumlah_stok_so)
            })
        }

        function addDetailOpnameEdit(id, id_barang, jumlah) {
            var html = ''
            html += '<div class="row">'

            html += '<div class="col-6">'
            html += '<div class="form-group">'
            html += '<label>Items</label>'
            html += '<select name="" id="items" class="form-control items" required="required" data-id="' + id + '">'
            $.each(data_barang, function(key, value) {
                var select = ''
                if (value.id == id_barang) {
                    select = 'selected'
                }
                html += '<option value="' + value.id + '" ' + select + '>' + value.nama + '</option>'
            })
            html += '</select>'
            html += '</div>'
            html += '</div>'

            html += '<div class="col-4">'
            html += '<div class="form-group">'
            html += '<label>Jumlah</label>'
            html += '<input type="number" class="form-control jumlah" placeholder="" id="jumlah" required value="' + jumlah + '">'
            html += '</div>'
            html += '</div>'

            html += '</div>'
            $('#detailOpnameEdit').append(html)
        }

        function hapusModal(id) {
            var data = data_so.find((value, key) => {
                if (value.id == id) return true
            })
            $('#myModal').modal('show')
            $('#modalTitle').html('Edit Stock Opname')
            var html_body = ''
            html_body += 'Apakah anda yakin ingin menghapus Stock Opname tanggal ' + formatDateIndonesia(data.tanggal) + ' ?'
            $('#modalBody').html(html_body)

            var html_footer = ''
            html_footer += '<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>'
            html_footer += '<button class="btn btn-danger" onclick="simpanHapus(' + data.id + ')">Hapus Sekarang</button>'
            $('#modalFooter').html(html_footer)
        }

        function hapusItems(id) {
            $('#fieldBarang' + id).remove()
        }

        function simpan() {
            var tanggal = $('#tanggal').val()
            var notes = $('#notes').val()
            var items = $('.items').map(function() {
                return $(this).val();
            }).get();
            var jumlah = $('.jumlah').map(function() {
                return $(this).val();
            }).get();
            var data = {
                tanggal: tanggal,
                notes: notes,
                items: items,
                jumlah: jumlah,
            }
            $.ajax({
                url: 'insertOpname.php',
                type: 'POST',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    if (JSON.parse(response).status == 'success') {
                        alert('Berhasil Input')
                        refresh()
                    } else {
                        alert('Gagal Input')
                        refresh()
                    }

                }
            })
        }

        function simpanEdit(id) {
            var tanggal = $('#tanggal').val()
            var notes = $('#notes').val()
            var items = $('.items').map(function() {
                return $(this).val();
            }).get();
            var id_so_detail = $('.items').map(function() {
                return $(this).data('id');
            }).get();
            var jumlah = $('.jumlah').map(function() {
                return $(this).val();
            }).get();
            var data = {
                id: id,
                tanggal: tanggal,
                notes: notes,
                items: items,
                jumlah: jumlah,
                id_so_detail: id_so_detail,
            }
            $.ajax({
                url: 'editOpname.php',
                type: 'POST',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    if (JSON.parse(response).status == 'success') {
                        alert('Berhasil Update')
                        refresh()
                    } else {
                        alert('Gagal Update')
                        refresh()
                    }

                }
            })
        }

        function simpanHapus(id) {
            var data = {
                id: id,
            }
            // test
            $.ajax({
                url: 'hapusOpname.php',
                type: 'POST',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    if (JSON.parse(response).status == 'success') {
                        alert('Berhasil Hapus')
                        refresh()
                    } else {
                        alert('Gagal Hapus')
                        refresh()
                    }

                }
            })
        }

        function refresh() {
            location.reload();
        }
    </script>

</body>

</html>