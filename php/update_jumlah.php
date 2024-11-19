<?php
// PASTIKAN MENERIMA JSON
header('Content-Type: application/json');

include 'koneksi.php';

session_start();
// PASTIKAN SESSION ROLE DAN ROLE ADALAH USER
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: user.php");
    exit;
}

// JIKA TOMBOL DIKLIK / METHOD POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TANKGAP DATA SEKALIAN CEK ADA ATAU NGGAK
    $transactionId = isset($_POST['id']) ? $_POST['id'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $totalharga = isset($_POST['totalharga']) ? $_POST['totalharga'] : null;
    // JIKA DATA ADA
    if ($transactionId && $quantity && $totalharga !== null) {
        $sql = "UPDATE transaksi SET jumlah = ?, total = ? WHERE id_transaksi = ?";

        // BEDANYA DENGAN MYSQLI_QUERY, Menggunakan prepare dan bind_param memungkinkan data di-sanitize secara otomatis sebelum dieksekusi. Ini menjamin keamanan yang lebih baik terhadap serangan SQL Injection.
        // mysqli_query:
        // mysqli_query langsung menjalankan query SQL, yang berarti Anda harus meng-sanitize input secara manual menggunakan fungsi seperti mysqli_real_escape_string() untuk mencegah SQL Injection. Kurang aman jika input tidak di-sanitize dengan benar.
        $stmt = $connect->prepare($sql);

        // D FOR DOUBLE, I FOR INT
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
