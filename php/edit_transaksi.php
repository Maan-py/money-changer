<?php
include "koneksi.php";
session_start();
if (empty($_SESSION["role"])) {
    header("Location: login.php");
    exit;
}

// Ambil ID transaksi dari URL
$id_transaksi = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$query = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
$data = mysqli_query($connect, $query);
$transaksi = mysqli_fetch_assoc($data);

// Proses saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = $_POST['jumlah'];
    $total_exchange_rate = $_POST['total_exchange_rate'];

    // Update hanya kolom jumlah dan total di transaksi
    $update_query = "UPDATE transaksi SET jumlah = '$jumlah', total = '$total_exchange_rate' WHERE id_transaksi = '$id_transaksi'";
    mysqli_query($connect, $update_query);

    // Redirect ke halaman dashboard setelah berhasil update
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nominal Transaksi</title>
    <!-- Import Tailwind CSS & DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-Kc323vGBEqzTmouAECnVcey7r37ZJyK3ejzA39fu1Z96FsV4hMHiJY9uNmhdP2VPLhKdB1d7H5XewqIM+KvPRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-700">Edit Nominal Transaksi</h2>

            <form method="post" class="space-y-6" oninput="calculateExchange()">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Masukkan Jumlah:</label>
                    <input type="number" name="jumlah" id="amount" value="<?php echo $transaksi['jumlah']; ?>" required class="input input-bordered w-full mt-2" />
                </div>

                <div class="flex space-x-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">From:</label>
                        <select name="from_currency" id="fromCurrency" class="select select-bordered w-full mt-2">
                            <option value="AED" <?php if ($transaksi['matauang_asal'] == 'AED') echo 'selected'; ?>>AED</option>
                            <!-- Add other currencies here as needed -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">To:</label>
                        <select name="to_currency" id="toCurrency" class="select select-bordered w-full mt-2">
                            <option value="IDR">IDR</option>
                            <!-- Add other currencies here as needed -->
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-600">Total Konversi:</label>
                    <input type="text" name="total_exchange_rate" id="totalExchangeRate" readonly value="<?php echo $transaksi['total']; ?>" class="input input-bordered w-full mt-2" />
                    <p id="exchangeRateInfo" class="text-gray-500 text-sm mt-1">1 AED = Rp 4,268.44</p>
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="dashboard.php" class="btn btn-outline btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Set a mock exchange rate for demonstration (replace with actual rate from database or API if available)
        let exchangeRate = 4268.44;

        function calculateExchange() {
            const amount = document.getElementById("amount").value;
            const totalExchangeRate = amount * exchangeRate;
            document.getElementById("totalExchangeRate").value = totalExchangeRate.toFixed(2);
            document.getElementById("exchangeRateInfo").textContent = `1 AED = Rp ${exchangeRate.toFixed(2)}`;
        }

        // Initial calculation with existing amount
        calculateExchange();
    </script>
</body>

</html>