<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<html>
<head>
<?php
//script to redirect db urls
// enable/disable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
//get url 'db' param if set and make sure it is a number
if((isset($_GET["db"]))&&(is_numeric($_GET["db"]))) {
    $database = $_GET["db"];
} else {
    $database = "";
}
//not sure what is going on here, but seems to have to do with code from home page search box
if (empty($database))
{
	for ($i=0; $i<100; $i++)
	{
		if ($_GET["db" . $i] != 0)
		{
			$database = $_GET["db" . $i];
			break;
		}
	}
}

//get pg referer if there is one
    if (isset($_SERVER['HTTP_REFERER'])) {
    $refURL = $_SERVER['HTTP_REFERER']; //get referrer
    }else{
    $refURL = 'No referrer set'; // show failure message
    }//end else no referer set
//truncate if necessary to fit db field
if (strlen($refURL) > 255)
{
	$refURL = substr($refURL, 0, 255);
}
if ($database == 0 || empty($database) || is_nan($database))
{
	$url = "/library/databases/";
}

else
{
  //specify databases
  //$dbname = "LuptonDB";
  // connect to database
  require_once '/var/www/html/includes/dbconnect.php';

	$result = mysqli_query($conLuptonDB, "SELECT Dbases.NotProxy, Dbases.URL FROM Dbases
		WHERE Dbases.Key_ID = $database") or die("Database Query Failed");

	while($row = mysqli_fetch_array($result))
	{
		$url = "";
		if (empty($row['NotProxy']))
			$url = "https://proxy.lib.utc.edu/login?url=";
		$url = $url . $row['URL'];
	}

	if(empty($url)) $url = "https://guides.lib.utc.edu/";

	if ($url != 'https://guides.lib.utc.edu/')
	{
		mysqli_query($conLuptonDB , "LOCK TABLES DBUsage WRITE");
		mysqli_query($conLuptonDB , "INSERT INTO DBUsage (Key_ID, RefURL) VALUES ($database, '$refURL')");
		mysqli_query($conLuptonDB , "UNLOCK TABLES");
	}
	mysqli_close($conLuptonDB);
}
//redirect to url built previously
header('Location:' . $url);
//echo "<p>Target: ".$url."</p>";
//echo "<p>Ref URL: ".$refURL."</p>";
?>
</head><body></body>
</html>
