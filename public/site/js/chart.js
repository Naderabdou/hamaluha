const ctx = document.getElementById("myChart");
const COLOR = ["#E1CA9B", "#997D45"];
const data = [
  { price: 0, Month: "ديسمبر" },
  { price: 200, Month: "نوفمبر" },
  { price: 400, Month: "سبتمبر" },
  { price: 600, Month: "أغسطس" },
  { price: 800, Month: "يونيو" },
  { price: 1000, Month: "يوليو" },
  { price: 1200, Month: "مايو" },
  { price: 1400, Month: "أبريل" },
  { price: 1600, Month: "مارس" },
  { price: 1800, Month: "فبراير" },
  { price: 2000, Month: "يناير" },
];
new Chart(ctx, {
  type: "line",
  data: {
    labels: data.map((e) => e.Month),
    datasets: [
      {
        label: "# of Votes",
        data: data.map((e) => e.price),
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        ticks: {
          // Include a dollar sign in the ticks
          callback: function (value, index, ticks) {
            return value + " رس";
          },
        },
      },
    },
    responsive: true,
    fill: true,
    pointStyle: 'circle',
    pointRadius: 5,
    pointHoverRadius: 15 ,
    backgroundColor: COLOR[0],
    borderColor: COLOR[1],
    plugins: {
      title: {
        display: true,
        text: (ctx) => "Point Style: " + ctx.chart.data.datasets[0].pointStyle,
      },
    },
  },
});

Chart.defaults.font.family = "font_main";
