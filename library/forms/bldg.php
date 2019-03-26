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
$addhead = "<style>
.hide-robot{
	display:none !important;
}
#report-bldg-form label{
	font-size:1.5em;
}
#report-bldg-form input, #report-bldg-form textarea, #report-bldg-form select{
	font-size:1.5em;
	min-height:2em;
	width:100%;
}
#report-bldg-form select {
    width: 100%;
    font-size: 25px;
    height: 45px;
}
</style>";
$addfoot = "";
//show or hide help button
$help = "show";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu=0;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");
?>
<!-- Insert content here BEGIN -->
<?php
$set_email = "libbuilding@utc.edu";
date_default_timezone_set('America/New_York');
$todaystamp = time();
$today = date('l, n/j/y, g:ia',$todaystamp);

$error = null;
// connect to database
require_once '/var/www/html/includes/dbconnect.php';
// check form submission
if(is_array($_POST) && $_POST)
{
	//check if the honeypot field is filled out. If not, send email.
	if(isset($_POST['preferred-method']) && $_POST['preferred-method'] != "")
{
	echo "preferred-method set";
		$error = "There was an error. Please contact libtech@utc.edu.";
	}else{
			$email = $set_email;
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

			$recipients = $set_email;
			mail($recipients, "UTC Library Building Walkthrough: ".$ok,$body,$headers);
			echo "<h1>The form has been submitted.</h1>
			<p><a class='btn btn-block btn-primary btn-large' href='".$_SERVER['PHP_SELF']."'>Submit Another Library Walkthrough Report</a></p>
			<p><a class='btn btn-block btn-large btn-default' href='https://blog.utc.edu/library-alerts/'>Return to Library Alerts</a></p>";
		}
	}
	if ((isset($error) && isset($_POST["user"])) || !isset($_POST["user"]))
	{
?>
	<h1>UTC Library Walkthrough</h1>
	<p>Please indicate any issues in the text field. If there are no issues, just choose your name from the list and click submit.</p>
		<div class="form offset2 span8">
			<form method="post" action="#report-bldg-form" id="report-bldg-form">
		<div class="form-group">
			<label for="user">Walkthrough Completed By</label>
			<select required name='user' id='user' class='form-control'>
			<option value ='' >Select Choice</option>
				<?php

				$resultLogin = mysqli_query($conLogin, "SELECT idUser, fName, lName FROM User ORDER BY fName, lName");
				while($row = mysqli_fetch_array($resultLogin))
				{
					if (isset ($_POST['user']) && $row['idUser'] == $_POST['user'])
						echo "<option selected = 'selected' value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
					else echo "<option value ='" . $row['fName'] . " " . $row['lName'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
				}
				mysqli_free_result($resultLogin);
				mysqli_close($conLoginLogin); ?>
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
		</div>
		<?php // Create fields for the honeypot ?>
			<label aria-hidden="true" for="preferred-method" class="hide-robot">Preferred Method</label>
		<input aria-hidden="true" name="preferred-method" type="text" id="preferred-method" class="hide-robot">
		<?php // honeypot fields end ?>
		<button class="btn btn-primary btn-large btn-block" type="submit">Submit</button>
	</form>
</div>
<?php } ?>
<!-- Insert content here END -->
<?php include ($_SERVER['DOCUMENT_ROOT']."/includes/foot.php"); ?>
<!-- add any additional footer code here -->
</html>
