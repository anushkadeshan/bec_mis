<div>
	<div class="card">
  <div class="card-header">
    Gender wise Job Placement
  </div>
  <div class="card-body">
    <div id="piechart" style=" height: 300px;"></div>
  </div>
</div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'No of Youth'],
          ['Male',     {{$male}}],
          ['Female',      {{$female}}]
        ]);

        var options = {
          title: '',
          chartArea:{
          left:5,
          top: 5,
          bottom:25,
          right : 0,
          },
          legend: { position: 'bottom', alignment: 'center' },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>