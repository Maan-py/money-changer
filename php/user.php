<?php
include "koneksi.php";
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$cart = "SELECT * FROM transaksi WHERE id_user = $id_user AND status_pembayaran != 'Berhasil'";
$dataCart = mysqli_query($connect, $cart);
$jumlahItem = mysqli_num_rows($dataCart);
$totalHarga = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_SESSION["username"];
    $kode = $_POST['from'];
    $amount = $_POST['amount'];
    $totalTransaksi = $_POST['total_exchange_rate'];
    $tanggal = date("Y-m-d H:i:s");

    if ($id_user !== null) {
        $query = "INSERT INTO transaksi (id_transaksi, matauang_asal, jumlah, total, created_at, status_pembayaran, id_user) VALUES (NULL, '$kode', '$amount', '$totalTransaksi', '$tanggal', 'Belum Lunas' ,'$id_user')";
        $data = mysqli_query($connect, $query);

        if (!$data) {
            die("Error pada query INSERT: " . mysqli_error($connect));
        }


        if ($data) {
            $message = "Transaksi berhasil ditambahkan.";
            header("Location: user.php?message=" . urlencode($message));
            exit;
        } else {
            $message = "Transaksi gagal ditambahkan.";
        }
    } else {
        echo "ID pengguna tidak ditemukan. Silakan login.";
    }
}



