<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>Media Labs | Analysis</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap1.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	 

	 <!--AmCharts for line chart-->
	 <link rel="stylesheet" href="http://www.amcharts.com/lib/style.css" type="text/css">
  <script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
  <script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
  
  
  <script>
AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};
  </script>
  
  
  
  <script>
var chart;

// create chart
AmCharts.ready(function() {

  // load the data
  <?php
  if($_GET["rad1"]=="true")
  {
  ?>
  var chartData = AmCharts.loadJSON('datatvshow.php?time=<?php echo $_GET["time"] ?>');
  <?php
  }
  else if($_GET["rad2"]=="true")
  {
  ?>
  var chartData = AmCharts.loadJSON('datatvcharacter.php?time=<?php echo $_GET["time"] ?>');
  <?php
  }
  ?>
  // SERIAL CHART
  chart = new AmCharts.AmSerialChart();
  chart.pathToImages = "http://www.amcharts.com/lib/images/";
  chart.dataProvider = chartData;
  chart.categoryField = "category";
  //chart.dataDateFormat = "YYYY-MM-DD";

  // GRAPHS

<?php 
if($_GET["rad1"]=="true")
{
for($i=0;$i<=3;$i++)
{
if($_GET["checked_shows_".$i]=="true")
{
?>
  var graph = new AmCharts.AmGraph();
  graph.valueField = "value<?php echo $i; ?>";
  graph.bullet = "round";
  graph.bulletBorderColor = "#FFFFFF";
  graph.bulletBorderThickness = 2;
  graph.lineThickness = 2;
  graph.lineAlpha = 0.5;
  graph.title =
"<?php if($i==0){echo "Balika Vadhu";}
if($i==1){echo "Taarak Mehta Ka Ooltah Chashmah";}
if($i==2){echo "Comedy Nights With Kapil";}
if($i==3){echo "Rangrasiya";}   
  ?>"
  chart.addGraph(graph);
<?php
}
}
}
?>

<?php 
if($_GET["rad2"]=="true")
{
for($i=0;$i<=18;$i++)
{
if($_GET["checked_characters_".$i]=="true")
{
?>
  var graph = new AmCharts.AmGraph();
  graph.valueField = "value<?php echo $i; ?>";
  graph.bullet = "round";
  graph.bulletBorderColor = "#FFFFFF";
  graph.bulletBorderThickness = 2;
  graph.lineThickness = 2;
  graph.lineAlpha = 0.5;
  graph.title =
"<?php 
if($i==0) {echo "shiv";}
if($i==1) {echo "anandi";}
if($i==2) {echo "sanchi";}
if($i==3) {echo "jagdish";} 
if($i==4) {echo "ganga";}
if($i==5) {echo "jethalal";}
if($i==6) {echo "daya";}
if($i==7) {echo "mehta sahab";}
if($i==8) {echo "babitaji";}
if($i==9) {echo "bhide";} 
if($i==10){echo "roshan singh sodhi";}
if($i==11){echo "bittu";}
if($i==12){echo "dadi";}
if($i==13){echo "palak";} 
if($i==14){echo "raju";}
if($i==15){echo "bua";}
if($i==16){echo "parvati";}
if($i==17){echo "rudra";} 
if($i==18){echo "thakur param singh tejawat";} 
?>"
  chart.addGraph(graph);
<?php
}
}
}
?>

  // CATEGORY AXIS
  chart.categoryAxis.parseDates = true;
  <?php
  if($_GET["time"]=="Past 1 Hour")
  {
  echo 'chart.categoryAxis.minPeriod = "hh"';
  }
  else echo 'chart.categoryAxis.minPeriod = "fff"';
  ?>
  //LEGEND
  var legend = new AmCharts.AmLegend();
  chart.addLegend(legend, "legenddiv");
  
  // WRITE
  chart.write("chartdiv");
  
 
});

  </script>
   
	 <!--AmCharts for line chart script ends here -->
	 

	<script>
	function validation_check()
		{
		
		<?php
		$checked_shows="";
		for($i=0;$i<=3;$i++)
		{
		$checked_shows.="&checked_shows_".$i."=".$_GET['checked_shows_'.$i];
		}
		$checked_characters="";
		for($i=0;$i<=18;$i++)
		{
		$checked_characters.="&checked_characters_".$i."=".$_GET['checked_characters_'.$i];
		}
		?>
		
		var rad1=document.getElementById("a_r_1").checked;
		var rad2=document.getElementById("a_r_2").checked;
		var che1=document.getElementById("a_c_1").checked;
		var che2=document.getElementById("a_c_2").checked;
		var che3=document.getElementById("a_c_3").checked;
		var time=document.getElementById("t_p").value;
		
		
		window.location="showanalysis.php?rad1="+rad1+"&rad2="+rad2+"&che1="+che1+"&che2="+che2+"&che3="+che3+"&time="+time+"<?php echo $checked_shows;?>"+"<?php echo $checked_characters;?>";
		}
		
	function return_to_tv_show_comparison()
		{
		var rad1=document.getElementById("a_r_1").checked;
		var rad2=document.getElementById("a_r_2").checked;
		var che1=document.getElementById("a_c_1").checked;
		var che2=document.getElementById("a_c_2").checked;
		var che3=document.getElementById("a_c_3").checked;
		var time=document.getElementById("t_p").value;
		window.location="tvshowcomparison.php?rad1="+rad1+"&rad2="+rad2+"&che1="+che1+"&che2="+che2+"&che3="+che3+"&time="+time;
		}
	function return_to_tv_show_comparison_home()
		{
		window.location="tvshowcomparison.php?rad1="+false+"&rad2="+false+"&che1="+false+"&che2="+false+"&che3="+false+"&time="+"Past 1 Day";
		}
