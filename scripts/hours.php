<style>
	a.libhours:link {color:#FFFFFF; text-decoration:none;}    /* unvisited link */
	a.libhours:visited {color:#FFFFFF; text-decoration:none;} /* visited link */
	a.libhours:hover {color:#B8B8B8; text-decoration:none;}   /* mouse over link */
	a.libhours:active {color:#FFFFFF; text-decoration:none;}  /* selected link */
</style>
<?php
// block error reporting for live code
//error_reporting(0);
// enable/disable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
//if specialMessageLine1 is populated, the special message will replace the Library Hours, otherwise library hours will appear as usual
$specialMessageLine1 = "";
$specialMessageLine2 = "";
//if special message should be displayed in red, value should be "yes"
$specialMessageIsRed = "yes";

//do not edit below this line unless you know what your are doing!
$display = "";
// set specialMessageLine1 to "" in case it accidentally gets deleted
if (empty($specialMessageLine1))
	$specialMessageLine1 = "";

// display special message if populated
if ($specialMessageLine1 != "")
{
	// display in red if chosen
	if ($specialMessageIsRed == 'yes')
		$display .= "<font color='red'>";
	$display .= "<div class='pull-right'>" . $specialMessageLine1 . "</div>";
	$display .= "<br/><div class='pull-right'>" . $specialMessageLine2 . "</div>";
	if ($specialMessageIsRed == 'yes')
		$display .= "</font>";
}

else
{
	//specify databases
	//$dbname = "Date";
	// connect to database
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';

	// set timezone
	date_default_timezone_set('America/New_York');
	$today = time();

	// exam closing hour
	$examClose = 2;

	// logic to display the previous days' hours during early am closings
	if (date('G',$today) < $examClose)
	{
		// get yesterday's timestamp
		$yesterday = $today - (24*60*60);
		// fetch all start dates
		$resultDate = mysqli_query("SELECT startDate, termLabel FROM Calendar ORDER BY startDate");

		// choose the current term (nearest date in the past)
		while($row = mysqli_fetch_array($resultDate))
		{
			$startDate = strtotime($row["startDate"]);
			if ($startDate <= $yesterday)
				$term = $row['termLabel'];
			else break;
		}

		// choose appropriate day of week
		$yesterdayDay = strtolower(date('D',$yesterday));
		$end = $yesterdayDay . "Close";

		// fetch open and close times for current day of week
		$resultDate = mysqli_query("SELECT $end FROM Term WHERE termLabel='$term'");
		while($row = mysqli_fetch_array($resultDate))
		{
			$close = strtotime($row["$end"]);
		}

		// if yesterday's close time is less than the exam close time, but not midnight convert today to yesterday
		if (date('G',$close) <= $examClose && date('H:i:s',$close) != '00:00:00') $today = $yesterday;
	}

	// fetch all start dates
	$resultDate = mysqli_query($conDate , "SELECT startDate, termLabel FROM Calendar ORDER BY startDate");

	// choose the current term (nearest date in the past)
	while($row = mysqli_fetch_array($resultDate))
	{
		$startDate = strtotime($row["startDate"]);
		if ($startDate <= $today)
			$term = $row['termLabel'];
		else break;
	}

	// choose appropriate day of week
	$todayDay = strtolower(date('D',$today));
	$start = $todayDay . "Open";
	$end = $todayDay . "Close";

	// fetch open and close times for current day of week
	$resultDate = mysqli_query($conDate , "SELECT $start, $end FROM Term WHERE termLabel='$term'");
	while($row = mysqli_fetch_array($resultDate))
	{
		// create time from string
		$open = strtotime($row["$start"]);
		$close = strtotime($row["$end"]);
	}

	// store hyperlink
	$display .= "<div class='pull-right'><a class='libhours' href='//www.utc.edu/library/about/hours.php'>";

	// if open time and close time are equal, set hours to Closed
	if ($open == $close)
		$display .= date('l, F jS',$today) . ", CLOSED";
	// otherwise set display hours
	else
		$display .= date('D n/j/y',$today) . ", " . date('g:ia',$open) . "-" . date('g:ia',$close);
	$display .= "</a></div>";

	mysqli_close($conDate);

	$display .= "<br/><div class='pull-right'><a class='libhours' href='//www.utc.edu/library/services/accounts.php'>My Library Accounts</a></div>";
}

// diplay hours string or special message
echo $display;
?>
