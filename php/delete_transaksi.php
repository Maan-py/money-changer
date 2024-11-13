<?php
include "koneksi.php";
session_start();

// Ambil ID transaksi dari URL
$id_transaksi = $_GET['id'];

// Hapus transaksi dari database
$delete_query = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
mysqli_query($connect, $delete_query);

// Redirect kembali ke dashboard
header("Location: dashboard.php");
exit;
?>