</script>
	
</head>



<body class="page-body  page-left-in" data-url="http://neon.dev">


<div class="page-container" id="back_to_top"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="#">
					<!--<img src="assets/images/logo@2x.png" width="120" alt="" />-->
					<h2 style="color:white;margin-top:2%;">MEDIA LABS</h2>
				</a>
			</div>
			
						<!-- logo collapse icon -->
									
			<!--<div>
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<!--<i class="entypo-menu"></i>
				</a>
			</div>						
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>

			
		</header>
				
		<ul id="main-menu" class="">
			<li class="opened active">
				<a href="index.html">
					<i class="entypo-gauge"></i>
					<span>Dashboard</span>
				</a>
				<ul>
					<li>						
						<a><input type="radio" name="analysis_radiobox" id="a_r_1" value="tv_show_comparison" onclick="return_to_tv_show_comparison()"<?php if($_GET["rad1"]=="true") echo "checked"; ?>><span>TV show Comparison</span></a>
					</li>
					<li>
						<a><input type="radio" name="analysis_radiobox" id="a_r_2" value="tv_character_comparison" onclick="return_to_tv_show_comparison()"<?php if($_GET["rad2"]=="true") echo "checked"; ?>><span>TV Character comparison</span></a>						
					</li>
				</ul>
			</li>
			<li>
				<a href="layout-api.html">
					<i class="entypo-layout"></i>
					<span>Analysis</span>
				</a>
				<ul>
					<li>						
						<a><input type="checkbox" name="analysis_checkbox" id="a_c_1" <?php if($_GET["che1"]=="true") echo "checked"; ?>><span> Sentiment Analysis</span></a>						
					</li>
					<li>						
						<a><input type="checkbox" name="analysis_checkbox" id="a_c_2" <?php if($_GET["che2"]=="true") echo "checked"; ?>><span> Gender Analysis</span></a>						
					</li>
					<li>						
						<a><input type="checkbox" name="analysis_checkbox" id="a_c_3" <?php if($_GET["che3"]=="true") echo "checked"; ?>><span> Device-wise Analysis</span></a>					
					</li>
				</ul>
			</li>
					
			<li>
				<a href="index.html" target="_blank">
					<i class="entypo-calendar"></i>
					<span>Time Period</span>
				</a>
				<ul><li>
					<select class="form-control" name="timeperiod" id="t_p" >
						<option <?php if($_GET["time"]=="Past 1 Hour") echo "selected"; ?>>Past 1 Hour</option>
						<option <?php if($_GET["time"]=="Past 1 Day") echo "selected"; ?>>Past 1 Day</option>
						<option <?php if($_GET["time"]=="Past 1 Week") echo "selected"; ?>>Past 1 Week</option>
						<option <?php if($_GET["time"]=="Past 1 Month") echo "selected"; ?>>Past 1 Month</option>
						<option <?php if($_GET["time"]=="Overall") echo "selected"; ?>>Overall</option>
					</select>
				</li></ul>
			</li>
			<li>
				<a><button class="btn btn-success btn-block" type="submit" onclick="validation_check()"><h4 style="color:white;">Show Analysis</h4></button></a>
			</li>
				
	</div>	
