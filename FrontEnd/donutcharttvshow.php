<!DOCTYPE HTML>
<html>
  <head>
  <?php
  $con=mysqli_connect("localhost","root","","twitter");
  $strtime;
  if($_GET["time"]=="Past 1 Hour") 
    $strtime="1 Hour";
 else if($_GET["time"]=="Past 1 Day") 
    $strtime="1 Day";
 else if($_GET["time"]=="Past 1 Week") 
    $strtime="1 Week";
 else if($_GET["time"]=="Past 1 Month") 
    $strtime="1 Month";
 else if($_GET["time"]=="Overall") 
    $strtime="1 Year";
  $str='select SUM(male_pos_count),SUM(male_neg_count),SUM(male_neu_count),SUM(female_pos_count),SUM(female_neg_count),SUM(female_neu_count) from tvshow 
		where time_start_created >=( SELECT max(time_start_created) - INTERVAL '.$strtime.' from tvshow ) AND name=';
  $strname;
  $strquery;
  for($i=0;$i<=3;$i++)
  {
	if($i==0){$strname="Balika Vadhu";$strquery=$str.'"balika vadhu"';}
	if($i==1){$strname="Taarak Mehta Ka Ooltah Chashmah";$strquery=$str.'"taarak mehta ka ooltah chasmah"';}
	if($i==2){$strname="Comedy Nights With Kapil";$strquery=$str.'"comedy nights"';}
	if($i==3){$strname="Rangrasiya";$strquery=$str.'"rangrasiya"';}  
	$strquery=$strquery."GROUP BY name";
	$resultSet=mysqli_query($con,$strquery);
    $row=mysqli_fetch_array($resultSet);
	if($_GET["checked_shows_".$i]=="true")
		{
  ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Sentiment', 'Tweets'],
          ['+ve Tweets(M)', 	<?php echo $row[0]; ?>],
          ['-ve Tweets(M)', 	<?php echo $row[1]; ?>],
		  ['Neutral Tweets(M)', <?php echo $row[2]; ?>],
		  ['+ve Tweets(F)', 	<?php echo $row[3]; ?>],
          ['-ve Tweets(F)', 	<?php echo $row[4]; ?>],
		  ['Neutral Tweets(F)', <?php echo $row[5]; ?>],
          ]);

        var options = {
          title: '<?php echo $strname; ?>',
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart<?php echo $i; ?>'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <?php
	echo '<div id="donutchart'.$i.'"style="float:left;width:450px;margin-left:-26px;margin-right:-26px;height:250px;"></div>';
	}
	}
	mysqli_close($con);
	?>
  </body>
</html>