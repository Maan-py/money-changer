// const hamburger = document.getElementById("menu");
// const navbarNav = document.getElementById("nav");

// hamburger.onclick = () => {
//   navbarNav.classList.toggle("active");
// };

// document.addEventListener("click", (e) => {
//   if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
//     navbarNav.classList.remove("active");
//   }
// });

// const hamburgerMenu = document.getElementById("hamburger");
// const dropDown = document.getElementById("sidebar");

// hamburgerMenu.addEventListener("click", () => {
//   dropDown.classList.toggle("hidden");
// });

const currencySelect = document.getElementById("currency-select");
const currencyFlag = document.getElementById("currency-flag");
const selectedCurrencyText = document.getElementById("selected-currency");
const exchangeButton = document.getElementById("exchange-button");
const resultAmount = document.getElementById("result");
const loadingMessage = document.getElementById("loading-message");
let convertFrom = document.getElementById("currency-select").value;
let amount = document.getElementById("amount").value;

// Event listener untuk perubahan pada dropdown currency-select
document.getElementById("currency-select").addEventListener("change", function () {
  convertFrom = this.value;
});

document.getElementById("amount").addEventListener("input", function () {
  amount = this.value;
});

Object.entries(countryList).forEach(([currencyCode, { country, code }]) => {
  const optionTag = `
      <option value="${currencyCode}" data-flag="https://flagsapi.com/${code}/shiny/32.png">
          ${country} (${currencyCode})
      </option>
  `;
  currencySelect.insertAdjacentHTML("beforeend", optionTag);
});

currencySelect.addEventListener("change", function () {
  const selectedOption = this.options[this.selectedIndex];
  const flagUrl = selectedOption.getAttribute("data-flag");
  currencyFlag.src = flagUrl;
  selectedCurrencyText.textContent = selectedOption.value;
});

currencySelect.dispatchEvent(new Event("change"));
const getExchangeRate = () => {
  loadingMessage.style.display = "block";
  const URL = `https://v6.exchangerate-api.com/v6/0c98421abcccf6922c36d86f/latest/${convertFrom}`;

  fetch(URL)
    .then((response) =>
      response.json().then((result) => {
        const exchangeRate = result.conversion_rates["IDR"].toFixed(0);

        localStorage.setItem(`exchangeRate_${convertFrom}`, exchangeRate);
        const totalExchangeRate = (exchangeRate * amount).toFixed(0);

        const toRupiah = new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
        }).format(totalExchangeRate);

        resultAmount.innerText = `${amount} ${convertFrom} = ${toRupiah}`;
        loadingMessage.style.display = "none";
      })
    )
    .catch((error) => {
      console.error("Error fetching exchange rate:", error);
      loadingMessage.style.display = "none";
    });
};

exchangeButton.addEventListener("click", function (e) {
  e.preventDefault();
  getExchangeRate();
});
