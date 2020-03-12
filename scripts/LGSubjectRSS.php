<?php
// enable/disable error reporting
error_reporting(0);
//error_reporting(E_ALL);
// set base url 
$url = "https://192.168.33.10";
// get full current URL for RSS feed link
$link = $url . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
//ini_set('display_errors', '1');
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.inc");
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
echo "ERROR. Please contact libtech@utc.edu. ";
}
else
{
	$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL, Dbases.TutorialURL, Dbases.New, SubjectList.Subject AS Subject FROM DBofDBs.Dbases
		INNER JOIN DBofDBs.DBRanking ON DBRanking.Key_ID = Dbases.Key_ID
		INNER JOIN DBofDBs.SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID
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
	if((isset($_GET["feed"]))&&($_GET["feed"]==="RSS")){
		generateRSS($result, $url, $link);
	  } else {
		generatelist($result, $url);
	  }

}
mysqli_close($conLuptonDB);
function generateRSS($result, $url, $link)
{
  $count = 0;
    //echo "<ul class='s-lg-link-list'>";
    header('Content-type: application/xml');
    echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

    while ($row = mysqli_fetch_array($result)) {
      if ($count < 1){
        echo "<title>" . $row['Subject'] . " Databases</title>\n";
        echo "<description>UTC Library databases recommended for " . $row['Subject'] . "</description>\n";
        echo "<link>" . htmlspecialchars($link,ENT_XML1) . "</link>\n";
      }
        echo "<item>\n";
        echo "<title>" . htmlspecialchars($row['Title'],ENT_XML1) . "</title>\n";
        echo "<link>";
        if (!empty($row['ShortURL'])) {
            echo "https://www.utc.edu/" . $row['ShortURL'];
        } else {
            echo $url . "/scripts/LGForward.php?db=" . $row['Key_ID']  ;
        }
        echo"</link>\n<description><![CDATA[";
		if ($row['New'] === '1') {
            echo "<span class='badge badge-warning float-right'> NEW </span>";
        }
        if ($row['Trial'] === '1') {
            echo "<span class='badge badge-info float-right'> TRIAL </span>";
        }
        if (!empty($row['ContentType'])) {
            echo "<span class='contentType'>" . $row['ContentType'] . "</span>";
        }
        echo "<p>" . $row['ShortDescription'] . "</p>";
        if (!empty($row['HighlightedInfo'])) {
            echo "<span class='highlightedInfo'>" . $row['HighlightedInfo'] . "</span>";
        }
        if (!empty($row['SimUsers'])) {
			echo "<span class='simUsers'>" . $row['SimUsers'] . " user";
			if ($row['SimUsers']>1){
				echo "s";
			}
			echo "</span>";
        }
        /* START add TutorialURL link */
        if (!empty($row['TutorialURL'])) {
           echo "<span class='tutorialLink'><a href='" . $row['TutorialURL'] . "'>" . $row['Title']. " Tip Sheet</a></span>";
        }
       echo "]]></description>\n";
       /* END add TutorialURL link */
        echo "</item>\n";
        $count = $count + 1;
    }
    //echo "</ul>";
    echo "</channel>\n";
    echo "</rss>\n";

}
?>
