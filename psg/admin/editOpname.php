<?php
include '../dbconnect.php';
$tanggal = $_POST['tanggal'];
$notes = $_POST['notes'];
$items = $_POST['items'];
$jumlah = $_POST['jumlah'];
$id = $_POST['id'];
$id_so_detail = $_POST['id_so_detail'];

$query = mysqli_query($conn, "UPDATE stock_opname SET tanggal = '$tanggal',notes='$notes' WHERE id = $id");
for ($i = 0; $i < count($id_so_detail); $i++) {
    $query = mysqli_query($conn, "UPDATE detail_stock_opname SET id_barang = '$items[$i]',jumlah_stok_so='$jumlah[$i]' WHERE id = $id_so_detail[$i]");
}
if ($query) {
    // berhasil
    print json_encode(array("status" => "success", "message" => "Berhasil Update"));
} else {
    print json_encode(array("status" => "failed", "message" => "Gagal Update"));
}
