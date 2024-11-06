<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-gray-200">

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
                ?>

                    <div class="flex items-center justify-between p-4 bg-gray-800 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-700 rounded-lg mr-4 flex justify-center items-center  ">
                                <img src="https://flagsapi.com/<?= $code ?>/shiny/32.png" alt="">
                            </div>
                            <div>
                                <p><?= $row['matauang_asal'] ?></p>
                                <p class="text-gray-400"><?= "Rp. " . number_format($row['total'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="px-2 py-1 bg-gray-700 rounded text-gray-300">-</button>
                            <span><?= $row['jumlah'] ?></span>
                            <button class="px-2 py-1 bg-gray-700 rounded text-gray-300">+</button>
                            <button class="text-red-500 hover:text-red-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg></button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <!-- Order Summary -->
            <div class="p-6 bg-gray-800 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">Order summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Original price</span>
                        <span>$6,592.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Savings</span>
                        <span class="text-green-500">-$299.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Store Pickup</span>
                        <span>$99</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax</span>
                        <span>$799</span>
                    </div>
                    <div class="flex justify-between font-semibold text-lg mt-4">
                        <span>Total</span>
                        <span>$7,191.00</span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex space-x-4">
                    <button class="flex-1 py-2 px-4 bg-gray-700 rounded-lg text-gray-300">Continue Shopping</button>
                    <button class="flex-1 py-2 px-4 bg-blue-600 rounded-lg text-white">Proceed to Checkout</button>
                </div>
            </div>

        </div>
    </div>

</body>

</html>