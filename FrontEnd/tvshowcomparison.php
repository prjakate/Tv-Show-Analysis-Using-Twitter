<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>Media Labs | Dashboard</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap1.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	
	<script src="assets/js/jquery-1.11.0.min.js"></script>


		<style type="text/css">
			.show-image
			{
				border-radius: 5px 5px 5px 5px;
				cursor: pointer;
				width:200px;
				height:200px;
			}
			#show-list
			{
				display:none;
			}
			#character-list
			{
				display: none;
			}
			.shadow {
				-moz-box-shadow:    1px 1px 3px 4px #7cbfe4;
  				-webkit-box-shadow: 1px 1px 3px 4px #7cbfe4;
  				box-shadow:         1px 1px 3px 4px #7cbfe4;
			}
		</style>
	<script type="text/javascript">
			function checkBox(id)
			{
				var a=document.getElementById(id+'-check');
				if(a.checked==true) a.checked=false;
				else a.checked=true;
				if(a.checked==false)
				$('#'+id+'-image').removeClass("shadow");
				else
				$('#'+id+'-image').addClass("shadow");
			}
	</script>

	<script>
	function validation_check()
		{
		alert_msg=""
		var rad1=document.getElementById("a_r_1").checked;
		var rad2=document.getElementById("a_r_2").checked;
		if(!rad1 && !rad2) alert("* Please select either of the comparisons to proceed with the analysis");
		var che1=document.getElementById("a_c_1").checked;
		var che2=document.getElementById("a_c_2").checked;
		var che3=document.getElementById("a_c_3").checked;
		var time=document.getElementById("t_p").value;
		
		var checked_shows_alert="";
		var checked_shows="";
		var shows=document.getElementsByName("show");
		for(i=0;i<shows.length;i++)
			{
			if(shows[i].checked) 
			{
			checked_shows_alert+=shows[i].value+","; 
			checked_shows+="&checked_shows_"+i+"="+true;
			}
			else 
			{
			checked_shows+="&checked_shows_"+i+"="+false;
			}
			}
			
		var checked_characters_alert="";
		var checked_characters="";
		var characters=document.getElementsByName("character");
		for(i=0;i<characters.length;i++)
			{
			if(characters[i].checked) 
			{
			checked_characters_alert+=characters[i].value+","; 
			checked_characters+="&checked_characters_"+i+"="+true;
			}
			else 
			{
			checked_characters+="&checked_characters_"+i+"="+false;
			}
			}
		
		
		
		if(rad1 && !checked_shows_alert) alert("* Please select the SHOWS for analysis");
		if(rad2 && !checked_characters_alert) alert("* Please select the CHARACTERS for analysis");
		if((rad1 && checked_shows_alert) || (rad2 && checked_characters_alert))   window.location="showanalysis.php?rad1="+rad1+"&rad2="+rad2+"&che1="+che1+"&che2="+che2+"&che3="+che3+"&time="+time+checked_shows+checked_characters;


		}
		
	function return_to_tv_show_comparison()
		{
		window.location="tvshowcomparison.php?rad1="+false+"&rad2="+false+"&che1="+false+"&che2="+false+"&che3="+false+"&time="+"Past 1 day";
		}
	
	function vis1()
		{
			document.getElementById("show-list").style.display='block';
			document.getElementById("character-list").style.display='none';		
		if(document.getElementById("rows1")!=null)document.getElementById("rows1").style.display="none";
		if(document.getElementById("rows2")!=null)document.getElementById("rows2").style.display="none";
		if(document.getElementById("rows3")!=null)document.getElementById("rows3").style.display="none";
		}	
	function vis2()
		{
		
		if(document.getElementById("rows1")!=null)document.getElementById("rows1").style.display="none";
		if(document.getElementById("rows2")!=null)document.getElementById("rows2").style.display="none";
		if(document.getElementById("rows3")!=null)document.getElementById("rows3").style.display="none";
		document.getElementById("show-list").style.display='none';
		document.getElementById("character-list").style.display='block';
		}	
		function load()
		{

			<?php
			if($_GET["rad1"]=="true") 
			echo '
			document.getElementById("show-list").style.display="block"';
			else if($_GET["rad2"]=="true")
			echo ' 
			document.getElementById("character-list").style.display="block"';
			?>
		}
</script>

</head>



<body class="page-body  page-left-in" data-url="http://neon.dev" onload="load()">


