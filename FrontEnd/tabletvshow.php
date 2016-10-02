<?php
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
	$str='select SUM(total_tweets),SUM(fav_count),SUM(retweet_count) from tvshow where 
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
		if($_GET["checked_shows_".$i]=="true")
		{
		$resultSet=mysqli_query($con,$strquery);
		$row=mysqli_fetch_array($resultSet);
		
		echo '<tr>
			<td><strong>';
		echo $strname;
		echo '</strong></td>
			<td><strong>';
		echo $row[0];
		echo '</strong></td>
			<td><strong>';
		echo $row[1];
		echo '</strong></td>
			<td><strong>';
		echo $row[2];
		echo '</strong></td>;
		</tr>';
		}
	}
?>