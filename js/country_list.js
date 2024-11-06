let countryList = {
  AED: { country: "United Arab Emirates", code: "AE" },
  AFN: { country: "Afghanistan", code: "AF" },
  XCD: { country: "East Caribbean States", code: "AG" },
  ALL: { country: "Albania", code: "AL" },
  AMD: { country: "Armenia", code: "AM" },
  ANG: { country: "Netherlands Antilles", code: "AN" },
  AOA: { country: "Angola", code: "AO" },
  AQD: { country: "Aqaba", code: "AQ" },
  ARS: { country: "Argentina", code: "AR" },
  AUD: { country: "Australia", code: "AU" },
  AZN: { country: "Azerbaijan", code: "AZ" },
  BAM: { country: "Bosnia and Herzegovina", code: "BA" },
  BBD: { country: "Barbados", code: "BB" },
  BDT: { country: "Bangladesh", code: "BD" },
  XOF: { country: "West African CFA Franc", code: "BE" },
  BGN: { country: "Bulgaria", code: "BG" },
  BHD: { country: "Bahrain", code: "BH" },
  BIF: { country: "Burundi", code: "BI" },
  BMD: { country: "Bermuda", code: "BM" },
  BND: { country: "Brunei", code: "BN" },
  BOB: { country: "Bolivia", code: "BO" },
  BRL: { country: "Brazil", code: "BR" },
  BSD: { country: "Bahamas", code: "BS" },
  NOK: { country: "Bouvet Island", code: "BV" },
  BWP: { country: "Botswana", code: "BW" },
  BYR: { country: "Belarus", code: "BY" },
  BZD: { country: "Belize", code: "BZ" },
  CAD: { country: "Canada", code: "CA" },
  CDF: { country: "Democratic Republic of the Congo", code: "CD" },
  XAF: { country: "Central African CFA Franc", code: "CF" },
  CHF: { country: "Switzerland", code: "CH" },
  CLP: { country: "Chile", code: "CL" },
  CNY: { country: "China", code: "CN" },
  COP: { country: "Colombia", code: "CO" },
  CRC: { country: "Costa Rica", code: "CR" },
  CUP: { country: "Cuba", code: "CU" },
  CVE: { country: "Cape Verde", code: "CV" },
  CYP: { country: "Cyprus", code: "CY" },
  CZK: { country: "Czech Republic", code: "CZ" },
  DJF: { country: "Djibouti", code: "DJ" },
  DKK: { country: "Denmark", code: "DK" },
  DOP: { country: "Dominican Republic", code: "DO" },
  DZD: { country: "Algeria", code: "DZ" },
  ECS: { country: "Ecuador", code: "EC" },
  EEK: { country: "Estonia", code: "EE" },
  EGP: { country: "Egypt", code: "EG" },
  ETB: { country: "Ethiopia", code: "ET" },
  EUR: { country: "Eurozone", code: "FR" },
  FJD: { country: "Fiji", code: "FJ" },
  FKP: { country: "Falkland Islands", code: "FK" },
  GBP: { country: "United Kingdom", code: "GB" },
  GEL: { country: "Georgia", code: "GE" },
  GGP: { country: "Guernsey", code: "GG" },
  GHS: { country: "Ghana", code: "GH" },
  GIP: { country: "Gibraltar", code: "GI" },
  GMD: { country: "Gambia", code: "GM" },
  GNF: { country: "Guinea", code: "GN" },
  GTQ: { country: "Guatemala", code: "GT" },
  GYD: { country: "Guyana", code: "GY" },
  HKD: { country: "Hong Kong", code: "HK" },
  HNL: { country: "Honduras", code: "HN" },
  HRK: { country: "Croatia", code: "HR" },
  HTG: { country: "Haiti", code: "HT" },
  HUF: { country: "Hungary", code: "HU" },
  IDR: { country: "Indonesia", code: "ID" },
  ILS: { country: "Israel", code: "IL" },
  INR: { country: "India", code: "IN" },
  IQD: { country: "Iraq", code: "IQ" },
  IRR: { country: "Iran", code: "IR" },
  ISK: { country: "Iceland", code: "IS" },
  JMD: { country: "Jamaica", code: "JM" },
  JOD: { country: "Jordan", code: "JO" },
  JPY: { country: "Japan", code: "JP" },
  KES: { country: "Kenya", code: "KE" },
  KGS: { country: "Kyrgyzstan", code: "KG" },
  KHR: { country: "Cambodia", code: "KH" },
  KMF: { country: "Comoros", code: "KM" },
  KPW: { country: "North Korea", code: "KP" },
  KRW: { country: "South Korea", code: "KR" },
  KWD: { country: "Kuwait", code: "KW" },
  KYD: { country: "Cayman Islands", code: "KY" },
  KZT: { country: "Kazakhstan", code: "KZ" },
  LAK: { country: "Laos", code: "LA" },
  LBP: { country: "Lebanon", code: "LB" },
  LKR: { country: "Sri Lanka", code: "LK" },
  LRD: { country: "Liberia", code: "LR" },
  LSL: { country: "Lesotho", code: "LS" },
  LTL: { country: "Lithuania", code: "LT" },
  LVL: { country: "Latvia", code: "LV" },
  LYD: { country: "Libya", code: "LY" },
  MAD: { country: "Morocco", code: "MA" },
  MDL: { country: "Moldova", code: "MD" },
  MGA: { country: "Madagascar", code: "MG" },
  MKD: { country: "North Macedonia", code: "MK" },
  MMK: { country: "Myanmar", code: "MM" },
  MNT: { country: "Mongolia", code: "MN" },
  MOP: { country: "Macau", code: "MO" },
  MRO: { country: "Mauritania", code: "MR" },
  MTL: { country: "Malta", code: "MT" },
  MUR: { country: "Mauritius", code: "MU" },
  MVR: { country: "Maldives", code: "MV" },
  MWK: { country: "Malawi", code: "MW" },
  MXN: { country: "Mexico", code: "MX" },
  MYR: { country: "Malaysia", code: "MY" },
  MZN: { country: "Mozambique", code: "MZ" },
  NAD: { country: "Namibia", code: "NA" },
  XPF: { country: "CFP Franc", code: "NC" },
  NGN: { country: "Nigeria", code: "NG" },
  NIO: { country: "Nicaragua", code: "NI" },
  NPR: { country: "Nepal", code: "NP" },
  NZD: { country: "New Zealand", code: "NZ" },
  OMR: { country: "Oman", code: "OM" },
  PAB: { country: "Panama", code: "PA" },
  PEN: { country: "Peru", code: "PE" },
  PGK: { country: "Papua New Guinea", code: "PG" },
  PHP: { country: "Philippines", code: "PH" },
  PKR: { country: "Pakistan", code: "PK" },
  PLN: { country: "Poland", code: "PL" },
  PYG: { country: "Paraguay", code: "PY" },
  QAR: { country: "Qatar", code: "QA" },
  RON: { country: "Romania", code: "RO" },
  RSD: { country: "Serbia", code: "RS" },
  RUB: { country: "Russia", code: "RU" },
  RWF: { country: "Rwanda", code: "RW" },
  SAR: { country: "Saudi Arabia", code: "SA" },
  SBD: { country: "Solomon Islands", code: "SB" },
  SCR: { country: "Seychelles", code: "SC" },
  SDG: { country: "Sudan", code: "SD" },
  SEK: { country: "Sweden", code: "SE" },
  SGD: { country: "Singapore", code: "SG" },
  SKK: { country: "Slovakia", code: "SK" },
  SLL: { country: "Sierra Leone", code: "SL" },
  SOS: { country: "Somalia", code: "SO" },
  SRD: { country: "Suriname", code: "SR" },
  STD: { country: "São Tomé and Príncipe", code: "ST" },
  SVC: { country: "El Salvador", code: "SV" },
  SYP: { country: "Syria", code: "SY" },
  SZL: { country: "Swaziland", code: "SZ" },
  THB: { country: "Thailand", code: "TH" },
  TJS: { country: "Tajikistan", code: "TJ" },
  TMT: { country: "Turkmenistan", code: "TM" },
  TND: { country: "Tunisia", code: "TN" },
  TOP: { country: "Tonga", code: "TO" },
  TRY: { country: "Turkey", code: "TR" },
  TTD: { country: "Trinidad and Tobago", code: "TT" },
  TWD: { country: "New Taiwan Dollar", code: "TW" },
  TZS: { country: "Tanzania", code: "TZ" },
  UAH: { country: "Ukraine", code: "UA" },
  UGX: { country: "Uganda", code: "UG" },
  USD: { country: "United States", code: "US" },
  UYU: { country: "Uruguay", code: "UY" },
  UZS: { country: "Uzbekistan", code: "UZ" },
  VEF: { country: "Venezuela", code: "VE" },
  VND: { country: "Vietnam", code: "VN" },
  VUV: { country: "Vanuatu", code: "VU" },
  YER: { country: "Yemen", code: "YE" },
  ZAR: { country: "South Africa", code: "ZA" },
  ZMK: { country: "Zambia", code: "ZM" },
  ZWD: { country: "Zimbabwe", code: "ZW" },
};

