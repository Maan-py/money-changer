<?php
include "koneksi.php";

// Perbarui status pembayaran jika lebih dari 15 menit
// $query = "UPDATE transaksi 
//           SET status_pembayaran = CASE 
//               WHEN TIMESTAMPDIFF(MINUTE, created_at, NOW()) > 15 AND status_pembayaran = 'Belum Lunas' THEN 'Kadaluwarsa'
//               ELSE status_pembayaran
//           END";
// mysqli_query($connect, $query);
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "Admin") {
    header("Location: user.php");
    exit;
}

echo $_SESSION["role"];


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

    <div class="navbar bg-base-100 fixed top-0 z-[99999]">
        <div class="navbar-start">
            <div class="dropdown xl:hidden sm:inherit">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle" id="hamburger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
            </div>
            <!-- Navbar untuk xl dan lebih besar -->
            <a
                class="btn btn-ghost text-xl bg-gradient-to-r text-transparent from-blue-500 to-teal-400 bg-clip-text ">Halaman Admin</a>
        </div>
        <div class="navbar-end">

            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img
                            alt="Tailwind CSS Navbar component"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li>
                        <a class="justify-between">
                            <?= $_SESSION["username"] ?>
                        </a>
                    </li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto self-center mt-10">
        <h1 class="text-center text-2xl font-bold">Dashboard</h1>
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
                    <th>Status Pembayaran</th>
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
                        <td><?= 'Rp. ' . number_format($result["total"], 0, ',', '.') ?></td>
                        <td><?= $result["created_at"] ?></td>
                        <td><?= $result["status_pembayaran"] ?></td>
                        <td>
                            <a href="edit_transaksi.php?id=<?= $result['id_transaksi'] ?>"><button class="btn btn-primary">Edit</button></a>
                            <a href="delete_transaksi.php?id=<?= $result['id_transaksi'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');"><button class="btn btn-error">Delete</button></a>

                            <!-- <button class="btn btn-primary"><a href="edit_transaksi.php?id_transaksi=">Edit</a></button>
                            <button class="btn btn-danger"><a href="delete_transaksi.php?id_transaksi=">Delete</a></button> -->
                        </td>
                    </tr>
                <?php
                    $i++;
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>