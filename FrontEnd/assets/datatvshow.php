<?php session_start(); ?>
<?php
$link = mysql_connect( 'localhost', 'root', '' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

$db = mysql_select_db( 'twitter', $link );
if ( !$db ) {
  die ( 'Error selecting database \'test\' : ' . mysql_error() );
}

/*$query = " SELECT name,total_tweets
			FROM tvshow
			where name='balika vadhu' || name='taarak mehta ka ooltah chasmah' || name='comedy nights' || name='rangrasiya'
			ORDER BY name";*/
  /*$strtime;
  if($_GET["time"]=="Past 1 Hour") 
    $strtime="1 Hour";
 else if($_GET["time"]=="Past 1 Day") 
    $strtime="1 Day";
 else if($_GET["time"]=="Past 1 Week") 
    $strtime="1 Week";
 else if($_GET["time"]=="Past 1 Month") 
    $strtime="1 Month";
 else if($_GET["time"]=="Overall") 
    $strtime="1 Year";*/
$str='select SUM(total_tweets) from tvshow where
	 time_start_created >=( SELECT max(time_start_created) - INTERVAL 1 Day from tvshow ) AND name=';
$strname;
$strquery;
$data[0] = array('Show Name','Total_Tweets');	
$j=1;
 for($i=0;$i<=3;$i++)
  {
	if($i==0){$strname="Balika Vadhu";$strquery=$str.'"balika vadhu"';}
	if($i==1){$strname="Taarak Mehta Ka Ooltah Chashmah";$strquery=$str.'"taarak mehta ka ooltah chasmah"';}
	if($i==2){$strname="Comedy Nights With Kapil";$strquery=$str.'"comedy nights"';}
	if($i==3){$strname="Rangrasiya";$strquery=$str.'"rangrasiya"';}  
	$strquery=$strquery."GROUP BY name";
	$resultSet=mysql_query($strquery);
    $row=mysql_fetch_array($resultSet);
	
//$result = mysql_query( $query );

	if ( !$resultSet )
	{
	$message  = 'Invalid query: ' . mysql_error() . "\n";
	$message .= 'Whole query: ' . $query;
	die( $message );
	}

	if($_GET["checked_shows_".$i]=="true")
	{
	//$data[0] = array('Show Name','Total_Tweets');	
	//$j=1;
	//while($row=mysql_fetch_array($result))
	//	{
		$data[$j++] = array($strname,(int)$row[0]);
	//	}	
	}
}
	
echo json_encode($data);
mysql_close($link);
?>