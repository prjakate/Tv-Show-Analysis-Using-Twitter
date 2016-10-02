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
  $str='select SUM(gend_male_count),SUM(gend_female_count) from tvshow where 
       time_start_created >=( SELECT max(time_start_created) - INTERVAL '.$strtime.' from tvshow ) AND 
 name=';
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
          ['Gender', 'tweets'],
          ['Male Tweets', <?php echo $row[0]; ?>],
          ['Female Tweets', <?php echo $row[1]; ?>],
          ]);

        var options = {
          title: '<?php echo $strname; ?>',
		  is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $i; ?>'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <?php
	echo '<div id="piechart'.$i.'"style="float:left;width:450px;margin-left:-26px;margin-right:-26px;height:250px;"></div>';
	}
	}
	mysqli_close($con);
	?>
  </body>
</html>