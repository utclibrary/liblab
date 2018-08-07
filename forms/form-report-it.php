<?php
//turn error reporting off default N
$errorReporting = "Y";
//template system to replicate main website look and feel
$title = "UTC Library Report IT";
$description = "Report Form for IT Problems of All Kinds";
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
$categories = array
	(
		0 => array(
			'category' => 'Library IT',
			'email' => 'libtech@utc.edu'
		),
		1 => array(
					'category' => 'Classroom Tech',
					'email' => 'libtech@utc.edu, libinstruction@utc.edu'
		),
		2 => array(
			'category' => 'E-Resources',
			'email' => 'libtech@utc.edu, Charlie-Remy@utc.edu, Katie-Gohn@utc.edu'
		),
		3 => array(
			'category' => 'Website',
			'email' => 'libtech@utc.edu'
		),
		4 => array(
			'category' => 'OCLC',
			'email' => 'libtech@utc.edu, Charlie-Remy@utc.edu, Katie-Gohn@utc.edu'
		),
		5 => array(
			'category' => 'Building',
			'email' => 'libadmin@utc.edu'
		)
	);
$neededBy = array("Now", "1 to 2 Days", "This Week", "Next Week", "This Month", "This Semester");
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
			require_once ('mysqlconnect.php');
			$user = $_POST['user'];
			$result = mysqli_query($con, "SELECT fName, lName, email FROM User WHERE idUser = '$user'");
				while($row = mysqli_fetch_array($result))
				{
					$userEmail = $row['email'];
					$userName = $row['fName'] . " " . $row['lName'];
				}
			mysqli_free_result($result);
			mysqli_close($con);
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
				$body .= "Computer IP: " . $_SERVER['REMOTE_ADDR'] ."\n\n".
				"Computer Name: " . gethostbyaddr($_SERVER['REMOTE_ADDR']) ."\n\n".
				"Computer Info : " . $_SERVER['HTTP_USER_AGENT'];
			mail($recipients,$subject,$body,$headers);
			echo "<h1>The form has been submitted.</h1><p>Return to the <a href='https://www5.utc.edu/forms/form-report-it.php'>Library Report IT</a> page ";
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
	<h1>UTC Library Report IT</h1>
	<p>Is your computer acting screwy?  Is a customer reporting linking problems in Academic OneFILE? Use this form to submit a problem report. Once you click submit, the appropriate UTC Library IT team member will be notified.  Remember, the more detail you provide, the easier it is to resolve the problem.</p>
	<form action="" method="post" onSubmit="return checkWholeForm(this);" />
		<div class="form-group">
			<label for="problem">Problem Summary</label>
			<input required type="text" class="form-control" id="problem" name="problem" value="<?php if (isset ($_POST['problem'])) { echo $_POST['problem']; } ?>">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea rows="8" name="description"><?php if (isset ($_POST['description'])) { echo $_POST['description']; } ?></textarea>
		</div>
		<div class="form-group">
			<label for="category">Category</label>
			<select required name='category' class='form-control'>
				<option value ='' >Select Choice</option>
				<?php for ($i=0; $i<count($categories); $i++)
						if (isset ($_POST['category']) && $categories[$i]['category'] == $_POST['category'])
							echo "<option selected = 'selected' value = '" . $categories[$i]['category'] . "'>" . $categories[$i]['category'] . "</option>";
						else echo "<option value = '" . $categories[$i]['category'] . "'>" . $categories[$i]['category'] . "</option>"; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="neededBy">Needed By</label>
			<select required name='neededBy' class='form-control'>
				<option value ='' >Select Choice</option>
				<?php for ($i=0; $i<count($neededBy); $i++)
						if (isset ($_POST['neededBy']) && $neededBy[$i] == $_POST['neededBy'])
							echo "<option selected = 'selected' value = '" . $neededBy[$i] . "'>" . $neededBy[$i] . "</option>";
						else echo "<option value = '" . $neededBy[$i] . "'>" . $neededBy[$i] . "</option>"; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="user">Submitted By</label>
			<select required name='user' class='form-control'>
			<option value ='' >Select Choice</option>
				<?php require_once ('mysqlconnect.php');
				$result = mysqli_query($con, "SELECT idUser, fName, lName FROM User ORDER BY fName, lName");
				while($row = mysqli_fetch_array($result))
				{
					if (isset ($_POST['user']) && $row['idUser'] == $_POST['user'])
						echo "<option selected = 'selected' value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
					else echo "<option value ='" . $row['idUser'] . "'>" . $row['fName'] . " " . $row['lName'] . "</option>";
				}
				mysqli_free_result($result);
				mysqli_close($con); ?>
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
