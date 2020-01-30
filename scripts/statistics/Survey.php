<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Lupton Library Survey Results</title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<body>
<?php
error_reporting(0);
date_default_timezone_set('America/New_York');
require_once '/var/www/html/includes/statsconnect.php';

$year = $_POST["year"];
$questionCode = $_POST["questionCode"];
$status = array(1 => "Faculty", 2 => "Staff", 3 => "Students", 4 => "Guests");

if ($year > 2000 && empty($questionCode))
{
	echo "<A NAME='Top'></A>";
	echo "<form action='Survey.php' method='post'>";
	echo "<input type='submit' value='Choose a Different Year'/></form>";

	echo "<h1>$year Lupton Library Survey Results</h1>";

	$questions = mysqli_query($conStatsDB, "SELECT QuestionCode, Question1, Question2, Type FROM Questions WHERE `$year` > 0 ORDER BY `$year`")
		or die('Question Query Failed');

	$question1Old = "";
	echo "<dl>";
	while ($row = mysqli_fetch_array($questions))
	{
		$questionCode = $row['QuestionCode'];
		$question1 = $row['Question1'];
		if ($questionCode != 'Role')
		{
			if ($question1Old != $question1)
				echo "<dt><A HREF='#$questionCode'>" . $row['Question1'] . "</A></dt>";
			if ($row['Question2'] != NULL)
				echo "<dd><A HREF='#$questionCode'>" . $row['Question2'] . "</A></dd>";
		}
		$question1Old = $question1;
	}
	echo "</dl>";

	$questions = mysqli_query($conStatsDB, "SELECT QuestionCode, Question1, Question2, `0`, `1`, `2`, `3`, `4`, `5`, `6`, Type FROM Questions WHERE `$year` > 0 ORDER BY `$year`")
		or die('Question Query Failed');

	while ($row = mysqli_fetch_array($questions))
	{
		$questionCode = $row['QuestionCode'];
		$type = $row['Type'];

		if ($questionCode != 'Role')
			echo "<br /><A NAME='$questionCode'><b>" . $row['Question1'] . " " . $row['Question2'] . "</b></A><br /><br />";

		if ($type != 'Open' && $questionCode != 'Role')
		{
			for ($i = 0; $i < 7; $i++)
			{
				$responseTotal[$i] = 0;
				if ($i < 5 && $i > 0) $statusTotal[$i] = 0;
				for ($j = 0; $j < 5; $j++)
				{
					$totals[$j][$i] = 0;
				}
			}

			$questionTotal = 0;

			for ($i = 0; $i < 7; $i++)
			{
				if (!empty($row[$i]))
				{
					$response[$i] = $row[$i];
				}
				else unset($response[$i]);
			}

			for ($i = 1; $i < 5; $i++)
			{
				$responses = mysqli_query($conStatsDB, "SELECT $questionCode AS questionCode, count($questionCode) AS questionCodeCount FROM `$year` WHERE (Role = $i AND $questionCode != -1) GROUP BY $questionCode");
				while ($row2 = mysqli_fetch_array($responses))
				{
					$questionResponse = $row2['questionCode'];
					$totals[$i][$questionResponse] = $row2['questionCodeCount'];
					$responseTotal[$questionResponse] = $responseTotal[$questionResponse] + $totals[$i][$questionResponse];
					$statusTotal[$i] = $statusTotal[$i] + $totals[$i][$questionResponse];
					$questionTotal = $questionTotal + $totals[$i][$questionResponse];
				}
			}

			if ($type == 'Likert')
			{
				$otherYears = mysqli_query($conStatsDB, "SELECT `2011`, `2010`, `2009`, `2008`, `2007`, `2006`, `2005` FROM Questions WHERE QuestionCode = '$questionCode'")
					or die('Question Query Failed');

				while ($row2 = mysqli_fetch_array($otherYears))
				{
					for ($i = 2011; $i >= 2005; $i--)
					{
						$likert[$i] = 0;
						$temp = $row2[$i];
						if ($temp > 0)
						{
							$totalCount = 0;
							$likertCalc = mysqli_query($conStatsDB, "SELECT $questionCode AS questionCode, count($questionCode) AS questionCodeCount FROM `$i` WHERE ($questionCode > 0) GROUP BY $questionCode");
							while ($row3 = mysqli_fetch_array($likertCalc))
							{
								$temp1 = $row3['questionCode'];
								$temp2 = $row3['questionCodeCount'];
								$likert[$i] = $likert[$i] + $temp1*$temp2;
								$totalCount = $totalCount + $temp2;
							}
							$likert[$i] = round($likert[$i]/$totalCount,2);
						}
					}
				}
			}

			echo "<table border='1'>";
			echo "<tr><th></th>";
			$countResponse = 0;
			$countStatus = 0;
			for ($i = 6; $i >= 0; $i--)
			{
				if (!empty($response[$i]))
				{
					echo "<th><b>$response[$i]</b>";
					if ($type == 'Likert' && $i != 0) echo " ($i)";
					echo "</th>";
					$responseArray[$countResponse] = $i;
					$countResponse++;
				}

				if ($i < 5 && $i > 0 && $statusTotal[$i] > 0)
				{
					$statusArray[$countStatus] = $i;
					$countStatus++;
				}
			}
			if ($type == 'Likert')
			{
				echo "<th>Score Out of 4</th>";
			}
			echo "<th><b>Total</b></th></tr>";
			for ($i = $countStatus-1; $i >= 0; $i--)
			{
				$likertTemp = 0;
				$statusIndex = $statusArray[$i];
				$total = $statusTotal[$statusIndex];
				echo "<tr><td><b>$status[$statusIndex]</b></td>";
				for ($j = 0; $j < $countResponse; $j++)
				{
					$responseIndex = $responseArray[$j];
					$value = $totals[$statusIndex][$responseIndex];
					$percent = round((100*($value/$total)), 1) . "%";
					echo "<td><b>$percent</b> ($value)</td>";
					if ($type == 'Likert')
						$likertTemp = $likertTemp + ($value * $responseIndex);
				}
				if ($type == 'Likert')
				{
					$likertTemp = round(($likertTemp/($total - $totals[$statusIndex][0])),2);
					echo "<td>$likertTemp</td>";
				}
				echo "<td>$total</td></tr>";
			}

			if ($countStatus > 0)
			{
				echo "<tr><td><b>Total</b></td>";
				for ($j = 0; $j < $countResponse; $j++)
				{
					$responseIndex = $responseArray[$j];
					$value = $responseTotal[$responseIndex];
					$percent = round((100*($value/$questionTotal)), 1) . "%";
					echo "<td><b>$percent</b> ($value)</td>";
					$pieChartData[2*$j] = "$j, 0, '$response[$responseIndex]'";
					$pieChartData[2*$j + 1] = "$j, 1, $value";
				}
				if ($type == 'Likert')
				{
					echo "<td>$likert[$year]</td>";
				}
				echo "<td>$questionTotal</td></tr>";
			}

			echo "</table>";

			echo "<script type='text/javascript'>
		      google.load('visualization', '1', {packages:['corechart']});
		      google.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = new google.visualization.DataTable();
		        data.addColumn('string', 'Response');
		        data.addColumn('number', 'Count');
		        data.addRows($countResponse);";
		        for ($i = 0; $i < $countResponse*2; $i++)
		        {
		        	echo "data.setValue($pieChartData[$i]);";
		        }
		        echo "var chart = new google.visualization.PieChart(document.getElementById('chart_pie_$questionCode'));
		        chart.draw(data, {width: 500, height: 300, title: '$year'});
		      }
		    </script>";

			echo "<div id='chart_pie_$questionCode'></div>";

			if ($type == 'Likert')
			{
				$count = 0;
				for ($i = 2005; $i <= 2011; $i++)
				{
					if ($likert[$i] > 0)
					{
						$likertBarData[$count] = floor($count/2) . ", 0, '$i'";
						$count++;
						$likertBarData[$count] = floor($count/2) . ", 1, $likert[$i]";
						$count++;
					}
				}

				$count = $count/2;
				if ($count > 1)
				{
					echo "<script type='text/javascript'>
				      google.load('visualization', '1', {packages:['corechart']});
				      google.setOnLoadCallback(drawChart);
				      function drawChart() {
				        var data = new google.visualization.DataTable();
				        data.addColumn('string', 'Year');
				        data.addColumn('number', 'Score out of 4');
				        data.addRows($count);";
				        for ($i = 0; $i < 2*$count; $i++)
				        {
				        	echo "data.setValue($likertBarData[$i]);";
				        }
				        echo "var chart = new google.visualization.LineChart(document.getElementById('chart_bar_$questionCode'));
				        chart.draw(data, {width: 400, height: 240, title: 'Likert Scores Through Time',
							vAxis: {minValue: 3, maxValue: 4}});
				      }
				    </script>";

					echo "<div id='chart_bar_$questionCode'></div>";
				}
			}
		}

		else if ($type == 'Open')
		{
			echo "<form action='Survey.php' method='post'>";
			echo "<input type='hidden' name='year' value='$year'/>";
			echo "<input type='hidden' name='questionCode' value='$questionCode'/>";
			echo "<input type='submit' value='Open Question - See All Responses'/></form>";
		}
	}
	echo "<br /><A HREF='#Top'>Return to Top</A>";
}

