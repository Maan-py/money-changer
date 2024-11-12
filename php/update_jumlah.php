<?php
header('Content-Type: application/json'); // Set header untuk JSON

include 'koneksi.php'; // Include koneksi database
session_start();

// Cek apakah user sudah login
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil parameter dari POST
    $transactionId = isset($_POST['id']) ? $_POST['id'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $totalharga = isset($_POST['totalharga']) ? $_POST['totalharga'] : null;  // Ambil totalharga dari POST

    // Pastikan parameter ada
    if ($transactionId && $quantity && $totalharga !== null) {
        // Query untuk update jumlah dan totalharga
        $sql = "UPDATE transaksi SET jumlah = ?, total = ? WHERE id_transaksi = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("dii", $quantity, $totalharga, $transactionId);

        // Eksekusi query
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);  // Mengirimkan JSON jika sukses
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);  // Jika gagal
        }
        $stmt->close();
    } else {
        // Jika parameter tidak ada
        echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    }
    $connect->close();
} else {
    // Jika bukan request POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
