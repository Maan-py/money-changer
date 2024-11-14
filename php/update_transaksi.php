<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

header('Content-Type: application/json'); // Pastikan respons adalah JSON

$id_user = $_SESSION['id_user'];

// Mengambil data JSON mentah dari request body
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

// Validasi data yang diterima
if (isset($data['transaction_id']) && isset($data['status_pembayaran'])) {
    $transaction_id = $data['transaction_id'];
    $status_pembayaran = $data['status_pembayaran'];

    // Query untuk memperbarui status pembayaran
    $sql = "UPDATE `transaksi` SET `status_pembayaran`='$status_pembayaran' WHERE id_user = '$id_user'";
    $query = mysqli_query($connect, $sql);

    if ($query) {
        // Respons JSON sukses
        echo json_encode(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    } else {
        // Respons JSON gagal jika update gagal
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status pembayaran']);
    }
} else {
    // Respons JSON jika data tidak lengkap
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}

// Tutup koneksi database
mysqli_close($connect);
