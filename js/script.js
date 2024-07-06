document
  .getElementById("search-div")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    let coinSymbol = document.getElementById("coin-symbol").value;
    let coinString = coinSymbol.split(",");
    console.log(coinString);
    fetch(
      `https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?symbol=${coinSymbol}`,
      {
        method: "GET",
        headers: {
          "X-CMC_PRO_API_KEY": "53aff198-67b9-4c76-b655-250db16f6b67",
          Accept: "application/json",
          "Accept-Encoding": "deflate, gzip",
        },
      }
    )
      .then((response) => response.json())
      .then((data) => {
        // Clear the res-row before adding new content
        document.getElementById("res-row").innerHTML = "";

        for (const i in coinString) {
          let name = data.data[coinString[i]].name;
          let symbol = data.data[coinString[i]].symbol;
          let price = data.data[coinString[i]].quote.USD.price;
          let percentChange =
            data.data[coinString[i]].quote.USD.percent_change_24h;
          let rank = data.data[coinString[i]].cmc_rank;
          let vol24hrs = data.data[coinString[i]].quote.USD.volume_24h;
          let volChng24hrs =
            data.data[coinString[i]].quote.USD.volume_change_24h;
          let percChng1hrs =
            data.data[coinString[i]].quote.USD.percent_change_1h;
          let percChng7days =
            data.data[coinString[i]].quote.USD.percent_change_7d;
          let percChng30days =
            data.data[coinString[i]].quote.USD.percent_change_30d;
          let percChng60days =
            data.data[coinString[i]].quote.USD.percent_change_60d;
          let percChng90days =
            data.data[coinString[i]].quote.USD.percent_change_90d;
          let marketCap = data.data[coinString[i]].quote.USD.market_cap;
          let fullyDilutedmarketCap =
            data.data[coinString[i]].quote.USD.fully_diluted_market_cap;
          let lastUpdated = data.data[coinString[i]].quote.USD.last_updated;
          var output = `
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card-res">
                      <div class="card-body" id="card-body">
                        <h5 class="card-title">${name} (${symbol})</h5>
                        <p>24h Change: ${percentChange.toFixed(3)}%</p>
                        <p class="card-text"> Price: $${price.toFixed(3)}</p>
                        <p>Rank: ${rank}</p>
                        <button class="btn btn-outline-dark" onclick="openModal('${name}', '${vol24hrs}', '${volChng24hrs}', '${percChng1hrs}', '${percChng7days}', '${percChng30days}', '${percChng60days}', '${percChng90days}', '${marketCap}', '${fullyDilutedmarketCap}', '${lastUpdated}')">More Info</button>
                      </div>
                    </div>
                  </div>
          `;
          document.getElementById("res-row").innerHTML += output;
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

function openModal(
  name,
  vol24hrs,
  volChng24hrs,
  percChng1hrs,
  percChng7days,
  percChng30days,
  percChng60days,
  percChng90days,
  marketCap,
  fullyDilutedmarketCap,
  lastUpdated
) {
  const modalBody = document.querySelector("#cryptoModal .modal-body");
  modalBody.innerHTML = `
      <h5>${name}</h5>
      <p>24h Volume: ${vol24hrs}</p>
      <p>24h Volume Change: ${volChng24hrs}%</p>
      <p>1h Change: ${percChng1hrs}%</p>
      <p>7d Change: ${percChng7days}%</p>
      <p>30d Change: ${percChng30days}%</p>
      <p>60d Change: ${percChng60days}%</p>
      <p>90d Change: ${percChng90days}%</p>
      <p>Market Cap: ${marketCap}</p>
      <p>Fully Diluted Market Cap: ${fullyDilutedmarketCap}</p>
      <p>Last Updated: ${lastUpdated}</p>
    `;
  const modal = new bootstrap.Modal(document.getElementById("cryptoModal"));
  modal.show();
}
