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
	$str='select SUM(total_tweets),SUM(fav_count),SUM(retweet_count) from tvcharacter where
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