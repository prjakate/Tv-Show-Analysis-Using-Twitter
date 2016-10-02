<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>amCharts tutorial: Loading external data</title>
</head>

<!--Load the AJAX API-->
    <script language="javascript" type="text/javascript" 
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js">
    </script>
    <!-- Load Google JSAPI -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
	google.load("visualization", "1", { packages: ["corechart"] });
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "datatvshow.php?<?php echo $checked_shows; ?>",
          dataType:"json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
	 var obj = jQuery.parseJSON(jsonData);
     var data = google.visualization.arrayToDataTable(obj);

	 var options = {
                title: 'Total Tweets Analysis',
				curveType: 'function',
				legend: { position: 'none' }
            };
	  
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_show'));
      chart.draw(data,options);
    }

    </script>
<body>
	<div id="chart_div_show" style="width: device.width; height:600px;"></div>
</body>
</html>