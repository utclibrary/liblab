<?php
// set form email
$defaultEmail = "steven.d.shelton@gmail.com";
//turn error reporting off default N
$errorReporting = "N";
//template system to replicate main website look and feel
$title = "UTC Library Report IT";
$description = "Report Form for IT Problems of All Kinds";
$keywords = "";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu = "YES";
//in case you need to add anything in the head or footer
$addhead = "
<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' rel='stylesheet' />
<style>
.top-pad, #content h1{
	margin-top: .5em;
}
.hide-robot{
	display:none !important;
}
#report-it-form label{
	font-size:1.5em;
}
#report-it-form input, #report-it-form textarea{
	font-size:1.5em;
	min-height:2em;
	width:100%;
}
#report-it-form select{
	width: 100%;
	font-size: 25px;
	height: 45px;
}
[class*='select2']{
	min-height:30px;
 font-size:25px;
 line-height:30px;
}
[class*='select2-selection']{
	padding-top:2px;
	min-height:40px;
}
.select2{
	margin: 10px 0;
}
#report-it-form input, #report-it-form textarea{
    padding-left: .25em;
}
</style>";
$addfoot = "
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js'></script>
";
//show or hide help button
$help = "show";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu = 0;
/* switch leftmenu on or off Y or N*/
$navmenu = "N";
include($_SERVER['DOCUMENT_ROOT'] . "/includes/head.php");
//<!-- Insert content here BEGIN -->
//check to see if ip is set
$clientIP = "";
$clientName = "";
if (isset($_POST['ip'])) {
	$clientIP = $_POST['ip'];
	$clientName = gethostbyaddr($clientIP);
}
date_default_timezone_set('America/New_York');
$todaystamp = time();
$today = date('l, n/j/y, g:ia', $todaystamp);
$categories = array("Alma/Primo", "Analytics & Stats", "Building", "eResources", "Hardware", "Software", "Web", "Other");
$neededBy = array("ASAP", "This Week", "This Month", "This Semester", "TBD");
// set error code variable
$error = null;
// connect to database
require_once '/var/www/html/includes/dbconnect.php';
// check form submission
if (is_array($_POST) && $_POST) {
	//check if the honeypot field is filled out. If not, send a mail.
	if (isset($_POST['preferred-method']) && $_POST['preferred-method'] != "") {
		$error = "There was an error. Please contact libtech@utc.edu.";
	} else {
		// send email
		require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/phpmailer/PHPMailerAutoload.php');
		$mail = new PHPMailer;
		$user = $_POST['user'];
		$resultLogin = mysqli_query($conLogin, "SELECT fName, lName, email FROM User WHERE idUser = '$user'");
		while ($row = mysqli_fetch_array($resultLogin)) {
			$userEmail = $row['email'];
			$userName = $row['fName'] . " " . $row['lName'];
			$userGroup = $row['reportingGroup'];
		}
		mysqli_free_result($resultLogin);
		mysqli_close($conLogin);
		$mail->setFrom($userEmail, $userName);
		// set default as reply to
		$mail->AddReplyTo($defaultEmail, 'LibIT Help Desk');
		$mail->addAddress($defaultEmail);
		$mail->Subject  = "Report IT (" . $_POST['category'] . "): " . $_POST['problem'];
		$body = "Date: " . $today . "\n\n" .
			"Submitted by: " . $userName . "\n\n";
		// if (isset($_POST['includeDept'])) {
		// 	$body .= "Include Dept: " . $_POST['includeDept'] . "\n\n";
		// } else {
		// 	$body .= "Include Dept: No \n\n";
		// }
		$body .= "Category: " . $_POST['category'] . "\n\n" .
			"Needed by: " . $_POST['needed_by'] . "\n\n" .
			"Problem Summary: " . $_POST['problem'] . "\n\n";
		if (isset($_POST['description']))
			$body .= "Description: " . $_POST['description'] . "\n\n";
		$body .= "Computer IP: " . $clientIP . "\n\n" .
			"Computer Name: " . $clientName . "\n\n" .
			"Computer Info : " . $_SERVER['HTTP_USER_AGENT'];
		$mail->Body     = $body;
		$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
		if (!$mail->send()) {
			echo 'Message was not sent.';
			echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
			echo "<h1>The form has been submitted.</h1>
			<p style='height: 50vh;'>".nl2br($body)."</p>
			<p><a class='btn btn-primary btn-large btn-block' href='" . $_SERVER['PHP_SELF'] . "'>Submit another Library Report IT</a></p>
			<p><a class='btn btn-large btn-block' href='https://blog.utc.edu/library-alerts/'>Return to Library Alerts</a></p>";
		}		
	}
}
if ((isset($error) && isset($_POST["user"])) || !isset($_POST["user"])) {
?>
	<h1>UTC Library IT</h1>
	<p>Is your computer acting screwy? Is a customer reporting linking problems in Academic OneFILE? Use this form to submit a problem report. Once you click submit, the appropriate UTC Library IT team member will be notified. Remember, the more detail you provide, the easier it is to resolve the problem.</p>
	<p>
		<a class="btn btn-info btn-large" href="https://libit.utc.edu/servicedesk/customer/portal/1" target="_blank">Or use the Web portal</a>
		<span class="fa fa-lock"> (Login required + campus only)</span>
	</p>
	<div class="form offset2 span8">
		<form method="post" role='form' action='<?php $_SERVER['PHP_SELF']; ?>' id="report-it-form" enctype='multipart/form-data'>
			<div class="form-group">
				<label for="problem">Problem Summary</label>
				<input required type="text" class="form-control" id="problem" name="problem" value="<?php if (isset($_POST['problem'])) {
					echo $_POST['problem'];
					} ?>">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea rows="8" name="description" id="description">
					<?php
					if (isset($_POST['description'])) {
						echo $_POST['description'];
						} ?>
				</textarea>
			</div>
			<div class="form-group">
				<label for="attachedFile">Attach File</label>
				<input type="file" name='attachment' id='uploaded_file'>
			</div>
			<?php
			buildSelectList ("category", $categories); 
			buildSelectList ("needed_by", $neededBy);
			?>
			<div class="form-group">
				<label for="user">Submitted By</label>
				<select required name='user' id='user' class='select2'>
					<option value=''>Select Choice</option>
					<?php
					$resultLogin = mysqli_query($conLogin, "SELECT idUser, fName, lName FROM User ORDER BY lName, fName");
					while ($row = mysqli_fetch_array($resultLogin)) {
						if (isset($_POST['user']) && $row['idUser'] == $_POST['user'])
							echo "<option selected = 'selected' value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
						else echo "<option value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
					}
					mysqli_free_result($resultLogin);
					mysqli_close($conLoginLogin); ?>
				</select>
			</div>
			<!--
			<div class="form-group">
				<input type="checkbox" id="includeDept" name="includeDept" value="Yes">
				<label for="includeDept">Include my Department</label>
			</div>
				-->
			<div>
				<?php
				if (isset($error)) {
					echo "
						<div id='message-bottom' class='alert alert-warning fade in'>
						<a class='close pull-right' href='#' data-dismiss='alert'>×</a>
							<p>" . $error . "</p>
						</div>";
				}
				?>
			</div>
			<label aria-hidden="true" for="ip" class="hide-robot">ip</label>
			<input name="ip" type="text" class="hide-robot" id="userIP" />
			<?php //Create fields for the honeypot 
			?>
			<label aria-hidden="true" for="preferred-method" class="hide-robot">Preferred Method</label>
			<input aria-hidden="true" name="preferred-method" type="text" id="preferred-method" class="hide-robot">
			<?php //honeypot fields end 
			?>
			<p class='top-pad'>
				<button class="btn btn-primary btn-large btn-block" type="submit">Submit</button>
			</p>
			<p class='top-pad'>
				<button class='btn btn-secondary' type="reset" value="Start Over" onclick="location.reload();"><span class='fa fa-redo'> Start Over</span></button>
			</p>
		</form>
	</div>