<div class="main-content">
		

	<hr/>

	<ol class="breadcrumb bc-3">
		<li>
			<a><i class="entypo-home"></i><button style="background-color:white;border:none" onclick="return_to_tv_show_comparison_home()">Dashboard</button></a>
		</li>
		<li class="active">
			<a><button style="background-color:white;border:none" onclick="validation_check()"><strong>Analysis</strong></button></a>
		</li>
	</ol>

	<hr/>
	

	<div class="container-fluid"><!--style="border:5px groove;"--><h3><center><font color="#496f7b" face="Arial Black">General Analysis</font></center></h3><hr/>	
		<div id="legenddiv" style="margin: 5px 0 20px 0;"></div>
		<div id="chartdiv" style="height: 600px;width:800px ; margin: 5px 0 20px 0;"></div>			
	</div>
	
<div class="container-fluid table-responsive"><!--style="border:5px groove;"--><h3><center><font color="#496f7b" face="Arial Black">Media Labs-Twitter Analysis</font></center></h3><hr/>
<table class="table table-bordered" id="table-1">
	<thead>
		<tr>
			<th><strong>
			<?php
			if($_GET["rad1"]=="true")
			echo "TV Show";
			else if($_GET["rad2"]=="true")
			echo "TV Characters";
			?>
			</strong></th>
			<th><strong>Total Tweets</strong></th>
			<th><strong>Favourite Tweets</strong></th>
			<th><strong>Retweets</strong></th>
		</tr>
	</thead>
	<tbody>
<?php
$con=mysqli_connect("localhost","root","","twitter");
if($_GET["rad1"]=="true")
{
	include 'tabletvshow.php';
}

else if($_GET["rad2"]=="true")
{
	include 'tabletvcharacter.php';
}
mysqli_close($con);
?>
	</tbody>
</table>
</div>

<?php
if($_GET["che1"]=="true")
{
?>
<div class="container-fluid"><!--style="border:5px groove;"--><h3><center><font color="#496f7b" face="Arial Black">Sentiment Analysis</font></center></h3><hr/>
<?php
if($_GET["rad1"]=="true")
	{		
	include 'donutcharttvshow.php';
	}
else if($_GET["rad2"]=="true")
	{	
	include 'donutcharttvcharacter.php';
	}
}
else echo'<div>';
?>	
</div>
	
	
<?php
if($_GET["che2"]=="true")
{
?>
<div class="container-fluid"><!--style="border:5px groove;"--><h3><center><font color="#496f7b" face="Arial Black">Gender Analysis</font></center></h3><hr/>
<?php
if($_GET["rad1"]=="true")
	{		
	include 'piecharttvshow.php';
	}
else if($_GET["rad2"]=="true")
	{	
	include 'piecharttvcharacter.php';
	}
}
else echo'<div>';
?>	
</div>	


<?php
if($_GET["che3"]=="true")
{
?>
<div class="container-fluid"><!--style="border:5px groove;"--><h3><center><font color="#496f7b" face="Arial Black">Device-wise Analysis</font></center></h3><hr/>
<?php
if($_GET["rad1"]=="true")
	{		
	include 'piecharttvshow2d.php';
	}
else if($_GET["rad2"]=="true")
	{	
	include 'piecharttvcharacter2d.php';
	}
}
else echo'<div>';
?>	
</div>

<footer class="main" style="clear:both;">
	<div class="row">
		 <div class="col-sm-6">
			Copyright &copy;<strong> Media Labs</strong>-All Rights Reserved
		</div>
		<div class="col-sm-3">
		</div>
		<div class="col-sm-3">
				<a href="#back_to_top">Back to Top <span class="glyphicon glyphicon-arrow-up"></span></a>
		</div>
	</div>
</footer>	
</div>


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<!--<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>-->
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom2.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>