<?php
session_start();

// Get JSON data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['toRupiah'])) {
    // Store the exchange rate in the session
    $_SESSION['exchange_rate'] = $data['toRupiah'];

    // Send a response back to the JavaScript
    echo json_encode(["status" => "success", "message" => "Exchange rate saved"]);
} else {
    echo json_encode(["status" => "error", "message" => "No exchange rate provided"]);
}
