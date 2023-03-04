<?php
// koneksi database
include '../dbconnect.php';
$sql = "SELECT * FROM stock_opname";
$query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_object($query);
$a = 0;
while ($row = mysqli_fetch_array($query)) {
    $object[$a]['id'] = $row['id'];
    $object[$a]['tanggal'] = $row['tanggal'];
    $object[$a]['notes'] = $row['notes'];
    $idx = $row['id'];
    $sql2 = "SELECT * FROM detail_stock_opname a JOIN stok_barang b ON a.id_barang = b.idx WHERE a.id_so = $idx";
    $query2 = mysqli_query($conn, $sql2);
    $b = 0;
    while ($row2 = mysqli_fetch_array($query2)) {
        $detail_object[$b]['id'] = $row2['id'];
        $detail_object[$b]['id_so'] = $row2['id_so'];
        $detail_object[$b]['id_barang'] = $row2['id_barang'];
        $detail_object[$b]['jumlah_stok_so'] = $row2['jumlah_stok_so'];
        $detail_object[$b]['jumlah_stok_sistem'] = $row2['jumlah_stok_sistem'];
        $detail_object[$b]['status'] = $row2['status'];
        $detail_object[$b]['jenis_barang'] = $row2['jenis'];
        $detail_object[$b]['stock_current'] = $row2['stock'];
        $detail_object[$b]['harga_barang'] = $row2['harga'];
        $detail_object[$b]['nama_barang'] = $row2['nama'];
        $b++;
    }
    $object[$a]['detail'] = $detail_object;
    $a++;
}
echo json_encode($object);
// print_r($row);
