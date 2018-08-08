<?php

// enable/disable error reporting
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

	$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	// connect to database
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';

	$query = "SELECT Dbases.Key_ID, Dbases.Title, Vendor.EndNoteWeb, Vendor.EndNoteDesktop, Vendor.EndNoteWebBrowser, Vendor.EndNoteDesktopBrowser
		FROM Dbases INNER JOIN Vendor ON Vendor.Vendor_ID = Dbases.Vendor_ID
		WHERE Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY Dbases.Title";

	$result = mysqli_query($conLuptonDB , $query);

	if (!$conLuptonDB || empty($result))
	{
		echo "Database search is currently unavailable.";
	}

	$count = 1;
	$browserNote = "<p><i><b>Best with Internet Explorer on Windows or Firefox on Mac.</b></i></p>";

	while($row = mysqli_fetch_array($result))
	{
		$dbTitle[$count] = $row['Title'];
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
		$endNoteInstr[$count] = "<h4>EndNote Online:</h4>$webBrowser<ul><li>$endNoteWeb</li></ul><br/><h4>EndNote:</h4>$desktopBrowser<ul><li>$endNoteDesktop</li></ul>";
		$endNoteInstr[$count] = preg_replace("/\r\n|\r|\n/",'</li><li>',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace("/<li><\/li>/",'',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace('/(NOTE:[^<]+)/','<b><i>$1</i></b>',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace('/(MAC:)/','<b><i>$1</i></b>',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace('/(WINDOWS:)/','<b><i>$1</i></b>',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace('/(["])([^"]+)(["])/','<i>$2</i>',$endNoteInstr[$count]);
		$endNoteInstr[$count] = preg_replace('/\'|"/','',$endNoteInstr[$count]);
		$count++;
	}
?>

<div id="libsearch" class="well well-raised">
	<legend>Exporting from Databases to EndNote
		<p class="pull-right"><a href="https://proxy.lib.utc.edu/login?url=http://www.myendnoteweb.com" target="_blank" class="btn btn-danger">EndNote Online</a></p>
	</legend>
	<script type="text/javascript">

		function changetext(elemid)
		{
			var ind = document.getElementById(elemid).selectedIndex;
			var instruction = new Array();
			instruction[0] = "";

			<?php for ($i=1; $i<$count; $i++){?>
				instruction[<?php echo $i; ?>] = "<?php echo $endNoteInstr[$i]; ?>";
			<?php } ?>

			document.getElementById('instructions').innerHTML = instruction[ind];
		}
	</script>
	<form>
		<select class='input-xxlarge' id="database" onChange="changetext('database');">
			<option value="0">Select a database to see EndNote instructions...</option>
			<?php for ($i=1; $i<$count; $i++)
				echo "<option value='$i'>$dbTitle[$i]</option>";
mysqli_close($conLuptonDB);
			?>
		</select><br>
	</form>
	<div id="instructions"></div>
</div>