<div class="page-container container-fluid" id="back_to_top"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
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
						<a><input type="radio" name="analysis_radiobox" id="a_r_1" value="tv_show_comparison" onclick="vis1()" <?php if($_GET["rad1"]=="true") echo "checked"; ?>><span>TV show Comparison</span></a>
					</li>
					<li>
						<a><input type="radio" name="analysis_radiobox" id="a_r_2" value="tv_character_comparison" onclick="vis2()" <?php if($_GET["rad2"]=="true") echo "checked"; ?>><span>TV Character comparison</span></a>						
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
		<li class="active">
			<a><i class="entypo-home"></i><button style="background-color:white;border:none" onclick="return_to_tv_show_comparison()"><strong>Dashboard</strong></button></a>
		</li>
	</ol>
<?php
if($_GET["rad1"]=="false" && $_GET["rad2"]=="false")
{
?>
<div class="row" id="rows1">
	<div class="col-sm-12">
		<div class="well">
			<h2>Dashboard<small><small style="color:green;"> (Select one of the options to proceed) </small></small></h2>
			<li><h4>Select<strong> TV show comparison</strong> if you want to obtain comparative analysis of different shows together</h4></li>
			<li><h4>Select<strong> TV character comparison</strong> if you want to obtain comparative analysis of different characters of different shows</h4></li>

		</div>
	</div>
</div>

<div class="row" id="rows2">
	<div class="col-sm-12">
		<div class="well">
			<h2>Analysis<small><small style="color:green;"> (If nothing is selected,General Analysis will be shown) </small></small></h2>
			<li><h4>Select<strong> Sentiment Analysis</strong> if you want to obtain <strong>+ve/-ve tweets</strong> information</h4></li>
			<li><h4>Select<strong> Gender Analysis</strong> if you want to obtain <strong>Male/Female<strong> analysis of tweets</h4></li>
			<li><h4>Select<strong> Device-wise Analysis</strong> if you want to know the device used for making tweets i.e., <strong>Mobile/Computer<strong></h4></li>
		</div>
	</div>
</div>

<div class="row" id="rows3">
	<div class="col-sm-12">
		<div class="well">
			<h2>Time Period<small><small style="color:green;"> (Default is hourly) </small></small></h2>
			<li><h4>The Analysis is shown for the period specified in <strong>Time Period </strong>field</h4></li>
		</div>
	</div>
</div>
<?php
}
?>

<hr/>


<div id="character-list">
		<?php
			$characterlist=array(
				"Balika Vadhu"=>array("shiv","anandi","sanchi","jagdish","ganga"),
				"Taarak Mehta Ka Ooltah Chasmah"=>array("jethalal","daya","taarak","babita","bhide","sodhi"),
				"Comedy Nights With Kapil"=>array("kapil","dadi","palak","naukar","bua"),
				"Rangrasiya"=>array("parvati","rudra","thakur")
				);
			foreach($characterlist as $show=>$chars)
			{
				echo '<div class="row" style="margin-left:10px;"><h3><span class="glyphicon glyphicon-expand">'.' '.$show.'</span></h3></div><div class="row">';
				$count=0;
				foreach($chars as $char)
				{
					$count++;
					echo '<div class="col-md-3">
					<img width="100%" height="150px" class="show-image" src="./assets/images/'.$char.'.png" onclick="checkBox(\''.$char.'\');" id="'.$char.'-image"/>
			<input id="'.$char.'-check" style = "display:none;" name="character" type="checkbox" value="'.($count-1).'"/>
				<div><center>'.ucwords($char).'</center></div>
					</div>';
					if($count>=4)
					{
						$count=0;
						echo '</div><div class="row"></div><div class="row">';
					}
				}
				echo '</div>';
			}
		?>
</div>


<div id="show-list">
	<div class="row">
		<div class="col-md-3">
			<img class="show-image" src="./assets/images/balikavadhu.jpg" onclick="checkBox('balikavadhu');" id="balikavadhu-image"/>
			<input id="balikavadhu-check" style = "display:none;" name="show" value="1" type="checkbox"/>
		</div>
		<div class="col-md-3">
			<img class="show-image" src="./assets/images/tarak.jpg" onclick="checkBox('tarak');" id="tarak-image"/>
			<input id="tarak-check" style = "display:none;" name="show" value="1" type="checkbox"/>
		</div>
		<div class="col-md-3">
			<img class="show-image" src="./assets/images/comedynights.jpg" onclick="checkBox('comedynights');" id="comedynights-image"/>
			<input id="comedynights-check" style="display:none;" name="show" value="2" type="checkbox"/>
		</div>
		<div class="col-md-3">
			<img class="show-image" src="./assets/images/rangrasiya.jpg" onclick="checkBox('rangrasiya');" id="rangrasiya-image"/>
			<input id="rangrasiya-check" style = "display:none;" name="show"  value="4" type="checkbox"/>
		</div>
	</div>
</div>



<footer class="main">
	
		
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
	
</footer>	</div>


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
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="assets/js/neon-chat.js"></script>>-->
	<script src="assets/js/neon-custom2.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>