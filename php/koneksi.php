<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "proyek_konversi_uang";
$connect = mysqli_connect($hostname, $username, $password, $database);

if ($connect->error) {
    die("Gagal Connect Database");
}
