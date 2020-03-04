<?php


// enable/disable error reporting
//error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//include($_SERVER['DOCUMENT_ROOT']."/includes/functions.inc");
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
//$fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$fulurl = $_SERVER['PHP_SELF'];
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
	$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL, Dbases.TutorialURL FROM Dbases
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
   generateRSS($result, 'https://liblab.utc.edu');
}
mysqli_close($conLuptonDB);

function generateRSS($result, $fullurl)
{
    //echo "<ul class='s-lg-link-list'>";
    header('Content-type: application/xml');
    echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo "<title>Demo RSS Feed</title>\n";
echo "<description>RSS Description</description>\n";
echo "<link>dummylink.com</link>\n";
    while ($row = mysqli_fetch_array($result)) {
        echo "<item>\n";
        echo "<title>" . html_entity_decode($row['Title']) . "</title>\n";
        echo "<link>";
        if (!empty($row['ShortURL'])) {
            echo "https://www.utc.edu/" . $row['ShortURL'];
        } else {
            echo "https://liblab.utc.edu/scripts/LGForward.php?db=" . $row['Key_ID']  ;
        }
        echo"</link>\n";
        echo "<tags>";
        if ((!empty($row['New']))&&($row['New'] === 1)) {
           echo "NEW";
        }
        if ((!empty($row['Trial']))&&($row['Trial'] === 1)) {
          echo "TRIAL";
        }
        echo "</tags>\n<type>";
        if (!empty($row['ContentType'])) {
            echo $row['ContentType'];
        }
        echo "</type>\n<description><![CDATA[" . $row['ShortDescription'] . "]]></description>\n<highlighted>";
        if (!empty($row['HighlightedInfo'])) {
            echo $row['HighlightedInfo'] ;
        }
        echo "</highlighted>\n<simusers>";
        if (!empty($row['SimUsers'])) {
                echo $row['SimUsers'] ;
        }
        echo "</simusers>\n";
        /* START add TutorialURL link */
        echo "<tutorial>";
        if (!empty($row['TutorialURL'])) {
           echo $row['TutorialURL'];
        }
       echo "</tutorial>\n";
       /* END add TutorialURL link */
        echo "</item>\n";
    }
    //echo "</ul>";
    echo "</channel>\n";
    echo "</rss>\n";
}
?>