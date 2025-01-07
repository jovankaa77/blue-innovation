// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Karyawan
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: "pie",
  data: {
    labels: [
      "Lowongan Kerja",
      "Mengikuti Tes",
      "Wawancara",
      "Sedang Bekerja",
      "Selesai Kerja",
      "Dikeluarkan",
    ],
    datasets: [
      {
        data: [12.21, 15.58, 11.25, 8.32, 10, 8.12],
        backgroundColor: [
          "#8cbae3",
          "#ffc107",
          "#f34d00",
          "#354cdfed",
          "#198754",
          "#ec2136",
        ],
      },
    ],
  },
});
