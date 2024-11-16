<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

header('Content-Type: application/json');

$id_user = $_SESSION['id_user'];

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (isset($data['transaction_id']) && isset($data['status_pembayaran'])) {
    $transaction_id = $data['transaction_id'];
    $status_pembayaran = $data['status_pembayaran'];

    $sql = "UPDATE `transaksi` SET `status_pembayaran`='$status_pembayaran' WHERE id_user = '$id_user'";
    $query = mysqli_query($connect, $sql);

    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status pembayaran']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}

mysqli_close($connect);