else if (!empty($questionCode))
{
	$questions = mysqli_query($conStatsDB, "SELECT Question1, Question2 FROM Questions WHERE `$year` > 0 AND QuestionCode = '$questionCode'")
		or die('Question Query Failed');
	echo "<A NAME='Top'></A>";
	echo "<form action='Survey.php' method='post'>";
	echo "<input type='hidden' name='year' value='$year'/>";
	echo "<input type='submit' value='Return to $year Survey Results'/></form>";

	while ($row = mysqli_fetch_array($questions))
	{
		echo "<h1>Lupton Library $year Survey</h1>";
		echo "<h2>" . $row['Question1'] . " " . $row['Question2'] . "</h2>";
	}

	for ($i = 1; $i < 5; $i++)
	{
		$responses = mysqli_query($conStatsDB, "SELECT $questionCode AS questionCode FROM `$year` WHERE (Role = $i AND $questionCode IS NOT NULL AND $questionCode != '' AND $questionCode != 'No response') ORDER BY $questionCode ASC");
		if (mysqli_num_rows($responses) > 0)
		{
			echo "<h3>$status[$i]</h3><ul>";
			while ($row = mysqli_fetch_array($responses))
			{
				echo "<li>" . $row['questionCode'] . "</li>";
			}
			echo "</ul>";
		}
	}
	echo "<A HREF='#Top'>Return to Top</A>";
}

else
{
	echo "<h1>Lupton Library Survey Results</h1>";
	echo "<h2>Choose a Year Below</h2>";

	$years = mysqli_query($conStatsDB, "SELECT Year FROM YearSource GROUP BY Year ORDER BY Year DESC") or die('Year Query failed!');

	echo "<form action='Survey.php' method='post'><select name='year'>";
	while($row = mysqli_fetch_array($years))
	{
		echo "<option value='". $row['Year'] . "'>" . $row['Year'] . "</option>";
	}
	echo "</select>";
	echo "<input type='submit' value='Get Statistics'/></form>";
}
mysqli_close($conStatsDB);
?>
</body></html>
