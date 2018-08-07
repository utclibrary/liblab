<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Database Usage</title>
</head>
<body>
<h2>Database Usage Data</h2>
<h5>Note: Due to a database connection error, no statistics are available from 2/19/2016 at 6:05pm thru 3/14/2016 at 2:20pm.</h5>
<?php
// enable/disable error reporting
//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
echo "<div style='display:block;text-align:center;'><a style='margin:.5em;padding:.25em;border:1px solid black;' href='".$currentFile."'>Reset</a></div>";
// connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
if(isset($_GET["db"])) {
$database = $_GET["db"];
}else{$database = "";}
if (empty($database))
{
	$query = "SELECT Title, Key_ID FROM Dbases ORDER BY Title";
	$result = mysqli_query($conLuptonDB , $query);
	$count = 1;
	while($row = mysqli_fetch_array($result))
	{
		$dbTitle[$count] = $row['Title'];
		$dbID[$count] = $row['Key_ID'];
		$count++;
	}
	date_default_timezone_set('America/New_York');
	$today = time();
	$currentYear = date('Y',$today);

	echo "<form action='".$currentFile."' method='get'>";
		echo "<select name='db'>";
			echo "<option value='-1' selected>All Databases</option>";
			for($i=1; $i<$count; $i++)
			{
				echo "<option value='" . $dbID[$i] ."'>" . $dbTitle[$i] . "</option>";
			}
		echo "</select>";
		echo "<select name='year'>";
			echo "<option value='0' selected>All Years</option>";
			for ($i=$currentYear; $i>2011; $i--)
			{
				echo "<option value='$i'>$i</option>";
			}
		echo "</select>";
		echo "<button type='submit' class='btn'>Submit</button>";
	echo "</form>";
}

else
{
	$year = $_GET["year"];
	$nextYear = $year+1;
	$whereClause = "";
	if ($year > 0 || $database > 0)
	{
		$whereClause = "WHERE ";
		if ($year > 0)
			$whereClause .= "Date >= '" . $year . "-01-01 00:00:00' AND Date <= '" . $nextYear . "-01-01 00:00:00'";
		if ($database > 0)
		{
			if ($whereClause != "WHERE ")
				$whereClause .= " AND ";
			$whereClause .= "DBUsage.Key_ID = $database";
		}
	}

	$result = mysqli_query($conLuptonDB , "SELECT count(Usage_ID) AS UsageCount FROM DBUsage $whereClause");

	while($row = mysqli_fetch_array($result))
	{
		echo "Your parameters returned " . $row['UsageCount'] . " uses.<br/><br/>";
	}


	$result = mysqli_query($conLuptonDB , "SELECT DBUsage.Date AS Date, DBUsage.RefURL AS URL, Dbases.Title AS Title FROM DBUsage INNER JOIN Dbases ON DBUsage.Key_ID = Dbases.Key_ID $whereClause GROUP BY Date DESC");

	echo "<table border='1'>";
	echo "<tr><th>Title</th><th>Usage Date</th><th>Referring URL</th></th></tr>";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td>";
		echo $row['Title'];
		echo "</td><td>";
		echo $row['Date'];
		echo "</td><td>";
		echo $row['URL'];
		echo "</td></tr>";
	}
	echo "</table>";
}
mysqli_close($conLuptonDB);
?>
</body></html>
