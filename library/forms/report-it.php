<?php
//turn error reporting off default N
$errorReporting = "N";
//template system to replicate main website look and feel
$title = "UTC Library Report IT";
$description = "Report Form for IT Problems of All Kinds";
$keywords = "";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="YES";
//in case you need to add anything in the head or footer
$addhead = "
<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' rel='stylesheet' />
<style>
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
$rightmenu=0;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");

//<!-- Insert content here BEGIN -->
//check to see if ip is set
$clientIP = "";
$clientName = "";
if( isset($_POST['ip']) )
{
     $clientIP = $_POST['ip'];
     $clientName = gethostbyaddr($clientIP);
}
date_default_timezone_set('America/New_York');
$todaystamp = time();
$today = date('l, n/j/y, g:ia',$todaystamp);
$categories = array
	(
		0 => array(
			'category' => 'Alma/Primo',
			'email' => 'libtech@utc.edu, Charlie-Remy@utc.edu, Katie-Gohn@utc.edu'
		),
		1 => array(
			'category' => 'Building',
			'email' => 'libadmin@utc.edu'
		),
		2 => array(
			'category' => 'Classroom Tech',
					'email' => 'libtech@utc.edu, libinstruction@utc.edu'
		),
		3 => array(
			'category' => 'E-Resources',
			'email' => 'libtech@utc.edu, Charlie-Remy@utc.edu, Katie-Gohn@utc.edu'
		),
		4 => array(
			'category' => 'Library IT',
			'email' => 'libtech@utc.edu'
		),
		5 => array(
			'category' => 'Website',
			'email' => 'libtech@utc.edu'
		)
	);
$neededBy = array("Now", "1 to 2 Days", "This Week", "Next Week", "This Month", "This Semester");
// set error code variable
$error = null;
// connect to database
	require_once '/var/www/html/includes/dbconnect.php';
