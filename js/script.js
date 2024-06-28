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
          var output = `
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card card-res">
                      <div class="card-body" id="card-body">
                        <h5 class="card-title">${name} (${symbol})</h5>
                        <p class="card-text"> Price: $${price.toFixed(3)}</p>
                        <p>24h Change: ${percentChange.toFixed(3)}%</p>
                        <p>Rank: ${rank}</p>
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
// function logout() {
//   // Handle logout logic here
//   window.location.href = "index.html";
// }
