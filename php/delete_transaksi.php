<?php
include "koneksi.php";
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "Admin") {
    header("Location: user.php");
    exit;
}

$id_transaksi = $_GET['id'];

$delete_query = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
mysqli_query($connect, $delete_query);

header("Location: dashboard.php");
exit;
?>