// check form submission
if(is_array($_POST) && $_POST)
{
	//check if the honeypot field is filled out. If not, send a mail.
	if(isset($_POST['preferred-method']) && $_POST['preferred-method'] != "")
{
		$error = "There was an error. Please contact libtech@utc.edu.";
	}else{
			$user = $_POST['user'];
			$resultLogin = mysqli_query($conLogin, "SELECT fName, lName, email FROM User WHERE idUser = '$user'");
				while($row = mysqli_fetch_array($resultLogin))
				{
					$userEmail = $row['email'];
					$userName = $row['fName'] . " " . $row['lName'];
				}
			mysqli_free_result($resultLogin);
			mysqli_close($conLogin);
			for ($i=0; $i<count($categories); $i++)
			{
				if ($categories[$i]['category'] == $_POST['category'])
					$categoryEmail = $categories[$i]['email'];
			}
			$headers = "FROM:". $userEmail;
			$recipients = $categoryEmail . ", " . $userEmail;
			$subject = "Report IT (" . $_POST['category'] . "): " . $_POST['problem'];
			$body = "Date: " . $today . "\n\n" .
				"Submitted by: ". $userName ."\n\n" .
				"Category: " . $_POST['category'] . "\n\n" .
				"Needed by: " . $_POST['neededBy'] . "\n\n" .
				"Problem Summary: " . $_POST['problem'] . "\n\n";
			if (isset($_POST['description']))
				$body .= "Description: " . $_POST['description']."\n\n";
				//$body .= "Computer IP: " . $_SERVER['REMOTE_ADDR'] ."\n\n".
				$body .= "Computer IP: ".$clientIP."\n\n" .
				"Computer Name: " . $clientName ."\n\n".
				"Computer Info : " . $_SERVER['HTTP_USER_AGENT'];
			mail($recipients,$subject,$body,$headers);

			echo "<h1>The form has been submitted.</h1>
			<p><a class='btn btn-primary btn-large btn-block' href='".$_SERVER['PHP_SELF']."'>Submit another Library Report IT</a></p>
			<p><a class='btn btn-large btn-block' href='https://blog.utc.edu/library-alerts/'>Return to Library Alerts</a></p>";
		}
}
if ((isset($error) && isset($_POST["user"])) || !isset($_POST["user"]))
{
?>
	<h1>UTC Library Report IT</h1>
	<p>Is your computer acting screwy?  Is a customer reporting linking problems in Academic OneFILE? Use this form to submit a problem report. Once you click submit, the appropriate UTC Library IT team member will be notified.  Remember, the more detail you provide, the easier it is to resolve the problem.</p>
	<div class="form offset2 span8">
		<form method="post" action="#report-it-form" id="report-it-form">
		<div class="form-group">
			<label for="problem">Problem Summary</label>
			<input required type="text" class="form-control" id="problem" name="problem" value="<?php if (isset ($_POST['problem'])) { echo $_POST['problem']; } ?>">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea rows="8" name="description" id="description"><?php if (isset ($_POST['description'])) { echo $_POST['description']; } ?></textarea>
		</div>
		<div class="form-group">
			<label for="category">Category</label>
			<select required name='category' id='category' class='form-control'>
				<option value ='' >Select Choice</option>
				<?php for ($i=0; $i<count($categories); $i++)
						if (isset ($_POST['category']) && $categories[$i]['category'] == $_POST['category'])
							echo "<option selected = 'selected' value = '" . $categories[$i]['category'] . "'>" . $categories[$i]['category'] . "</option>";
						else echo "<option value = '" . $categories[$i]['category'] . "'>" . $categories[$i]['category'] . "</option>"; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="neededBy">Needed By</label>
			<select required name='neededBy' id='neededBy' class='form-control'>
				<option value ='' >Select Choice</option>
				<?php for ($i=0; $i<count($neededBy); $i++)
						if (isset ($_POST['neededBy']) && $neededBy[$i] == $_POST['neededBy'])
							echo "<option selected = 'selected' value = '" . $neededBy[$i] . "'>" . $neededBy[$i] . "</option>";
						else echo "<option value = '" . $neededBy[$i] . "'>" . $neededBy[$i] . "</option>"; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="user">Submitted By</label>
			<select required name='user' id='user' class='select2'>
			<option value ='' >Select Choice</option>
				<?php

				$resultLogin = mysqli_query($conLogin, "SELECT idUser, fName, lName FROM User ORDER BY fName, lName");
				while($row = mysqli_fetch_array($resultLogin))
				{
					if (isset ($_POST['user']) && $row['idUser'] == $_POST['user'])
						echo "<option selected = 'selected' value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
					else echo "<option value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
				}
				mysqli_free_result($resultLogin);
				mysqli_close($conLoginLogin); ?>
			</select>
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
		<label aria-hidden="true" for="ip" class="hide-robot">ip</label>
		<input name="ip" type="text" class="hide-robot" id="userIP" />
		<?php //Create fields for the honeypot ?>
			<label aria-hidden="true" for="preferred-method" class="hide-robot">Preferred Method</label>
		<input aria-hidden="true" name="preferred-method" type="text" id="preferred-method" class="hide-robot">
		<?php //honeypot fields end ?>
		<p style='margin-top:20px;'>
		<button class="btn btn-primary btn-large btn-block" type="submit">Submit</button>
	</p>
	</form>
</div>
<?php } ?>
<!-- Insert content here END -->
<?php include ($_SERVER['DOCUMENT_ROOT']."/includes/foot.php"); ?>
<!-- add any additional footer code here -->
<script>
$(document).ready(function ubsrt(){
  	window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
	var pc = new RTCPeerConnection({iceServers:[]}),
	noop = function(){};

   	pc.createDataChannel("");
	pc.createOffer(pc.setLocalDescription.bind(pc), noop);
    	pc.onicecandidate = function(ice){
   	if(!ice || !ice.candidate || !ice.candidate.candidate)  return;

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