<?php } ?>
<!-- Insert content here END -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/foot.php"); ?>
<!-- add any additional footer code here -->
<script>
	$(document).ready(function ubsrt() {
		window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
		var pc = new RTCPeerConnection({
				iceServers: []
			}),
			noop = function() {};
		pc.createDataChannel("");
		pc.createOffer(pc.setLocalDescription.bind(pc), noop);
		pc.onicecandidate = function(ice) {
			if (!ice || !ice.candidate || !ice.candidate.candidate) return;
			var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];
			$('#userIP').val(myIP);
			pc.onicecandidate = noop;
		};
		$('.select2').select2({
			theme: "classic"
		});
	});
</script>
</html>
<?php
// function to build select list
function buildSelectList ($selectName, $selectArray){
	echo "<div class='form-group'>
		<label for=".$selectName.">".ucfirst(str_replace("_"," ",$selectName))."</label>
			<select required name='".$selectName."' id='".$selectName."' class='form-control'>
				<option value=''>Select Choice</option>";
					for ($i = 0; $i < count($selectArray); $i++){
						if (isset($_POST['".$selectName."']) && $selectArray[$i] == $_POST['".$selectName."']){
							echo "<option selected = 'selected' value = '" . $selectArray[$i] . "'>" . $selectArray[$i] . "</option>";
						}else{
							echo "<option value = '" . $selectArray[$i] . "'>" . $selectArray[$i] . "</option>";
						}
					}
				echo "</select>
			</div>";
}