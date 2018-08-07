<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<?php
	//  block error reporting for live code
	error_reporting(0);

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	// connect to database
	require_once ('mysqlconnect.php');

	$query = "SELECT Vendor.Vendor_ID, Vendor.VendorName, Dbases.Key_ID, Dbases.Title, Dbases.URL, Dbases.NotProxy, Dbases.CANCELLED, Dbases.MASKED, Vendor.EndNoteWeb, Vendor.EndNoteDesktop, Vendor.EndNoteWebBrowser, Vendor.EndNoteDesktopBrowser
		FROM Dbases INNER JOIN Vendor ON Vendor.Vendor_ID = Dbases.Vendor_ID ORDER BY Vendor.VendorName, Dbases.CANCELLED, Dbases.MASKED, Dbases.Title";

	$result = mysql_query($query);

	if (!$con || empty($result))
	{
		echo "Database search is currently unavailable.";
	}

	$count = 0;
	$browserNote = "<p><i><b>Best with Internet Explorer on Windows or Firefox on Mac.</b></i></p>";
	$vendorID = 0;

	while($row = mysql_fetch_array($result))
	{
		if ($row['CANCELLED'] == 1 || $row['MASKED'] == 1) $db = $row['Title'] . " (UNAVAILABLE)";
		else
		{
			$db = "<a href='";
			if ($row['NotProxy'] == 0) $db .= "http://proxy.lib.utc.edu/login?url=";
			$db .= $row['URL'] . "'>" . $row['Title'] . "</a>";
		}

		if ($vendorID != $row['Vendor_ID'])
		{
			if ($count > 0) $dbTitle[$count] .= "</ul>";
			$count++;
			$vendorID = $row['Vendor_ID'];
			$vendorNum[$count] = $row['Vendor_ID'];
			$vendorName[$count] = $row['VendorName'];

			if (empty($row['EndNoteWeb'])) $endNoteWeb = "No direct import to EndNote Online is available.";
			else $endNoteWeb = $row['EndNoteWeb'];
			if (empty($row['EndNoteDesktop'])) $endNoteDesktop = "No direct import to EndNote Desktop is available.";
			else $endNoteDesktop = $row['EndNoteDesktop'];
			if (empty($row['EndNoteWebBrowser'])) $webBrowser = "";
			else if ($row['EndNoteWebBrowser'] == "Internet Explorer") $webBrowser = $browserNote;
			else $webBrowser = "<p><i><b>Best with " . $row['EndNoteWebBrowser'] . ".</b></i></p>";
			if (empty($row['EndNoteDesktopBrowser'])) $desktopBrowser = "";
			else if ($row['EndNoteDesktopBrowser'] == "Internet Explorer") $desktopBrowser = $browserNote;
			else $desktopBrowser = "<p><i><b>Best with " . $row['EndNoteDesktopBrowser'] . ".</b></i></p>";

			$endNoteOnline[$count] = "$webBrowser<ul><li>$endNoteWeb</li></ul>";
			$endNoteOnline[$count] = preg_replace("/\r\n|\r|\n/",'</li><li>',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace("/<li><\/li>/",'',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace('/(NOTE:[^<]+)/','<b><i>$1</i></b>',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace('/(MAC:)/','<b><i>$1</i></b>',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace('/(WINDOWS:)/','<b><i>$1</i></b>',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace('/(["])([^"]+)(["])/','<i>$2</i>',$endNoteOnline[$count]);
			$endNoteOnline[$count] = preg_replace('/\'|"/','',$endNoteOnline[$count]);

			$endNoteLocal[$count] = "$desktopBrowser<ul><li>$endNoteDesktop</li></ul>";
			$endNoteLocal[$count] = preg_replace("/\r\n|\r|\n/",'</li><li>',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace("/<li><\/li>/",'',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace('/(NOTE:[^<]+)/','<b><i>$1</i></b>',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace('/(MAC:)/','<b><i>$1</i></b>',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace('/(WINDOWS:)/','<b><i>$1</i></b>',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace('/(["])([^"]+)(["])/','<i>$2</i>',$endNoteLocal[$count]);
			$endNoteLocal[$count] = preg_replace('/\'|"/','',$endNoteLocal[$count]);

			$dbTitle[$count] = "<ul><li>" . $db . "</li>";
		}
		else
		{
			$dbTitle[$count] .= "<li>" . $db . "</li>";
		}
	}
	if ($count > 0) $dbTitle[$count] .= "</ul>";
	mysql_close($con);
?>
</head>
<body>
<table border="1" style="width:100%">
<tr>
	<th>ID</th>
	<th>Vendor</th>
	<th>Databases</th>
	<th>EndNote Online Instructions</th>
	<th>EndNote Desktop Instructions</th>
</tr>
<?php for ($i=1; $i<=$count; $i++)
{
	echo "<tr><td valign='top'>$vendorNum[$i]</td>";
	echo "<td valign='top'>$vendorName[$i]</td>";
	echo "<td valign='top'>$dbTitle[$i]</td>";
	echo "<td valign='top'>$endNoteOnline[$i]</td>";
	echo "<td valign='top'>$endNoteLocal[$i]</td></tr>";
}
?>
</table></body></html>