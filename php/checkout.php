<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$sql = "SELECT * FROM transaksi JOIN users ON transaksi.id_user = users.id_user WHERE transaksi.id_user = $id_user";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-UjBAdgfLUC3T81lbwNtCMGYH';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$jsonData = file_get_contents('php://input'); 
$data = json_decode($jsonData, true);

if (!isset($data['finalTotal']) || !isset($data['items'])) {
    echo json_encode(['error' => 'Data tidak lengkap.']);
    exit;
}

$item_details = [];
foreach ($data['items'] as $item) {
    $item_details[] = array(
        'id' => $row['id_transaksi'],
        'price' => $item['price'],
        'matauang' => $row["matauang_asal"],
        'quantity' => $item['quantity'],
        'name' => $item['name'],
    );
}

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $data['finalTotal'],
    ),
    'item_details' => $item_details,
    'customer_details' => array(
        'first_name' => $row['username'], // Pastikan username diambil dari $row
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
$_SESSION['snapToken'] = $snapToken;

// Kembalikan respons JSON
header('Content-Type: application/json');
echo json_encode(['snapToken' => $snapToken]);
