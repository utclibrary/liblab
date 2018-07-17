<?php
/**********************************************************
File: date.php
Modified: Matthew Decker matthew@wayne.edu
Last Modified: 12.19.2005
***********************************************************
Comments:
Modified to allow register_globals to be turned off.
**********************************************************/
// Redirect to index if dates are not all specified
$datevars = array('one','two');
foreach ($datevars as $var) {
	if (empty($_GET[$var])) {
		header("Location: index.php?err=1");
		exit();
	}
}
include('variables.php');
include('/var/www/html/includes/head.php');
include("instructions.php");



$today = date("Ymd");
//set up the times
$date1 = "{$_GET['one']}";
$date2 = "{$_GET['two']}";

$time1 = strtotime($date1) + 43200;
$time2 = strtotime($date2);
print "<h1>The Assignment Calculator</h1>";

print "<div class='span6 well clearfix'>";


print "<p>Starting on: $date1</p>";
print "<p>Ending on: $date2</p>";

$days = days_between($time1, $time2);

print "<p><b>According to the dates you have entered, you have " . (int) $days . " days to finish.</b><p>";

// Hack to remove notices for undefined var
$bedTime = "";
$ampm = isset($_GET['ampm']) ? htmlentities($_GET['ampm'], ENT_QUOTES) : "";
/* let's try this a different way...
print "<form action='ac-textonly.php'>\n";
print "<input type='hidden' name='ampm' value='$ampm'>\n";
print "<input type='hidden' name='one' value='{$_GET['one']}'>\n";
print "<input type='hidden' name='two' value='{$_GET['two']}'>\n";
print "<input type='submit' class='btn btn-inverse' value='Printer-friendly Version'>\n";
print "</form>";

print"
<a class='btn' href='ac-textonly.php?ampm=$ampm&one={$_GET['one']}&two={$_GET['two']}'><i class='icon-print'>
                              <!-- icon --></i>Printer-friendly version</a>
";
*/
// out_of_time() no longer returns anything since the dates are added to $instructions
out_of_time($time1, $time2, $instructions, $bedTime, $ampm);
//$dates = out_of_time($time1, $time2, $instructions, $bedTime, $ampm);

print "</div>";
print"<div class='span3 diff-date' style='text-align:right;float:right;'>
<form action='date.php' autocomplete='off'>
<p>Start Date:
<input type='hidden' name='ampm' VALUE='$ampm'>
";

pres_date("one", date("j"), date("n"), date("Y"));

print "</p><p>Due Date:\n";
//grab second date
$two = $_GET['two'];
$explodeTwo =  explode("/", $two);
pres_date("two", "$explodeTwo[1]", "$explodeTwo[0]", "$explodeTwo[2]");

print "</p><input style='margin-bottom:3%' class='btn btn-success' type='submit' value='Modify Date(s)'></form></div>";
//Stuff to say on certain dates
$beforeStuffToSay="
<div class='alert alert-notice clearfix'>
<button class='close' data-dismiss='alert'>×</button><p>
";

if(days_between($time1, $time2)<0) {

	print $beforeStuffToSay."<b>Negative Number of Days:</b> Probably you entered the dates wrong...";

} else if(days_between($time1, $time2)<1) {

	print $beforeStuffToSay."You have <b>less than one day</b> to get this done.  I hope you're just playing with this thing.";
}

if(days_between($time1, $time2)>99) {
	print $beforeStuffToSay."It's never too early to start!";
}

print "</p></div>";
// END stuff to say ...

$j = 1;
foreach ($instructions as $step) {

	print "<div class='span12 clearfix step-step'><div class='span2'><h2>Step $j</h2></div><div class='span8 step-title'>";

	//description
	print "<b>By {$step['due']}:</b> <i>";
	$datum = date("Ymd", strtotime($step['due']));
	print htmlspecialchars($step['title']) . " </i></div></div><div class='span8 offset2'>";

	// Jan 2012 MJB made a real <ul> here instead of
	// entity encoded bullets
	if (count($step['items'])) {
	print "<ul>\n";
		//what should be done
		foreach ($step['items'] as $item) {
			print "<li>" . $item . "</li>";
		}
	}
	print "</ul>";

	print "<br/>";
	print "</div>";
	$j++;
}
print "
<div class='span12'>
Based on the original <a href='http://www.lib.umn.edu/help/calculator/' target='_blank'>Assignment Calculator</a> from the
<a href='http://www.lib.umn.edu' target='_blank'>University of Minnesota Libraries</a>.
<a class='btn pull-right' href='/library/ac'>Restart</a>
</div>
</div>
";

include ('/var/www/html/includes/foot.php');
?>
