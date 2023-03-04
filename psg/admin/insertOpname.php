<?php
include '../dbconnect.php';
$tanggal = $_POST['tanggal'];
$notes = $_POST['notes'];
$items = $_POST['items'];
$jumlah = $_POST['jumlah'];

$query = mysqli_query($conn, "INSERT INTO stock_opname (tanggal,notes) VALUES('$tanggal','$notes')");
$id = mysqli_insert_id($conn);
for ($i = 0; $i < count($items); $i++) {
    $sql = "SELECT * FROM stok_barang WHERE idx = $items[$i]";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $id_barang = $row['stock'];
    $query = mysqli_query($conn, "INSERT INTO detail_stock_opname (id_so,id_barang,jumlah_stok_so,jumlah_stok_sistem,status) VALUES('$id','$items[$i]','$jumlah[$i]','$id_barang','pending')");
}
if ($query) {
    // berhasil
    print json_encode(array("status" => "success", "message" => "Berhasil Input"));
} else {
    print json_encode(array("status" => "failed", "message" => "Gagal Input"));
}
