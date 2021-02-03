<?php

include("auth.php");
include("Datalabels.php");
include("Buy.php");
include("Sell.php");
include("Functions.php");
include("Deposit.php");




?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="style.css" />

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     title:'Bitcoin value',
     legend:{position:'bottom'},
     chartArea:{width:'90%', height:'65%'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
   }
  </script>
</head>
<body>



<div class="page-wrapper">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<div class="labels">
    <p> <?php echo $btc ?>KKC </p>

<p> <?php echo $usd ?>USD </p>
<p> <?php echo $Price ?>KKC Price </p>
</div>

<form action="index.php" method="post">
    <label for="Buy">Pirkti KCE</label>
    <input type="text" name="Buy" id="">
    <button type="submit" name="pirkti">Pirkti</button>
</form>
<form action="index.php" method="post">
<label for="Sell">Parduoti KCE</label>
    <input type="text" name="Sell" id="">
    <button type="submit" name="parduoti">Parduoti</button>

</form>
<form action="index.php" method="post">
<label for="Deposit">Pildyti usd</label>
    <input type="text" name="Deposit" id="">
    <button type="submit" name="pildyti">Pildyti</button>
</form>

<a href="logout.php">Logout</a>
<br /><br /><br /><br />
   <br />
   <form action="index.php" method="post">
    <input type="date" name="begin" id="">
    <input type="date" name="end" id="">
    <button type="submit" name="submit">Filtruoti</button>
   </form>
   <h2 align="center">KaukoCoin</h2>
   <div id="line_chart" style="width: 100%; height: 500px"></div>
  </div>




</body>
</html>
