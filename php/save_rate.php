<?php
// MENERIMA DATA JSON UNTUK MENYIMPAN HASIL KONVERSI KE RUPIAH
session_start();

if (empty($_SESSION["role"]) || $_SESSION["role"] != "Admin") {
    header("Location: user.php");
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['toRupiah'])) {
    $_SESSION['exchange_rate'] = $data['toRupiah'];

    echo json_encode(["status" => "success", "message" => "Exchange rate berhasil"]);
} else {
    echo json_encode(["status" => "error", "message" => "Tidak ada exchange rate"]);
}
