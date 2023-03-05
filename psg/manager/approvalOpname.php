<?php
// koneksi database
include '../dbconnect.php';
$id = $_POST['id'];
$status = $_POST['status'];
$sql = "SELECT * FROM stock_opname WHERE id = $id";
$query = mysqli_query($conn, $sql);
$valueStatus = 'reject';
if ($status == 1) {
    $valueStatus = 'accept';
}
$queryEdit = mysqli_query($conn, "UPDATE stock_opname SET status = '$valueStatus'WHERE id = $id");
while ($row = mysqli_fetch_array($query)) {
    $idx = $row['id'];
    $sql2 = "SELECT * FROM detail_stock_opname a JOIN stok_barang b ON a.id_barang = b.idx WHERE a.id_so = $idx";
    $query2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_array($query2)) {
        $id_so_detail = $row2['id'];
        $id_barang = $row2['id_barang'];
        $queryEditDetail = mysqli_query($conn, "UPDATE detail_stock_opname SET status = '$valueStatus'WHERE id = $id_so_detail");
        if ($status == 1) {
            $jumlah_stok_so = $row2['jumlah_stok_so'];
            $queryEditBarang = mysqli_query($conn, "UPDATE stok_barang SET stock = $jumlah_stok_so WHERE idx = $id_barang");
        }
    }
}
if ($query && $queryEdit && $queryEditDetail) {
    // berhasil
    print json_encode(array("status" => "success", "message" => "Berhasil Update"));
} else {
    print json_encode(array("status" => "failed", "message" => "Gagal Update"));
}
