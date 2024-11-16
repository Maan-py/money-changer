<?php
header('Content-Type: application/json'); 

include 'koneksi.php'; 
session_start();

if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionId = isset($_POST['id']) ? $_POST['id'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $totalharga = isset($_POST['totalharga']) ? $_POST['totalharga'] : null; 
    if ($transactionId && $quantity && $totalharga !== null) {
        $sql = "UPDATE transaksi SET jumlah = ?, total = ? WHERE id_transaksi = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("dii", $quantity, $totalharga, $transactionId);

        // Eksekusi query
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);  
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);  // Jika gagal
        }
        $stmt->close();
    } else {
        // Jika parameter tidak ada
        echo json_encode(['success' => false, 'error' => 'Kurang parameters']);
    }
    $connect->close();
} else {
    // Jika bukan request POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
