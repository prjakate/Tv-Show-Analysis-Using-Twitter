<?php session_start(); ?>
<?php
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

$db = mysql_select_db( 'twitter', $link );
if ( !$db ) {
  die ( 'Error selecting database \'twitter\' : ' . mysql_error() );
}


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

$strname;
$strquery;
$j=1;
$prefix = '';
echo "[\n";


 for($i=0;$i<=3;$i++)
  {
	$str='select time_start_created as category,total_tweets as value'.$i.' from tvshow where
	 time_start_created >=( SELECT max(time_start_created) - INTERVAL '.$strtime.' from tvshow ) AND name=';
	if($i==0){$strname="Balika Vadhu";$strquery=$str.'"balika vadhu"';}
	if($i==1){$strname="Taarak Mehta Ka Ooltah Chashmah";$strquery=$str.'"taarak mehta ka ooltah chasmah"';}
	if($i==2){$strname="Comedy Nights With Kapil";$strquery=$str.'"comedy nights"';}
	if($i==3){$strname="Rangrasiya";$strquery=$str.'"rangrasiya"';}  
	$strquery=$strquery."";
	$result=mysql_query($strquery);
   

	if ( !$result )
	{
	$message  = 'Invalid query: ' . mysql_error() . "\n";
	$message .= 'Whole query: ' . $query;
	die( $message );
	}
		
	while ( $row = mysql_fetch_assoc( $result ) ) 
	{
		echo $prefix . " {\n";
		echo '  "category": "' . $row['category'] . '",' . "\n";
		echo '  value'.$i.': ' . $row['value'.$i] . ',' . "\n";
		echo " }";
		$prefix = ",\n";
	}
}
echo "\n]";	
mysql_close($link);
?>