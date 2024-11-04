<?php
include "koneksi.php";
session_start();
if (empty($_SESSION["role"])) {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <div class="overflow-x-auto self-center">
        <table class="table table-zebra table-lg">
            <!-- head -->
            <thead class="text-lg">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Total Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM transaksi JOIN users ON transaksi.id_user = users.id_user";
                $data = mysqli_query($connect, $query);
                $i = 1;
                while ($result = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $result["matauang_asal"] ?></td>
                        <td><?= $result["username"] ?></td>
                        <td><?= $result["jumlah"] ?></td>
                        <td><?= $result["total"] ?></td>
                        <td><?= $result["created_at"] ?></td>
                        <td>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>