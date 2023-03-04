<?php
// koneksi database
include '../dbconnect.php';
$sql = "SELECT * FROM stok_barang";
$query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_object($query);
$a = 0;
while ($row = mysqli_fetch_array($query)) {
    $object[$a]['nama'] = $row['nama'];
    $object[$a]['id'] = $row['idx'];
    $object[$a]['jenis'] = $row['jenis'];
    $object[$a]['stock'] = $row['stock'];
    $object[$a]['harga'] = $row['harga'];
    $object[$a]['pic'] = $row['pic'];
    $a++;
}
echo json_encode($object);
// print_r($row);
