// js/app.js

document.addEventListener("DOMContentLoaded", function () {
  // Retrieve PHP variables from hidden inputs
  const investedAmount = parseFloat(
    document.getElementById("investedAmount").value
  );
  const returns = parseFloat(document.getElementById("returns").value);

  // Chart.js initialization
  const ctx = document.getElementById("myChart").getContext("2d");
  new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Invested Amount", "Estimated Returns"],
      datasets: [
        {
          label: "SIP Breakdown",
          data: [investedAmount, returns],
          backgroundColor: ["#36a2eb", "#ff6384"],
          hoverOffset: 10,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              let label = context.label || "";
              if (label) {
                label += ": ";
              }
              label += new Intl.NumberFormat("en-IN", {
                style: "currency",
                currency: "INR",
              }).format(context.raw);
              return label;
            },
          },
        },
      },
    },
  });
});
