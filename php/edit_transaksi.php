<?php
include "koneksi.php";
include "country_list.php";

session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "Admin") {
    header("Location: user.php");
    exit;
}

$id_transaksi = $_GET['id'];

$query = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";

$data = mysqli_query($connect, $query);
$transaksi = mysqli_fetch_assoc($data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = $_POST['jumlah'];
    $total_exchange_rate = $_POST['total_exchange_rate'];
    $matauang_asal = $_POST['from'];

    $update_query = "UPDATE transaksi SET jumlah = '$jumlah', matauang_asal = '$matauang_asal', total = '$total_exchange_rate' WHERE id_transaksi = '$id_transaksi'";

    mysqli_query($connect, $update_query);
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-base-100 min-h-screen flex items-center justify-center text-gray">

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
                class="btn btn-ghost text-xl bg-gradient-to-r text-transparent from-blue-500 to-teal-400 bg-clip-text ">Halaman Edit</a>
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

    <div class="container mx-auto p-6 bg-slate-800 w-[85%]">
        <div class=" shadow-md rounded-lg p-6 bg-slate-800">
            <h2 class="text-2xl font-bold text-center mb-4">Edit Nominal Transaksi</h2>
            <form method="post" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium ">Jumlah</label>
                    <input type="number" name="jumlah" id="amount" value="<?php echo $transaksi['jumlah']; ?>" required class="input border-white w-full mt-2" />
                </div>

                <div class="flex gap-5 mt-5 justify-between w-full">
                    <div class="currency-dropdown relative">
                        <p class="text-lg">From</p>
                        <div class="py-2 rounded-md border lg:w-32 w-28 mt-2 text-center flex gap-2 justify-center bg-black relative sm:w-10">
                            <img src="https://flagsapi.com/<?php echo $countryList[$transaksi['matauang_asal']]['code']; ?>/shiny/32.png" id="currency-flag" alt="Currency Flag">
                            <p class="self-center" id="selected-currency"><?= $transaksi['matauang_asal'] ?></p>
                            <select class="bg-black p-2 outline-none opacity-0 absolute top-0 left-0 w-full h-full" id="currency-select" name="from">
                            </select>
                            <span class="dropdown-arrow absolute right-2 top-1/2 transform -translate-y-1/2 pointer-events-none">▼</span>
                        </div>
                    </div>
                    <div class="self-center mt-6">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div>
                        <p class="text-lg">To</p>
                        <div class="p-2 rounded-md border w-32 mt-2 bg-black text-center flex gap-2 justify-center w-full">
                            <img src="https://flagsapi.com/ID/shiny/32.png" alt="IDR Flag">
                            <p class="self-center">IDR</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium">Total Konversi</label>

                    <div class="exchange-rate w-full text-center border p-2 mt-2 rounded-md" id="result"><?= $transaksi['jumlah'] . " " . $transaksi['matauang_asal'] . ' = ' . 'Rp. ' . number_format($transaksi['total'], 0, ',', '.') ?></div>
                    <p id="loading-message" class="hidden text-sm mt-1">Sedang mengonversi...</p>
                    <p id="exchangeRateInfo" class="text-sm mt-1"></p>
                    <input type="hidden" name="total_exchange_rate" id="total-exchange-rate">
                </div>

                <div class="flex justify-between space-x-4 mt-6">
                    <button type="button" class="btn btn-primary" id="exchange-button">Konversi</button>
                    <div class="flex space-x-4">
                        <button class="flex-1 py-3 px-4 bg-gray-700 rounded-lg relative hover:bg-gray-600 w-20">
                            <a href="dashboard.php" class="absolute inset-0 flex justify-center items-center">Kembali</a>
                        </button>
                        <button id="save" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/country_list.js"></script>
    <script>
        // Set a mock exchange rate for demonstration (replace with actual rate from database or API if available)
        // let exchangeRate = 4268.44;

        // function calculateExchange() {
        //     const amount = document.getElementById("amount").value;
        //     const totalExchangeRate = amount * exchangeRate;
        //     document.getElementById("totalExchangeRate").value = totalExchangeRate.toFixed(2);
        //     document.getElementById("exchangeRateInfo").textContent = `1 AED = Rp ${exchangeRate.toFixed(2)}`;
        // }

        // // Initial calculation with existing amount
        // calculateExchange();
        let clicked = false;
        const currencySelect = document.getElementById("currency-select");
        const exchangeButton = document.getElementById("exchange-button");
        const resultAmount = document.getElementById("total-exchange-rate");
        const loadingMessage = document.getElementById("loading-message");
        const currencyFlag = document.getElementById("currency-flag");
        const selectedCurrencyText = document.getElementById("selected-currency");
        let amountInput = document.getElementById("amount");

        // Menangani perubahan pada dropdown untuk memperbarui mata uang yang dipilih
        currencySelect.addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const flagUrl = selectedOption.getAttribute("data-flag");
            const selectedCurrency = selectedOption.value;

            currencyFlag.src = flagUrl;
            selectedCurrencyText.textContent = selectedCurrency;
        });

        // Mengambil nilai amount saat input berubah
        amountInput.addEventListener("input", function() {
            amount = this.value;
        });

        // Menambahkan opsi mata uang secara dinamis
        Object.entries(countryList).forEach(([currencyCode, {
            country,
            code
        }]) => {
            const optionTag = `
        <option value="${currencyCode}" data-flag="https://flagsapi.com/${code}/shiny/32.png" ${currencyCode === '<?php echo $transaksi['matauang_asal']; ?>' ? 'selected' : ''}>
            ${country} (${currencyCode})
        </option>
    `;
            currencySelect.insertAdjacentHTML("beforeend", optionTag);
        });

        // Memicu event listener untuk memilih mata uang pertama kali agar flag dan teks sesuai
        currencySelect.dispatchEvent(new Event("change"));

        const getExchangeRate = () => {
            loadingMessage.style.display = "block"; // Menampilkan pesan loading

            const convertFrom = document.getElementById("currency-select").value;
            const amount = document.getElementById("amount").value;

            // Mendapatkan URL untuk API berdasarkan mata uang yang dipilih
            const URL = `https://v6.exchangerate-api.com/v6/5160656534e45c756672c837/latest/${convertFrom}`;

            // Melakukan request API
            fetch(URL, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "Access-Control-Allow-Origin": "*",
                        "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
                        "Access-Control-Allow-Headers": "Origin, Content-Type, X-Auth-Token",
                    },
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Gagal mengambil nilai tukar");
                    }
                    return response.json();
                })
                .then((result) => {
                    const exchangeRate = result.conversion_rates["IDR"].toFixed(0);

                    
                    localStorage.setItem(`exchangeRate_${convertFrom}`, exchangeRate);

                    
                    const totalExchangeRate = (exchangeRate * amount).toFixed(0);

                    
                    const toRupiah = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(totalExchangeRate);

                    // Mengupdate nilai input hasil konversi

                    resultAmount.value = totalExchangeRate;
                    document.getElementById("result").textContent = `${amount} ${convertFrom} = ${toRupiah}`;


                    // Menyembunyikan pesan loading setelah selesai
                    loadingMessage.style.display = "none";
                })
                .catch((error) => {
                    console.error("Error fetching exchange rate:", error);
                    loadingMessage.style.display = "none"; // Menyembunyikan loading jika error
                });
        };

        const saveButton = document.getElementById("save");

        saveButton.addEventListener("click", function(e) {
            const totalExchangeRate = document.getElementById("total-exchange-rate").value;

            // Cek apakah totalExchangeRate kosong
            if (!totalExchangeRate || totalExchangeRate === "") {
                e.preventDefault(); // Mencegah pengiriman form
                alert("Silakan lakukan konversi terlebih dahulu.");
            }
        });

        // Event listener untuk tombol konversi
        exchangeButton.addEventListener("click", function(e) {
            clicked = true; // Menyimpan status konversi
            e.preventDefault(); // Mencegah form dikirim
            getExchangeRate(); // Menjalankan fungsi konversi
        });
    </script>

    <!-- <script src="../js/script.js"></script> -->


</html>