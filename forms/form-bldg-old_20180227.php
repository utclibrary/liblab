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
require_once('./recaptchalib.php');
$publickey = "6LcaZwAAAAAAAAxzZYmCWidnkWPFZUQjjT441JGa";
$privatekey = "6LcaZwAAAAAAALjAQIDapshaYaBAkZOQ2NTf8YjL'";
# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
# are we submitting the page?
if (isset($_POST["submit"])) {
	$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
	if ($resp->is_valid) {
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
		echo "<h1>The form has been submitted.</h1><p>Return to the <a href='http://lab.lib.utc.edu/forms/form-bldg.php'>Library Walkthrough</a> page ";
		echo "or the <a href='http://www.utc.edu/library/'>Library Home</a> page ";
		echo "or the <a href='http://blog.utc.edu/library-alerts/'>Library Alerts</a> page.</p>";
	}
	else {
		# set the error code so that we can display it. You could also use
		# die ("reCAPTCHA failed"), but using the error message is
		# more user friendly
		$error = $resp->error;
	}
}
if ($resp->error || !isset($_POST["user"]))
{
?>
<div class="form">
	<h1>UTC Library Walkthrough</h1>
	<p>Please indicate any issues in the text field. If there are no issues, just choose your name from the list and click submit.</p>
	<?php if (isset($error)) { echo "<p><strong>Stop Spam, Read Books: your entry did not match the image.</strong></p><br/>"; } ?>
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
			<legend>Stop Spam, Read Books</legend>
			<p>Please enter the words you see in the box below, in order and separated by a space. Doing so helps prevent automated programs from abusing this service.</p>
			<?php echo recaptcha_get_html($publickey, $error); ?>
		</div>
		<input type="hidden" name="submit" value="true"/>
		<button class="btn btn-default" type="submit">Submit</button>
	</form>
</div>
<?php } ?>
<!-- Insert content here END -->
<?php include ('../includes/foot.php'); ?>
<!-- add any additional footer code here -->
</html>