?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penukaran Uang</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $message = isset($_GET['message']) ? $_GET['message'] : '';
    if ($message) {
        echo '<div role="alert" class="alert fixed top-15 ' . (strpos($message, 'berhasil') !== false ? 'alert-success' : 'alert-error') . ' w-1/4 justify-center mt-[2rem]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>' . htmlspecialchars($message) . '</span>
          </div>';
    }
    ?>

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
            <a
                class="btn btn-ghost text-xl bg-gradient-to-r text-transparent from-blue-500 to-teal-400 bg-clip-text">MoneyChanger</a>
        </div>

        <div class="navbar-end">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="badge badge-sm indicator-item"><?= $jumlahItem ?></span>
                    </div>
                </div>
                <div
                    tabindex="0"
                    class="card card-compact dropdown-content bg-base-100 z-[1] mt-3 w-96 shadow">
                    <div class="card-body">
                        <span class="text-lg font-bold"><?= $jumlahItem ?> Items</span>
                        <div class="item-container" style="max-height: 200px; overflow-y: auto;">
                            <?php
                            while ($row = mysqli_fetch_assoc($dataCart)) {
                                $totalHarga += $row['total'];
                            ?>
                                <div class="divider"></div>
                                <div class="flex justify-between">
                                    <table>
                                        <tr>
                                            <td class="pe-5 font-bold">Mata Uang</td>
                                            <td><?= $row["matauang_asal"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-5 font-bold">Jumlah</td>
                                            <td><?= $row["jumlah"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-5 font-bold">Harga</td>
                                            <td><?= "Rp. " . number_format($row['total'], 0, ',', '.');  ?></td>
                                        </tr>
                                    </table>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                        <span class="text-info">Subtotal: <?= "Rp. " . number_format($totalHarga, 0, ',', '.'); ?></span>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-block relative">
                                <a href="cart.php?id_user=<?= $_SESSION['id_user'] ?>" class="absolute inset-0 flex justify-center items-center">View cart</a>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
    <div class="p-12 flex flex-col gap-5 md:flex-row mt-9" id="convert">
        <div class="flex flex-col gap-5 self-center mb-10 lg:w-1/2">
            <h1
                class="text-3xl font-bold mt-7 bg-gradient-to-r text-transparent from-blue-500 to-teal-400 bg-clip-text ">
                Ubah Uang Anda dengan Mudah dan Cepat!</h1>
            <p class="lg:w-[30rem] lg:mr-[5rem] lg:text-center xl:text-lg self-center">Kami menyediakan layanan
                penukaran
                mata
                uang yang aman,
                cepat, dan
                transparan tanpa
                biaya tersembunyi. Dapatkan nilai
                tukar terbaik di pasar dan rasakan kenyamanan transaksi bersama kami.</p>
        </div>
        <div class="rounded-sm bg-slate-800 p-5 lg:w-1/2 ">
            <h1 class="text-center font-bold text-xl">Penukaran Mata Uang</h1>
            <form action="user.php" method="post" id="currency-form">
                <div class="mt-5">
                    <p class="mb-3 text-lg">Masukkan Jumlah</p>
                    <input class="p-3 w-full rounded-md border" type="number" value="1" min="1" id="amount" name="amount">
                </div>
                <div class="flex gap-5 mt-5 justify-between w-full">
                    <div class="currency-dropdown relative">
                        <p class="text-lg">From</p>
                        <div class="py-2 rounded-md border lg:w-32 w-28 mt-2 text-center flex gap-2 justify-center bg-black relative sm:w-10">
                            <img src="https://flagsapi.com/US/shiny/32.png" id="currency-flag" alt="Currency Flag">
                            <p class="self-center" id="selected-currency">USD</p>
                            <select class="bg-black p-2 outline-none opacity-0 absolute top-0 left-0 w-full h-full" id="currency-select" name="from"></select>
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
                <div class="flex flex-col gap-5 mt-5">
                    <div id="loading-message" class="hidden">Sedang mengonversi...</div>
                    <div class="exchange-rate w-full text-center border p-2 rounded-md" id="result">1 AED = Rp 4.268, 00</div>
                    <button type="button" class="btn btn-primary text-lg" id="exchange-button">Konversi</button>
                    <button type="submit" class="btn btn-info text-lg" id="transaction-button" name="transaksi">Lakukan Transaksi!</button>
                    <input type="hidden" name="total_exchange_rate" id="total-exchange-rate">
                </div>
            </form>

        </div>
    </div>
    <!-- footer -->
    <footer class="footer footer-center bg-base-200 text-base-content rounded p-10">
        <nav>
            <div class="grid grid-flow-col gap-4">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                        </path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                        </path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                        </path>
                    </svg>
                </a>
            </div>
        </nav>
        <aside>
            <p>Copyright © 2024 - All right reserved</p>
        </aside>
    </footer>
    <script src="../js/country_list.js"></script>
    <script>
        // KEBUTUHAN MANIPULASI DOM
        const currencySelect = document.getElementById("currency-select");
        const currencyFlag = document.getElementById("currency-flag");
        const selectedCurrencyText = document.getElementById("selected-currency");
        const exchangeButton = document.getElementById("exchange-button");
        const resultAmount = document.getElementById("result");
        const loadingMessage = document.getElementById("loading-message");
        const transactionButton = document.getElementById("transaction-button");
        let convertFrom = document.getElementById("currency-select").value;
        let amount = document.getElementById("amount").value;

        // KETIKA DROPDOWN BERUBAH TETAPKAN VALUE
        document.getElementById("currency-select").addEventListener("change", function() {
            convertFrom = this.value;
        });

        // KETIKA INPUT BERUBAH TETAPKAN VALUE
        document.getElementById("amount").addEventListener("input", function() {
            amount = this.value;
        });

        // UNTUK MENAMPILKAN BENDERA
        Object.entries(countryList).forEach(([currencyCode, {
            country,
            code
        }]) => {
            const optionTag = `
      <option value="${currencyCode}" data-flag="https://flagsapi.com/${code}/shiny/32.png">
          ${country} (${currencyCode})
      </option>
  `;
            // MENGINSERT HTML BENDERA
            currencySelect.insertAdjacentHTML("beforeend", optionTag);
        });

        // KETIKA DROPDOWN BERUBAH TETAPKAN VALUE DAN UBAH SELECTED
        currencySelect.addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const flagUrl = selectedOption.getAttribute("data-flag");
            currencyFlag.src = flagUrl;
            selectedCurrencyText.textContent = selectedOption.value;
        });

        
        currencySelect.dispatchEvent(new Event("change"));

        // FETCH API
        const getExchangeRate = () => {
            // DISPLAY LOADING
            loadingMessage.style.display = "block";
            const URL = `https://v6.exchangerate-api.com/v6/0c98421abcccf6922c36d86f/latest/${convertFrom}`;

            // FETCH API
            fetch(URL)
                .then((response) =>
                    response.json().then((result) => {
                        // AMBIL HASIL KONVERSI KE IDR
                        const exchangeRate = result.conversion_rates["IDR"].toFixed(0);

                        // TETAPKAN HASIL KONVERSI KE LOCAL STORAGE
                        localStorage.setItem(`exchangeRate_${convertFrom}`, exchangeRate);

                        // MENGHITUNG TOTAL EXCHANGE RATE
                        const totalExchangeRate = (exchangeRate * amount).toFixed(0);

                        // UBAH VALUE MENJADI TOTAL EXCHANGE RATE
                        document.getElementById("total-exchange-rate").value = totalExchangeRate;

                        // FORMAT TOTAL EXCHANGE RATE KE RUPIAH
                        const toRupiah = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                        }).format(totalExchangeRate);

                        // TAMPILKAN RESULT
                        resultAmount.innerText = `${amount} ${convertFrom} = ${toRupiah}`;
                        // HIDE LOADING
                        loadingMessage.style.display = "none";
                    })
                )
                // TANGKAP ERROR DAN TAMPILKAN
                .catch((error) => {
                    console.error("Gagal fetch data:", error);
                    loadingMessage.style.display = "none";
                });
        };

        // KETIKA TOMBOL TRANSAKSI DIKLIK
        transactionButton.addEventListener("click", function(e) {

            const totalExchangeRate = document.getElementById("total-exchange-rate").value;

            // VALIDASI JIKA TOMBOL KONVERSI HARUS DIKLIK DAHULU
            if (!totalExchangeRate || totalExchangeRate === "") {
                e.preventDefault();
                alert("Silakan lakukan konversi terlebih dahulu.");
            }
        });

        // KETIKA TOMBOL TRANSAKSI DIKLIK
        exchangeButton.addEventListener("click", function(e) {
            e.preventDefault();
            // MENGHASILKAN API
            getExchangeRate();
        });
    </script>
    <!-- <script src="../js/script_user.js"></script> -->
</body>

</html>