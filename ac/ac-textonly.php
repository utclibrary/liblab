<?php
// Redirect to index if dates are not all specified
$datevars = array('one','two');
foreach ($datevars as $var) {
	if (empty($_GET[$var])) {
		header("Location: index.php?err=1");
		exit();
	}
}
?>
<html>
<head>
<title>Assignment Calculator</title>
</head>
<body bgcolor="#ffffff">
<table cellpadding="10">
<tr>
<td>

<?php
/**********************************************************
File: ac-textonly.php
Modified: Matthew Decker matthew@wayne.edu
Last Modified: 12.19.2005
***********************************************************
Comments:
Modified to allow register_globals to be turned off.
**********************************************************/


include("instructions.php");

print "<h1>The Assignment Calculator</h1></td><td>";

//set up the times

$date1 = "{$_GET["one"]}";
$date2 = "{$_GET["two"]}";

$time1 = strtotime($date1) + 43200;
$time2 = strtotime($date2);


print "<table border=\"0\">";
print "<tr><td><b>Starting on:</b></td><td valign=top>$date1</td></tr>";
print "<tr><td><b>Ending on:</b></td><td valign=top>$date2</td></tr></table>";
$days = days_between($time1, $time2);
print "This means you have " . (int) $days . " days to finish.</td></tr></table>";

//Stuff to say on certain dates

if(days_between($time1, $time2)<0) {

	print "<b>Negative Number of Days:</b> Probably you entered the dates wrong...<br />\n";

} else if(days_between($time1, $time2)<1) {

	print "You have <b>less than one day</b> to get this done.  I hope you're just playing with this thing.<br />\n";

}

if(days_between($time1, $time2)>99) {
	print "It's never too early to start!<br />\n";
}

$ampm = isset($_GET['ampm']) ? htmlentities($_GET['ampm'], ENT_QUOTES) : "";
// Hack to remove notices for undefined var
$bedTime = "";
// out_of_time() no longer returns anything since the dates are added to $instructions
out_of_time($time1, $time2, $instructions, $bedTime, $ampm);
//$dates = out_of_time($time1, $time2, $instructions, $bedTime, $ampm);

$j = 1; //hacked in because someone forgot the zero item in the array...
foreach ($instructions as $step) {
	//title
	print "<h5><img src=\"checkbox.jpg\" width=15 height=15 alt=\"\" border=\"0\"> Step $j:\n";

	//description
	print htmlspecialchars($step['title']) . " by {$step['due']} </h5>\n";

	//what should be done
	print "<ul>\n";
		foreach ($step['items'] as $item) {
			if ((preg_match("/http:[^\']*/", $item, $match))) {
					$url = $match[0];
			}
			print "<li class=\"small\"> " . $item .  "\n";
				if (isset($url)) {
					print " -- $url <br>\n";
				} else {
					print "<br>\n";
				}
			unset($url);
			print "</li>\n";
		}
	print "</ul>\n";
	$j++;
}
?>



</body>
</html>
