<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$jsonData = file_get_contents('php://input'); // Mengambil data JSON mentah dari request body
$data = json_decode($jsonData, true);

$sql = "UPDATE transaksi SET status = '$data[result]' WHERE id_transaksi = $id_user";
$query = mysqli_query($connect, $sql);

echo json_encode(['success' => true]);
