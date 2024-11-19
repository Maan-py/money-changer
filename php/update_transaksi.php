<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// MEMASTIKAN DATA YANG DITERIMA BERUPA JSON
header('Content-Type: application/json');

$id_user = $_SESSION['id_user'];

// MENERIMA DATA JSON YANG DIKIRIM DARI AJAX
$jsonData = file_get_contents('php://input');
// MENGUBAH OBJECT JSON JADI OBJECT PHP
$data = json_decode($jsonData, true);

// KALAU DATA TRANSAKSI ID DAN STATUS PEMBAYARAN ADA
if (isset($data['transaction_id']) && isset($data['status_pembayaran'])) {
    // TANGKAP DATA TRANSAKSI ID DAN STATUS PEMBAYARAN
    $transaction_id = $data['transaction_id'];
    $status_pembayaran = $data['status_pembayaran'];


    $sql = "UPDATE `transaksi` SET `status_pembayaran`='$status_pembayaran' WHERE id_user = '$id_user'";
    $query = mysqli_query($connect, $sql);

    // KIRIM PESAN BERHASIL/TIDAK KEMUDIAN KEMBALIKAN MENJADI JSON
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status pembayaran']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}

mysqli_close($connect);
