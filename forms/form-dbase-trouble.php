<?php
//turn error reporting off default N
$errorReporting = "N";
//template system to replicate main website look and feel
$title = "UTC Database Login Problem";
$description = "Report Form for Database Login Screen Problems";
$keywords = "";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="YES";
//in case you need to add anything in the head or footer
$addhead = "";
$addfoot = "";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu=0;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
include ('../includes/head.php');
?>
<!-- Insert content here BEGIN -->
<?php
date_default_timezone_set('America/New_York');
$todaystamp = time();
$today = date('l, n/j/y, g:ia',$todaystamp);
if (isset($_POST["db"])) {
		$headers = "FROM: libtech@utc.edu";
		$recipients = "libtech@utc.edu, Katie-Gohn@utc.edu, Charlie-Remy@utc.edu";
		$subject = "Database Login Page Problem Report";
		require_once ('./mysqlconnect_db.php');
		$dbKey = $_POST['db'];
		$result = mysqli_query($link, "SELECT Vendor.VendorName, Dbases.Title FROM Vendor INNER JOIN Dbases ON Vendor.Vendor_ID=Dbases.Vendor_ID WHERE Dbases.Key_ID = '$dbKey'");
		while($row = mysqli_fetch_array($result))
		{
			$dbName = $row['Title'];
			$dbVendor = $row['VendorName'];
		}
		mysqli_free_result($result);
		mysqli_close($link);
		$body = "Date: " . $today . "\n\n" .
			"Reported By: " . $_POST['user'] . "\n\n" .
			"Database Name: $dbName \n\n" .
			"Database Vendor: $dbVendor \n\n" .
			"Public IP: " . $_POST['ip'] . "\n\n" .
			"Private IP: " . $_SERVER['REMOTE_ADDR'] ."\n\n".
			"Computer Name: " . gethostbyaddr($_SERVER['REMOTE_ADDR']) ."\n\n".
			"Computer Info : " . $_SERVER['HTTP_USER_AGENT'];
		mail($recipients,$subject,$body,$headers);
		echo "<h1>Thank you for submitting this problem report!</h1><p>Return to the <a href='http://www.utc.edu/library/'>Library Home</a> page.</p>";
}
if (!isset($_POST['db']))
{ ?>
<div class="form">
	<h1>UTC Database Login Problem Submission</h1>
	<h3><font color='red'>Please use this form only if you:</font></h3>
	<ul><font color='red'><li>have been routed to the database login page instead of the database search screen, AND</li>
	<li>are using the (wired or wireless) on-campus computer where you encountered the problem, AND</li>
	<li>experienced the problem on this computer within the last 5 minutes.</li></font></ul>
	<?php if ($_GET['staff'] == 'yes') { ?>
	<p><font color='red'>This form is for staff use only. The form for public use is available at <a href='http://www.utc.edu/kitten/'>utc.edu/kitten</a>.</font></p>
	<?php } ?>
	</br></br>
	<form action="./form-dbase-trouble.php" method="post" />
		<div class="form-group">
			<label for='db'>Please Select the UTC Library Database That You Are Attempting to Access and Click Submit</label>
			<select required name='db' class='form-control'>
			<option value ='' >Select Database</option>
				<?php require_once ('./mysqlconnect_db.php');
				$result = mysqli_query($link, "SELECT Key_ID, Title from Dbases WHERE NotProxy=0 AND CANCELLED=0 AND MASKED=0 ORDER BY Title");
				while($row = mysqli_fetch_array($result))
				{
					echo "<option value ='" . $row['Key_ID'] . "'>" . $row['Title'] . "</option>";
				}
				mysqli_free_result($result);
				mysqli_close($link); ?>
			</select>
		</div>
		<?php if ($_GET['staff'] == 'yes') { ?>
			<div class="form-group">
				<label for="user">Submitted By</label>
				<select required name='user' class='form-control'>
					<option value ='' >Select Choice</option>
						<?php require_once ('./mysqlconnect.php');
						$result = mysqli_query($con, "SELECT idUser, fName, lName FROM User ORDER BY fName, lName");
						while($row = mysqli_fetch_array($result))
						{
							if (isset ($_POST['user']) && $row['fName'] . " " . $row['lName'] == $_POST['user'])
								echo "<option selected = 'selected' value ='" . $row['fName'] . " " . $row['lName'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
							else echo "<option value ='" . $row['fName'] . " " . $row['lName'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
						}
						mysqli_free_result($result);
						mysqli_close($con); ?>
				</select>
			</div>
		<?php } else { ?>
			<input type = 'hidden' name = 'user' value = 'Student'>
		<?php } ?>
		<input type = 'hidden' name = 'ip' value = ' <?php echo $_GET['ip']; ?> '>
		<button class="btn btn-default" type="submit">Submit</button>
	</form>
</div>
<?php } ?>
<!-- Insert content here END -->
<?php include ('../includes/foot.php'); ?>
<!-- add any additional footer code here -->
</html>
