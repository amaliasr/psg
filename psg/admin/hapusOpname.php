<?php
include '../dbconnect.php';
$id = $_POST['id'];
$query = mysqli_query($conn, "DELETE FROM stock_opname WHERE id = $id");
if ($query) {
    // berhasil
    print json_encode(array("status" => "success", "message" => "Berhasil Update"));
} else {
    print json_encode(array("status" => "failed", "message" => "Gagal Update"));
}
