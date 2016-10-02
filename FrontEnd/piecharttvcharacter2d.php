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
  $str='select SUM(device_mobile_count),SUM(device_pc_count) from tvcharacter where
        time_start_created >=( SELECT max(time_start_created) - INTERVAL '.$strtime.' from tvshow ) AND 
 name=';
  $strname;
  $strquery;
  for($i=0;$i<=18;$i++)
  {
	if($i==0) {$strname="Shiv";$strquery=$str.'"shiv"';}
	if($i==1) {$strname="Anandi";$strquery=$str.'"anandi"';}
	if($i==2) {$strname="Sanchi";$strquery=$str.'"sanchi"';}
	if($i==3) {$strname="Jagdish";$strquery=$str.'"jagdish"';} 
	if($i==4) {$strname="Ganga";$strquery=$str.'"ganga"';}
	if($i==5) {$strname="Jethalal";$strquery=$str.'"jethalal"';}
	if($i==6) {$strname="Daya";$strquery=$str.'"daya"';}
	if($i==7) {$strname="Taarak";$strquery=$str.'"mehta sahab"';}
	if($i==8){$strname="Babita";$strquery=$str.'"babitaji"';}
	if($i==9){$strname="Bhide";$strquery=$str.'"bhide"';} 
	if($i==10){$strname="Sodhi";$strquery=$str.'"roshan singh sodhi"';}
	if($i==11){$strname="Kapil";$strquery=$str.'"bittu"';}
	if($i==12){$strname="Dadi";$strquery=$str.'"dadi"';}
	if($i==13){$strname="Palak";$strquery=$str.'"palak"';} 
	if($i==14){$strname="Naukar";$strquery=$str.'"raju"';}
	if($i==15){$strname="Bua";$strquery=$str.'"bua"';}
	if($i==16){$strname="Parvati";$strquery=$str.'"parvati"';}
	if($i==17){$strname="Rudra";$strquery=$str.'"rudra"';} 
	if($i==18){$strname="Thakur";$strquery=$str.'"thakur param singh tejawat"';}
	$strquery=$strquery."GROUP BY name";
	$resultSet=mysqli_query($con,$strquery);
    $row=mysqli_fetch_array($resultSet);
	if($_GET["checked_characters_".$i]=="true")
		{
  ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Device', 'tweets'],
          ['Mobile Tweets',     <?php echo $row[0]; ?>],
          ['PC Tweets',      <?php echo $row[1]; ?>],
          ]);

        var options = {
          title: '<?php echo $strname; ?>',
		  slices: {
            0: { color: '#9A3334' },
            1: { color: '#81A594' }
			}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2d<?php echo $i; ?>'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <?php
	echo '<div id="piechart2d'.$i.'"style="float:left;width:450px;margin-left:-26px;margin-right:-26px;height:250px;"></div>';
	}
	}
	mysqli_close($con);
	?>
  </body>
</html>