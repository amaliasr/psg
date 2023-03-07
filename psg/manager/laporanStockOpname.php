<?php
// koneksi database
include '../dbconnect.php';
$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];
$sql = "SELECT
a.id,
a.id_so,
DATE_FORMAT(b.tanggal,'%Y-%m-%d') as tanggal,
c.nama,
a.jumlah_stok_so,
a.jumlah_stok_sistem,
a.status,
c.harga
FROM detail_stock_opname a
JOIN stock_opname b ON a.id_so = b.id
JOIN stok_barang c ON a.id_barang = c.idx
WHERE DATE_FORMAT(b.tanggal,'%Y-%m-%d') >= '$tanggal_awal' AND DATE_FORMAT(b.tanggal,'%Y-%m-%d') <= '$tanggal_akhir'
ORDER BY b.tanggal DESC;";
$query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_object($query);
$a = 0;
while ($row = mysqli_fetch_array($query)) {
    $object[$a]['id'] = $row['id'];
    $object[$a]['id_so'] = $row['id_so'];
    $object[$a]['tanggal'] = $row['tanggal'];
    $object[$a]['nama'] = $row['nama'];
    $object[$a]['jumlah_stok_so'] = $row['jumlah_stok_so'];
    $object[$a]['jumlah_stok_sistem'] = $row['jumlah_stok_sistem'];
    $object[$a]['status'] = $row['status'];
    $object[$a]['harga'] = $row['harga'];
    $a++;
}
echo json_encode($object);
// print_r($row);
