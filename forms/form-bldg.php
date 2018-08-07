<?php
//turn error reporting off default N
$errorReporting = "N";
//template system to replicate main website look and feel
$title = "UTC Library Building Walkthrough";
$description = "Report Form UTC Library Building Walkthroughs";
$keywords = "";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="YES";
//in case you need to add anything in the head or footer
$addhead = "<script src='https://www.google.com/recaptcha/api.js'></script>";
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
$sitekey = "6Ld-aEkUAAAAAG1IpxJy3Cr3ijvAV2ChnAMbxOGk";
$secretkey = "6Ld-aEkUAAAAAHqfGq6H8S7vU3Up0Dd_aJpaXqlB";
# the error code from reCAPTCHA, if any
$error = null;
# are we submitting the page?
if (isset($_POST["user"]))
{
	if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		$responseKey = $_POST['g-recaptcha-response'];
		$userIP = $_SERVER['REMOTE_ADDR'];
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretkey . '&response=' . $responseKey . '&remoteip=' . $userIP);
		# json_decode function not available in 5.1.6 - update code when PHP has been updated on server
		if (strpos($verifyResponse, '"success": true') !== false)
		{
			$email = "libbuilding@utc.edu";
			$headers = "FROM:".$email;
			$noIssues = "No new issues to report.\n\n";
			$ok = 'ok';
			$body = "UTC Library Building Walk Through\n\n".
				"Date: " . $today . "\n\n" .
				"Submitted by: ".$_POST['user']."\n\n".
				"Building Maintenance Issues?\n";
			if (empty($_POST['building'])) $body .= $noIssues;
			else {
				$body .= $_POST['building']."\n\n";
				$ok = "Not ok"; }
			$body .= "Cleaning Issues?\n";
			if (empty($_POST['cleaning'])) $body .= $noIssues;
			else {
				$body .= $_POST['cleaning']."\n\n";
				$ok = "Not ok"; }
			$body .= "Security Issues?\n";
			if (empty($_POST['security'])) $body .= $noIssues;
			else {
				$body .= $_POST['security']."\n\n";
				$ok = "Not ok"; }
			$body .= "IT Issues?\n";
			if (empty($_POST['it'])) $body .= $noIssues;
			else {
				$body .= $_POST['it']."\n\n";
				$ok = "Not ok"; }
			$body .= "Other Issues?\n";
			if (empty($_POST['other'])) $body .= $noIssues;
			else {
				$body .= $_POST['other']."\n";
				$ok = "Not ok"; }

			$recipients = "libbuilding@utc.edu";
			mail($recipients, "UTC Library Building Walkthrough: ".$ok,$body,$headers);
			echo "<h1>The form has been submitted.</h1><p>Return to the <a href='https://www5.utc.edu/forms/form-bldg.php'>Library Walkthrough</a> page ";
			echo "or the <a href='https://www.utc.edu/library/'>Library Home</a> page ";
			echo "or the <a href='https://blog.utc.edu/library-alerts/'>Library Alerts</a> page.</p>";
		}
		else {
			# set the error code so that we can display it. You could also use
			# die ("reCAPTCHA failed"), but using the error message is
			# more user friendly
			$error = 'Google thinks you are a robot.  Please try again.';
		}
	}
	else $error = 'Please click on the reCAPTCHA box.';
}
if ((isset($error) && isset($_POST["user"])) || !isset($_POST["user"]))
{
?>
<div class="form">
	<h1>UTC Library Walkthrough</h1>
	<p>Please indicate any issues in the text field. If there are no issues, just choose your name from the list and click submit.</p>
	<?php if (isset($error)) { echo "<p><strong>$error</strong></p><br/>"; } ?>
	<form action="" method="post" onSubmit="return checkWholeForm(this);" />
		<div class="form-group">
			<legend>Walkthrough Completed By</legend>
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
		<div class="form-group">
			<legend>Issues Noted</legend>
			<label for="building">Building Maintenance Issues (Plumbing, Heat/Air, Elevators, Door operation)</label>
			<textarea rows="4" name="building"><?php if (isset ($_POST['building'])) { echo $_POST['building']; } ?></textarea>
			<label for="cleaning">Cleaning Issues (Spills, Restroom Supplies, Areas Needing Attention)</label>
			<textarea rows="4" name="cleaning"><?php if (isset ($_POST['cleaning'])) { echo $_POST['cleaning']; } ?></textarea>
			<label for="security">Security Issues  (Doors open, Patrons found inside building, Swipes not working)</label>
			<textarea rows="4" name="security"><?php if (isset ($_POST['security'])) { echo $_POST['security']; } ?></textarea>
			<label for="it">IT Issues (Computers, LCDs, Printers)</label>
			<textarea rows="4" name="it"><?php if (isset ($_POST['it'])) { echo $_POST['it']; } ?></textarea>
			<label for="other">Other Issues (Anything else out of the ordinary / worth reporting)</label>
			<textarea rows="4" name="other"><?php if (isset ($_POST['other'])) { echo $_POST['other']; } ?></textarea>
		</div>
		<div>
			<?php
				if (isset($error)){
					echo"
						<div id='message-bottom' class='alert alert-warning fade in'>
						<a class='close pull-right' href='#' data-dismiss='alert'>×</a>
							<p>".$error."</p>
						</div>";
			}
			?>
			<div class='g-recaptcha' data-sitekey='<?php echo $sitekey; ?>'></div>
		</div>
		<button class="btn btn-default" type="submit">Submit</button>
	</form>
</div>
<?php } ?>
<!-- Insert content here END -->
<?php include ('../includes/foot.php'); ?>
<!-- add any additional footer code here -->
</html>