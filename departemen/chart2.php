<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Angkatan', 'Jumlah Mahasiswa'],
          ['Angkatan 2018',     0],
          ['Angkatan 2019',      1],
          ['Angkatan 2020',  1],
          ['Angkatan 2021', 1],
          ['Angkatan 2022',    1]
        ]);

        var options = {
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    
  </body>
</html>