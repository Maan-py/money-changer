<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$sql = "SELECT * FROM transaksi JOIN users ON transaksi.id_user = users.id_user WHERE transaksi.id_user = $id_user";

echo $sql;
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);


/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-UjBAdgfLUC3T81lbwNtCMGYH';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $row['total'],
    ),
    'item_details' => array(
        array(
            'id' => $row['id_transaksi'],
            'price' => $row['total'],
            'matauang' => $row["matauang_asal"],
            'quantity' => $row['jumlah'],
            'name' => $row['username'],
        ),
    ),
    'customer_details' => array(
        'username' => $username,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
$_SESSION['snapToken'] = $snapToken;
