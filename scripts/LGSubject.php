<?php
// enable/disable error reporting
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//get parameters if set and check that all UC + Underscores only
if((isset($_GET["sub"]))&&(preg_match("/^[A-Z,0-9]{2,6}+(?:_[A-Z]{2}+)*$/",$_GET["sub"]))){
	$subject = $_GET["sub"];
}else {
  $subject = "";
}
if((isset($_GET["set"]))&&(ctype_digit($_GET["set"]))){
  $set = $_GET["set"];
} else {
  $set = "";
}
if((isset($_GET["ebks"]))&&($_GET["ebks"]==="yes")){
  $ebks = $_GET["ebks"];
} else {
  $ebks = "";
}
//$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$format = "";
// all ebook databases (ebks=yes)
if ($ebks == 'yes' && empty($subject))
{
	$where = "Dbases.Ebook = 1";
	$error = "complete ebooks list failed";
}
// all databases (no params)
else if (empty($subject))
{
	$where = "NotAtoZ = 0";
	$error = "all databases list failed";
	$format = "dropdown";
}
// all ebooks in subject (ebks=yes and subject)
else if ($ebks == 'yes')
{
	$where = "SubjectList.SubjectCode = '$subject' AND Dbases.EBook = 1";
	$error = "subject ebooks list failed";
}
// all databases in subject, not TryTheseFirst (subject and set=2)
else if ($set == 2)
{
	$where = "SubjectList.SubjectCode = '$subject' AND DBRanking.TryTheseFirst = 0";
	$error = "next databases failed";
}
// all databases in subject, TryTheseFirst is 2 (subject and set=3)
else if ($set == 3)
{
	$where = "SubjectList.SubjectCode = '$subject' AND DBRanking.TryTheseFirst = 2";
	$error = "additional databases failed";
}
// all databases in subject, TryTheseFirst (subject)
else
{
	$where = "SubjectList.SubjectCode = '$subject' AND DBRanking.TryTheseFirst = 1";
	$error = "first databases failed";
}
if (empty($subject))
{
	$query = "SELECT Dbases.Title, Dbases.ShortDescription, Dbases.Key_ID FROM Dbases
		WHERE $where
			AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0
		ORDER BY Dbases.Title";
}
else
{
	$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases
		INNER JOIN DBRanking ON DBRanking.Key_ID = Dbases.Key_ID
		INNER JOIN SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID
		WHERE $where
			AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0
		ORDER BY DBRanking.Ranking";
}
//echo $query;
//specify databases
//$dbname = "LuptonDB";
// connect to database
require_once '/var/www/html/includes/dbconnect.php';
$result = mysqli_query($conLuptonDB , "set names 'utf8'");
$result = mysqli_query($conLuptonDB , $query) or die($error);

if (!mysqli_num_rows($result))
	echo "There are no databases meeting the parameters:<br/>sub=$subject<br/>set=$set<br/>ebks=$ebks<br/>";
else{
		echo "<ul class='s-lg-link-list'>";
	while($row = mysqli_fetch_array($result))
	{
		echo "<li><a href='";
		if (!empty($row['ShortURL'])){
		echo "https://www.utc.edu/" . $row['ShortURL'];
		}
		else{
		echo "https://liblab.utc.edu/scripts/LGForward.php?db=" . $row['Key_ID']  ;
	  }
		echo"' target='_blank'>" . $row['Title'] . "</a>";
		if (!empty($row['ContentType']))
			echo "<div class='s-lg-link-desc'><span class='contentType'>" . $row['ContentType'] . ": </span>";
		echo $row['ShortDescription'];
		if (!empty($row['HighlightedInfo']))
			echo "<span class='highlightedInfo'>  " . $row['HighlightedInfo'] . "</span>";
		if (!empty($row['SimUsers']))
		if ($row['SimUsers'] == 1)
			echo "<span class='highlightedInfo'>  Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
		else if ($row['SimUsers'] > 1)
			echo "<span class='highlightedInfo'>  Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
		echo "</div></li>";
	}
		echo "</ul>";
}
mysqli_close($conLuptonDB);
?>
