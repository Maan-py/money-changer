<?php
include 'koneksi.php';
session_start();

if (empty($_SESSION["role"]) || $_SESSION["role"] != "User") {
    header("Location: login.php");
    exit;
}


$id_user = $_SESSION['id_user'];

$query = "SELECT * FROM transaksi WHERE id_user = $id_user";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-dtlm5vRcuNMudMJO"></script>

</head>

<body class="bg-gray-900 text-gray-200 h-screen">
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
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-6">Shopping Cart</h2>


        <!-- Cart Items and Order Summary -->
        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                <!-- Item -->
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    switch ($row['matauang_asal']) {
                        case 'AED':
                            $code = 'AE';

                            break;
                        case 'AFN':
                            $code = 'AF';

                            break;
                        case 'XCD':
                            $code = 'AG';

                            break;
                        case 'ALL':
                            $code = 'AL';

                            break;
                        case 'AMD':
                            $code = 'AM';

                            break;
                        case 'ANG':
                            $code = 'AN';

                            break;
                        case 'AOA':
                            $code = 'AO';

                            break;
                        case 'AQD':
                            $code = 'AQ';

                            break;
                        case 'ARS':
                            $code = 'AR';

                            break;
                        case 'AUD':
                            $code = 'AU';

                            break;
                        case 'AZN':
                            $code = 'AZ';

                            break;
                        case 'BAM':
                            $code = 'BA';

                            break;
                        case 'BBD':
                            $code = 'BB';

                            break;
                        case 'BDT':
                            $code = 'BD';

                            break;
                        case 'XOF':
                            $code = 'BE';

                            break;
                        case 'BGN':
                            $code =  'BG';
                            break;
                        case 'BHD':
                            $code =  'BH';
                            break;
                        case 'BIF':
                            $code =  'BI';
                            break;
                        case 'BMD':
                            $code =  'BM';
                            break;
                        case 'BND':
                            $code =  'BN';
                            break;
                        case 'BOB':
                            $code =  'BO';
                            break;
                        case 'BRL':
                            $code =  'BR';
                            break;
                        case 'BSD':
                            $code =  'BS';
                            break;
                        case 'NOK':
                            $code =  'BV';
                            break;
                        case 'BWP':
                            $code =  'BW';
                            break;
                        case 'BYR':
                            $code =  'BY';
                            break;
                        case 'BZD':
                            $code =  'BZ';
                            break;
                        case 'CAD':
                            $code =  'CA';
                            break;
                        case 'CDF':
                            $code =  'CD';
                            break;
                        case 'XAF':
                            $code =  'CF';
                            break;
                        case 'CHF':
                            $code =  'CH';
                            break;
                        case 'CLP':
                            $code =  'CL';
                            break;
                        case 'CNY':
                            $code =  'CN';
                            break;
                        case 'COP':
                            $code =  'CO';
                            break;
                        case 'CRC':
                            $code =  'CR';
                            break;
                        case 'CUP':
                            $code =  'CU';
                            break;
                        case 'CVE':
                            $code =  'CV';
                            break;
                        case 'CYP':
                            $code =  'CY';
                            break;
                        case 'CZK':
                            $code =  'CZ';
                            break;
                        case 'DJF':
                            $code =  'DJ';
                            break;
                        case 'DKK':
                            $code =  'DK';
                            break;
                        case 'DOP':
                            $code =  'DO';
                            break;
                        case 'DZD':
                            $code =  'DZ';
                            break;
                        case 'ECS':
                            $code =  'EC';
                            break;
                        case 'EEK':
                            $code =  'EE';
                            break;
                        case 'EGP':
                            $code =  'EG';
                            break;
                        case 'ETB':
                            $code =  'ET';
                            break;
                        case 'EUR':
                            $code =  'FR';
                            break;
                        case 'FJD':
                            $code =  'FJ';
                            break;
                        case 'FKP':
                            $code =  'FK';
                            break;
                        case 'GBP':
                            $code =  'GB';
                            break;
                        case 'GEL':
                            $code =  'GE';
                            break;
                        case 'GGP':
                            $code =  'GG';
                            break;
                        case 'GHS':
                            $code =  'GH';
                            break;
                        case 'GIP':
                            $code =  'GI';
                            break;
                        case 'GMD':
                            $code =  'GM';
                            break;
                        case 'GNF':
                            $code =  'GN';
                            break;
                        case 'GTQ':
                            $code =  'GT';
                            break;
                        case 'GYD':
                            $code =  'GY';
                            break;
                        case 'HKD':
                            $code =  'HK';
                            break;
                        case 'HNL':
                            $code =  'HN';
                            break;
                        case 'HRK':
                            $code =  'HR';
                            break;
                        case 'HTG':
                            $code =  'HT';
                            break;
                        case 'HUF':
                            $code =  'HU';
                            break;
                        case 'IDR':
                            $code =  'ID';
                            break;
                        case 'ILS':
                            $code =  'IL';
                            break;
                        case 'INR':
                            $code =  'IN';
                            break;
                        case 'IQD':
                            $code =  'IQ';
                            break;
                        case 'IRR':
                            $code =  'IR';
                            break;
                        case 'ISK':
                            $code =  'IS';
                            break;
                        case 'JMD':
                            $code =  'JM';
                            break;
                        case 'JOD':
                            $code =  'JO';
                            break;
                        case 'JPY':
                            $code =  'JP';
                            break;
                        case 'KES':
                            $code =  'KE';
                            break;
                        case 'KGS':
                            $code =  'KG';
                            break;
                        case 'KHR':
                            $code =  'KH';
                            break;
                        case 'KMF':
                            $code =  'KM';
                            break;
                        case 'KPW':
                            $code =  'KP';
                            break;
                        case 'KRW':
                            $code =  'KR';
                            break;
                        case 'KWD':
                            $code =  'KW';
                            break;
                        case 'KYD':
                            $code =  'KY';
                            break;
                        case 'KZT':
                            $code =  'KZ';
                            break;
                        case 'LAK':
                            $code =  'LA';
                            break;
                        case 'LBP':
                            $code =  'LB';
                            break;
                        case 'LKR':
                            $code =  'LK';
                            break;
                        case 'LRD':
                            $code =  'LR';
                            break;
                        case 'LSL':
                            $code =  'LS';
                            break;
                        case 'LTL':
                            $code =  'LT';
                            break;
                        case 'LVL':
                            $code =  'LV';
                            break;
                        case 'LYD':
                            $code =  'LY';
                            break;
                        case 'MAD':
                            $code =  'MA';
                            break;
                        case 'MDL':
                            $code =  'MD';
                            break;
                        case 'MGA':
                            $code =  'MG';
                            break;
                        case 'MKD':
                            $code =  'MK';
                            break;
                        case 'MMK':
                            $code =  'MM';
                            break;
                        case 'MNT':
                            $code =  'MN';
                            break;
                        case 'MOP':
                            $code =  'MO';
                            break;
                        case 'MRO':
                            $code =  'MR';
                            break;
                        case 'MTL':
                            $code =  'MT';
                            break;
                        case 'MUR':
                            $code =  'MU';
                            break;
                        case 'MVR':
                            $code =  'MV';
                            break;
                        case 'MWK':
                            $code =  'MW';
                            break;
                        case 'MXN':
                            $code =  'MX';
                            break;
                        case 'MYR':
                            $code =  'MY';
                            break;
                        case 'MZN':
                            $code =  'MZ';
                            break;
                        case 'NAD':
                            $code =  'NA';
                            break;
                        case 'XPF':
                            $code =  'NC';
                            break;
                        case 'NGN':
                            $code =  'NG';
                            break;
                        case 'NIO':
                            $code =  'NI';
                            break;
                        case 'NPR':
                            $code =  'NP';
                            break;
                        case 'NZD':
                            $code =  'NZ';
                            break;
                        case 'OMR':
                            $code =  'OM';
                            break;
                        case 'PAB':
                            $code =  'PA';
                            break;
                        case 'PEN':
                            $code =  'PE';
                            break;
                        case 'PGK':
                            $code =  'PG';
                            break;
                        case 'PHP':
                            $code =  'PH';
                            break;
                        case 'PKR':
                            $code =  'PK';
                            break;
                        case 'PLN':
                            $code =  'PL';
                            break;
                        case 'PYG':
                            $code =  'PY';
                            break;
                        case 'QAR':
                            $code =  'QA';
                            break;
                        case 'RON':
                            $code =  'RO';
                            break;
                        case 'RSD':
                            $code =  'RS';
                            break;
                        case 'RUB':
                            $code =  'RU';
                            break;
                        case 'RWF':
                            $code =  'RW';
                            break;
                        case 'SAR':
                            $code =  'SA';
                            break;
                        case 'SBD':
                            $code =  'SB';
                            break;
                        case 'SCR':
                            $code =  'SC';
                            break;
                        case 'SDG':
                            $code =  'SD';
                            break;
                        case 'SEK':
                            $code =  'SE';
                            break;
                        case 'SGD':
                            $code =  'SG';
                            break;
                        case 'SKK':
                            $code =  'SK';
                            break;
                        case 'SLL':
                            $code =  'SL';
                            break;
                        case 'SOS':
                            $code =  'SO';
                            break;
                        case 'SRD':
                            $code =  'SR';
                            break;
                        case 'STD':
                            $code =  'ST';
                            break;
                        case 'SVC':
                            $code =  'SV';
                            break;
                        case 'SYP':
                            $code =  'SY';
                            break;
                        case 'SZL':
                            $code =  'SZ';
                            break;
                        case 'THB':
                            $code =  'TH';
                            break;
                        case 'TJS':
                            $code =  'TJ';
                            break;
                        case 'TMT':
                            $code =  'TM';
                            break;
                        case 'TND':
                            $code =  'TN';
                            break;
                        case 'TOP':
                            $code =  'TO';
                            break;
                        case 'TRY':
                            $code =  'TR';
                            break;
                        case 'TTD':
                            $code =  'TT';
                            break;
                        case 'TWD':
                            $code =  'TW';
                            break;
                        case 'TZS':
                            $code =  'TZ';
                            break;
                        case 'UAH':
                            $code =  'UA';
                            break;
                        case 'UGX':
                            $code =  'UG';
                            break;
                        case 'USD':
                            $code =  'US';
                            break;
                        case 'UYU':
                            $code =  'UY';
                            break;
                        case 'UZS':
                            $code =  'UZ';
                            break;
                        case 'VEF':
                            $code =  'VE';
                            break;
                        case 'VND':
                            $code =  'VN';
                            break;
                        case 'VUV':
                            $code =  'VU';
                            break;
                        case 'YER':
                            $code =  'YE';
                            break;
                        case 'ZAR':
                            $code =  'ZA';
                            break;
                        case 'ZMK':
                            $code =  'ZM';
                            break;
                        case 'ZWD':
                            $code =  'ZW';
                            break;
                        default:
                            $code =  'Unknown';
                            break;
                    }

                    $totalHarga = 0;
                ?>

                    <div class="flex items-center justify-between p-4 bg-gray-800 rounded-lg item" id="transaction-<?= $row["id_transaksi"] ?>" data-id="<?= $row["id_transaksi"] ?>" data-total="<?= $row['total'] ?>" data-id="<?= $row['id_transaksi'] ?>">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" checked="checked" name="check" class="checkbox checkbox-primary price-checkbox" data-price="<?= $row['total'] ?>" />
                            <div class="w-12 h-12 bg-gray-700 rounded-lg mr-4 flex justify-center items-center">
                                <img src="https://flagsapi.com/<?= $code ?>/shiny/32.png" alt="">
                            </div>
                            <div>
                                <p id="currency-code"><?= $row['matauang_asal'] ?></p>
                                <p class="text-gray-400 total-price" id="total-harga"><?= "Rp. " . number_format($row['total'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="px-2 py-1 bg-gray-700 rounded text-gray-300 minus-btn">-</button>
                            <span class="jumlah"><?= $row['jumlah'] ?></span>
                            <button class="px-2 py-1 bg-gray-700 rounded text-gray-300 add-btn">+</button>
                            <a href="delete.php?id=<?= $row['id_transaksi'] ?>"><button class="text-red-500 hover:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                            </a></button>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <!-- Order Summary -->
            <div class="p-6 bg-gray-800 rounded-lg h-96 ">
                <h3 class="text-xl font-semibold mb-4">Order summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Original price</span>
                        <span id="total-price">$6,592.00</span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg mt-4">
                        <span>Total</span>
                        <span id="final-total">$7,191.00</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex space-x-4">
                    <button class="flex-1 py-2 px-4 bg-gray-700 rounded-lg relative hover:bg-gray-600">
                        <a href="user.php" class="absolute inset-0 flex justify-center items-center">Kembali</a>
                    </button>
                    <button class="btn btn-primary btn-block relative flex-1 py-2 px-4" id="pay-button">
                        <!-- <a href="" class="absolute inset-0 flex justify-center items-center" id="pay-button">Checkout</a> -->
                        CheckOut
                    </button>
                </div>
            </div>
        </div>

    </div>
    <script>
        function updateDatabase(transactionId, newQuantity) {
            const totalPrice = document.querySelector(`#transaction-${transactionId} .total-price`);

            // Cek apakah elemen ada
            if (totalPrice) {
                // Mengambil nilai total harga yang sudah diformat (Rp. xxx,xxx)
                const unformattedPrice = parseFloat(totalPrice.textContent.replace('Rp. ', '').replace(/\./g, '').replace(',', '.'));

                fetch('update_jumlah.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id=${transactionId}&quantity=${newQuantity}&totalharga=${unformattedPrice}`
                    })
                    .then(response => {
                        // Pastikan respons adalah JSON
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data.success) {
                            console.error('Error updating database:', data.error);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                console.error(`Total price element for transaction ${transactionId} not found.`);
            }
        }


        // JavaScript to handle real-time price update
        const checkboxes = document.querySelectorAll('.price-checkbox');
        const totalPriceElement = document.getElementById('total-price');
        const finalTotalElement = document.getElementById('final-total');
        const totalHarga = document.querySelectorAll('.total-price');


        // Function to calculate and display total price
        function calculateTotal() {
            let total = 0;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {

                    // Ambil harga per item sesuai dengan jumlahnya
                    const item = checkbox.closest('.item');
                    const jumlah = parseInt(item.querySelector('.jumlah').textContent);

                    // Ambil kode mata uang dari elemen yang ada di dalam item
                    const currencyCodeElement = item.querySelector('#currency-code'); // Pastikan ini selector yang tepat
                    const convertFrom = currencyCodeElement ? currencyCodeElement.textContent : 'defaultCurrency'; // Ganti 'defaultCurrency' dengan mata uang default jika tidak ada

                    // Ambil nilai tukar berdasarkan mata uang yang digunakan
                    const price = localStorage.getItem(`exchangeRate_${convertFrom}`);

                    total += price * jumlah;
                }
            });

            // Format and display total price
            totalPriceElement.textContent = `Rp. ${total.toLocaleString('id-ID')}`;

            // Assuming you have other charges or tax to calculate final total
            let finalTotal = total;
            finalTotalElement.textContent = `Rp. ${finalTotal.toLocaleString('id-ID')}`;
        }

        // Add event listener to checkboxes
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', calculateTotal);
        });

        // Initial calculation on page load
        calculateTotal();
        // DOM content loaded for item operations
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen item
            document.querySelectorAll('.item').forEach(item => {
                const minusBtn = item.querySelector('.minus-btn');
                const addBtn = item.querySelector('.add-btn');
                const jumlahElement = item.querySelector('.jumlah');
                const totalPriceElement = item.querySelector('.total-price');
                // Ambil kode mata uang dari elemen yang ada di DOM
                const currencyCodeElement = item.querySelector('#currency-code'); // Pastikan ini selector yang tepat
                const convertFrom = currencyCodeElement ? currencyCodeElement.textContent : 'defaultCurrency'; // Ganti 'defaultCurrency' dengan mata uang default jika tidak ada

                // Ambil nilai tukar berdasarkan mata uang yang digunakan
                const dataTotal = localStorage.getItem(`exchangeRate_${convertFrom}`);
                // Ganti 'defaultCurrency' dengan mata uang default jika tidak ada





                const transactionId = item.getAttribute('data-id'); // Pastikan setiap .item memiliki data-id

                // Fungsi untuk memperbarui harga per item dan total harga keseluruhan
                function updateTotalPrice() {
                    const jumlah = parseInt(jumlahElement.textContent);
                    const newTotal = dataTotal * jumlah;
                    totalPriceElement.textContent = "Rp. " + newTotal.toLocaleString('id-ID', {
                        minimumFractionDigits: 0
                    });

                    // Hitung ulang total keseluruhan
                    calculateTotal();
                }

                // Event listener untuk tombol minus
                minusBtn.addEventListener('click', function() {
                    let jumlah = parseInt(jumlahElement.textContent);
                    if (jumlah > 1) {
                        jumlah -= 1;
                        jumlahElement.textContent = jumlah;
                        updateTotalPrice();

                        // Panggil fungsi untuk memperbarui database
                        updateDatabase(transactionId, jumlah);
                    }
                });

                // Event listener untuk tombol plus
                addBtn.addEventListener('click', function() {
                    let jumlah = parseInt(jumlahElement.textContent);
                    jumlah += 1;
                    jumlahElement.textContent = jumlah;
                    updateTotalPrice();

                    // Panggil fungsi untuk memperbarui database
                    updateDatabase(transactionId, jumlah);
                });
            });
        });
    </script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {

            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
            // Also, use the embedId that you defined in the div above, here.
            let snapToken = "<?= $_SESSION['snapToken'] ?>";

            window.snap.pay(snapToken, {
                // embedId: 'snap-container',
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
</body>

</html>