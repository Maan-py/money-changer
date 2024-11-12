<?php
include "koneksi.php";
session_start();
if (empty($_SESSION["role"])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$id = $_GET['id'];
$query = "DELETE FROM transaksi WHERE id_transaksi = $id";
$data = mysqli_query($connect, $query);

if (!$data) {
    die("Error pada query DELETE: " . mysqli_error($connect));
}


if ($data) {
    $message = "Transaksi berhasil dihapus.";
    // Redirect ke halaman yang sama dengan metode GET setelah delete
    header("Location: cart.php?message=" . urlencode($message));
    exit;
} else {
    $message = "Transaksi gagal dihapus.";
}
