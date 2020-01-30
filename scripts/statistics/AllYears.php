<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Lupton Library Survey Results</title>
<style type="text/css">
   TABLE  { border: solid black }
   TD.satisfied { background: #B99C94 }
   TD.dissatisfied { background: #AE94B9 } 
   TD.nobasis { background: #9EB994 }
   TD.likert { background: #B99C94 }
   TD.responses { background: #94B1B9 }
   
   TH.satisfied { background: #B99C94 }
   TH.dissatisfied { background: #AE94B9 }
   TH.nobasis { background: #9EB994 }
   TH.likert { background: #B99C94 }
   TH.responses { background: #94B1B9 }
</style>
</head>
<body>
<?php
error_reporting(0);
date_default_timezone_set('America/New_York');
require_once '/var/www/html/includes/statsconnect.php';

$clearForm = $_POST["clearForm"];
$display = $_POST["display"];

if (empty($_POST["faculty"]) || $clearForm == 1) $type[1] = 0;
else $type[1] = 1;
if (empty($_POST["staff"]) || $clearForm == 1) $type[2] = 0;
else $type[2] = 1;
if (empty($_POST["student"]) || $clearForm == 1) $type[3] = 0;
else $type[3] = 1;
if (empty($_POST["guest"]) || $clearForm == 1) $type[4] = 0;
else $type[4] = 1;

$status = array(1 => "Faculty", 2 => "Staff", 3 => "Students", 4 => "Guests");

if ($type[1] == 1 || $type[2] == 1 || $type[3] == 1 || $type[4] == 1)
{	
	$years = mysqli_query($conStatsDB, "SELECT Year FROM YearSource GROUP BY Year ORDER BY Year DESC") or die('Year Query failed!');
	$numOfYears = 0;
		
	while($row = mysqli_fetch_array($years))
	{
		$year = $row['Year'];
		$numOfYears++;
		$questions = mysqli_query($conStatsDB, "SELECT QuestionCode, `0`, `1`, `2`, `3`, `4`, `5`, `6`, Type FROM Questions WHERE `$year` > 0 AND Type = 'LikertCore' ORDER BY `$year`")
			or die('Question Query Failed');
		while ($row = mysqli_fetch_array($questions))
		{
			$questionCode = $row['QuestionCode'];
			$total[$year][$questionCode] = 0;
			for ($response = 0; $response < 6; $response++)
			{
				$count[$year][$questionCode][$response] = 0;
				for ($role = 1; $role < 5; $role++)
				{	
					if ($type[$role] == 1)
					{
						$counts = mysqli_query($conStatsDB, "SELECT count($questionCode) AS Count FROM `$year` WHERE Role = $role AND $questionCode = $response");
						while ($row = mysqli_fetch_array($counts))
						{
							$count[$year][$questionCode][$response] = $count[$year][$questionCode][$response] + $row['Count'];
							$total[$year][$questionCode] = $total[$year][$questionCode] + $row['Count'];
						}
					}
				}
			}
		}
	}
	
	// Test Code
	/*$questions = mysqli_query($conStatsDB, "SELECT QuestionCode FROM Questions WHERE Type = 'LikertCore' ORDER BY DefaultOrder");
	while ($row = mysqli_fetch_array($questions))
	{
		$questionCode = $row['QuestionCode'];
		for ($year=2004; $year<2012; $year++)
		{
			echo "Total responses for $year, $questionCode: " . $total[$year][$questionCode] . "<br />";
			for ($response = 0; $response < 6; $response++)
			{
				echo "Total responses for $year, $questionCode, $response: " . $count[$year][$questionCode][$response] . "<br />";
			}
		}
	}*/
	
	$numOfYears;
	$currentYear = 2003 + $numOfYears;
	
	echo "<h1>Lupton Library Annual Survey Statistics</h1>";
	
	echo "<form action='AllYears.php' method='post'>";
	echo "<input type='hidden' name='clearForm' value=1>";
	echo "<input type='submit' value='Return to Patron and Results Selection Form'/></form><br />";
	
	if ($display == 'likert')
		echo "Likert Scale: 4=Very Satisfied; 3=Satisfied; 2=Dissatisfied; 1=Very Dissatisfied<br /><br />";
	
	echo "<table border='1'><tr><th rowspan='2'>Includes:<br />"; 
	for ($i = 1; $i < 5; $i++)
	{
		if ($type[$i] == 1) echo " " . $status[$i] . " ";
	}
	echo "</th>";
	$columnSpan = $numOfYears+1;
	if ($display == 'likert')
	{
		echo "<th colspan='$columnSpan'; CLASS='likert'>Likert (Scale of 1 to 4)</th>";
		echo "<th colspan='$columnSpan'; CLASS='nobasis'>% No basis for judgment (not included in Likert)</th>";
	}
	else
	{
		echo "<th colspan='$columnSpan'; CLASS='satisfied'>% Satisfied</th>";
		echo "<th colspan='$columnSpan'; CLASS='dissatisfied'>% Dissatisfied</th>";
		if ($display == 'percentageAdj')
		{
			echo "<th colspan='$columnSpan'; CLASS='nobasis'>% No basis for judgment (not included in Dis/Satistifed %'s)</th>";
		}
		else echo "<th colspan='$columnSpan'; CLASS='nobasis'>% No basis for judgment</th>";
	}

	$tempColumnSpan = $columnSpan-1;
	echo "<th colspan='$tempColumnSpan'; CLASS='responses'>Total Responses</th></tr>";
	
	echo "<tr>";
	if ($display == 'likert') $sets = 3;
	else $sets = 4;
	for ($i = 0; $i<$sets; $i++)
	{
		for ($j=$currentYear; $j>2003; $j--)
		{
			echo  "<th>$j</th>";
		}
		if ($i < $sets-1) echo "<th>Change 2004 - $currentYear</th>";
	}
	echo "</tr>";
	
	$questions = mysqli_query($conStatsDB, "SELECT QuestionCode, Question1, Question2 FROM Questions WHERE Type = 'LikertCore' ORDER BY DefaultOrder");
	$question1 = "";
	while($row = mysqli_fetch_array($questions))
	{
		$questionCode = $row['QuestionCode'];
		if ($question1 != $row['Question1'])
		{
			$columnSpan = 4 * $numOfYears + 4;
			echo "<tr><td colspan='$columnSpan'><b>" . $row['Question1'] . "</b></td></tr>";
		}
		$question1 = $row['Question1'];
		
		echo "<tr><td>" . $row['Question2'] . "</td>";
		
		if ($display == 'likert')
		{
			for ($year=$currentYear; $year>2003; $year--)
			{
				$likert[$year] = 0;
				if (($total[$year][$questionCode]-$count[$year][$questionCode][0]) > 0)
				{
					$likert[$year] = $likert[$year] + ((4*$count[$year][$questionCode][5])+
						(3*$count[$year][$questionCode][4])+
						(2.5*$count[$year][$questionCode][3])+
						(2*$count[$year][$questionCode][2])+
						(1*$count[$year][$questionCode][1]))/($total[$year][$questionCode]-$count[$year][$questionCode][0]);
						echo "<td CLASS='likert'>" . round($likert[$year],2) . "</td>";
				}
				else echo "<td CLASS='likert'>--</td>";
			}
			$newestLikertYear = 0;
			$oldestLikertYear = 0;
			for ($year=$currentYear; $year>2003; $year--)
			{
				if ($likert[$year] != 0) $oldestLikertYear = $year;
			}
			for ($year=2004; $year<=$currentYear; $year++)
			{
				if ($likert[$year] != 0) $newestLikertYear = $year;
			}
			if ($newestLikertYear == $oldestLikertYear) echo "<td CLASS='likert'>--</td>";
			else
			echo "<td CLASS='likert'>" . round(((($likert[$newestLikertYear] - $likert[$oldestLikertYear])/$likert[$oldestLikertYear]))*100,1) . "%</td>";	
		}
		
		for ($i = 0; $i < 3; $i++)
		{
			if ($display == 'likert')
			{
				$i = 2;
			}
			// response range for satisfied
			if ($i == 0)
			{
				$start = 5;
				$end = 3;
				$class = 'satisfied';
			}
			// response range for dissatisfied
			else if ($i == 1)
			{
				$start = 2;
				$end = 1;
				$class = 'dissatisfied';
			}
			// response range for no basis for judgement
			else
			{
				$start = 0;
				$end = 0;
				$class = 'nobasis';
			}

			for ($year=$currentYear; $year>2003; $year--)
			{
				$responseNumber = 0;
				$percent[$year] = -1;
				if ($total[$year][$questionCode] == 0) 
					echo "<td CLASS='$class'>--</td>";
				else
				{
					for($response=$start; $response>=$end; $response--)
					{
						$responseNumber = $responseNumber + $count[$year][$questionCode][$response];
					}
					if ($display == 'percentageAdj' && $i <2)
						$percent[$year] = ($responseNumber/($total[$year][$questionCode]-$count[$year][$questionCode][0]))*100;
					else $percent[$year] = ($responseNumber/$total[$year][$questionCode])*100;
					echo "<td CLASS='$class'>" . round($percent[$year],1) . "%</td>";
				}
			}
			
			$newestPercentYear = 0;
			$oldestPercentYear = 0;
			for ($year=$currentYear; $year>2003; $year--)
			{
				if ($percent[$year] != -1) $oldestPercentYear = $year;
			}
			for ($year=2004; $year<=$currentYear; $year++)
			{
				if ($percent[$year] != -1) $newestPercentYear = $year;
			}
			if ($newestPercentYear == $oldestPercentYear) echo "<td CLASS='$class'>--</td>";
			else
			echo "<td CLASS='$class'>" . round(((($percent[$newestPercentYear] - $percent[$oldestPercentYear])/$percent[$oldestPercentYear]))*100,1) . "%</td>";
		}
		
		for ($year=$currentYear; $year>2003; $year--)
		{
			if ($total[$year][$questionCode] < 1) echo "<td CLASS='responses'>--</td>";
			else echo "<td CLASS='responses'>" . $total[$year][$questionCode] . "</td>";
		}
		echo "</tr>";	
	}	
	
	echo "<tr><th rowspan='2'>Includes:<br />"; 
	for ($i = 1; $i < 5; $i++)
	{
		if ($type[$i] == 1) echo " " . $status[$i] . " ";
	}
	echo "</th>";
	
	if ($display == 'likert') $sets = 3;
	else $sets = 4;
	for ($i = 0; $i<$sets; $i++)
	{
		for ($j=$currentYear; $j>2003; $j--)
		{
			echo  "<th>$j</th>";
		}
		if ($i < $sets-1) echo "<th>Change 2004 - $currentYear</th>";
	}
	echo "</tr>";
	
	echo "<tr>";
	$columnSpan = $numOfYears+1;
	if ($display == 'likert')
		echo "<th colspan='$columnSpan'; CLASS='likert'>Likert (Scale of 1 to 4)</th>"; 
	else
	{
		echo "<th colspan='$columnSpan'; CLASS='satisfied'>% Satisfied</th>";
		echo "<th colspan='$columnSpan'; CLASS='dissatisfied'>% Dissatisfied</th>";
	}
	echo "<th colspan='$columnSpan'; CLASS='nobasis'>% No basis for judgment</th>";
	$tempColumnSpan = $columnSpan-1;
	echo "<th colspan='$tempColumnSpan'; CLASS='responses'>Total Responses</th></tr>";
	
	echo "</table><br /><br />";
}

else
{
	echo "<h1>Lupton Library Survey Overall Results</h1>";
	echo "<h3>Choose the patron types that you would like included in your results and your preferred data format.</h3>";

	echo "<form action='AllYears.php' method='post'>";
	echo "<input type='checkbox' name='faculty'>Faculty<br />";
	echo "<input type='checkbox' name='staff'>Staff<br />";
	echo "<input type='checkbox' name='student'>Students<br />";
	echo "<input type='checkbox' name='guest'>Guests<br /><br />";
	echo "<input type='hidden' name='clearForm' value=0>";
	echo "Data format: ";
	echo "<select name='display'>
	<option value='percentage'>Satisfaction Percentage</option>
	<option value='percentageAdj'>Satisfaction Percentage (ignores <i>No Basis for Judgement</i>)</option>
	<option value='likert'>Likert Score (1-4 Scale)</option></select><br />";
	echo "<br /><input type='submit' value='Get Statistics'/></form>";
}
mysqli_close($conStatsDB);
?>
</body></html>
