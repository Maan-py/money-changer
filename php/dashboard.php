<?php
session_start();
if (empty($_SESSION["role"])) {
    header("Location: login.php");
    exit;
}
echo "Halaman Admin";
