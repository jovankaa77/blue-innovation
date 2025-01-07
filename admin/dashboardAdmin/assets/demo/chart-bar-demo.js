// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Sangat Buruk", "Buruk", "Biasa", "Baik", "Sangat Baik"],
    datasets: [
      {
        label: "Karyawan",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: [4215, 5312, 6251, 9841, 5821],
      },
    ],
  },
  options: {
    scales: {
      xAxes: [
        {
          time: {
            unit: "karyawan",
          },
          gridLines: {
            display: false,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            min: 0,
            max: 10000,
          },
          gridLines: {
            display: true,
          },
        },
      ],
    },
    legend: {
      display: false,
    },
  },
});
