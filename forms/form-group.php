<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Group Study Room Request Form</title>
        <script type="text/javascript" src="form-validate-group.js"></script> 
        <link rel="stylesheet" href="form-style.css" />
    </head>
    <body>
		<?php
		require_once('recaptchalib.php');
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
		        $headers = "FROM:".$_POST['email']."\n";
		        $body = "Name: ".$_POST['name']."\n".
				"Phone: ".$_POST['phone']."\n".
				"Email: ".$_POST['email']."\n".
				"UTCid: ".$_POST['utcid']."\n".
				"Date: ".$_POST['date_time']."\n".
				"Number: ".$_POST['number']."\n";
                $recipients = "library@utc.edu";
		    mail($recipients, "[Library Form] Group Study Room Request from ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu/group-study-rooms.html'>Group Study Rooms</a> page or the <a href='http://www.lib.utc.edu'>Library Home</a> page.</body></html>";
		    exit;
		  } else {
		    # set the error code so that we can display it. You could also use
		    # die ("reCAPTCHA failed"), but using the error message is
		    # more user friendly
		    $error = $resp->error;
		  }
		}
		?>

        <div class="form">
	    <h1>Group Study Room Request Form</h1>
        <p>
        Please use the form below to request the use of a Group Study Room at Lupton Library. These rooms cannot be reserved for more than four hours on a single day.  Lupton Library reserves the right to prevent overuse of the Group Study Rooms by a single group of people.
        
        <div style="color:red;">You will be contacted by a library staff member regarding our ability to honor your request.  Until you receive this verification, your room has not been reserved.  If you need immediate assistance, please call the Circulation Desk at 423-425-4501.
        </div></p>
        <?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: your entry did not match the image. <a href='#submit'>Try again.</a></span>"; } ?>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
		    <fieldset>
		        <legend>Your Information</legend>
		        <p>
		            <label for="name">Name</label>
		            <input type="text" name="name" value="<?php if (isset ($_POST['name'])) { echo $_POST['name']; } ?>" />
		        </p>
		        <p>
		            <label for="phone">Phone</label>
		            <input type="text" name="phone" value="<?php if (isset ($_POST['phone'])) { echo $_POST['phone']; } ?>"/>
		        </p>
		        <p>
		            <label for="email">Email</label>
		            <input type="text" name="email" value="<?php if (isset ($_POST['email'])) { echo $_POST['email']; } ?>"/>
		        </p>
		        <p>
		            <label for="utcid">UTCID</label>
		            <input type="text" name="utcid" value="<?php if (isset ($_POST['utcid'])) { echo $_POST['utcid']; } ?>"/> e.g. abc123
        </p>
        <p>If you do not have a UTCID, please enter the last three digits of your Social Security Number for verification.
		        </p>
            </fieldset>
            <fieldset>
                <legend>Your Request</legend>
		        <p>
		            <label for="date_time">Preferred Date and Time</label>
		            <input type="text" name="date_time" value="<?php if (isset ($_POST['date_time'])) { echo $_POST['date_time']; } ?>" /> mm/dd time
		        </p>
		        <p>
		            <label for="number">Number of students in study group</label>
		            <input type="text" name="number" value="<?php if (isset ($_POST['number'])) { echo $_POST['number']; } ?>" />
		        </p>
		    </fieldset>
            <a name="submit"></a>
		    <fieldset>
		        <legend>Stop Spam, Read Books</legend>
                <p>
                Please enter the words you see in the box below, in order and separated by a space. Doing so helps prevent automated programs from abusing this service.
    		        <?php echo recaptcha_get_html($publickey, $error); ?>
    		        <input type="submit" name="submit" value="submit" />
                </p>
		    </fieldset>
	    </form>
        </div>
        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
        </script>
        <script type="text/javascript">
        _uacct = "UA-1265795-1";
        _udn="lib.utc.edu";
        urchinTracker();
        </script>
    </body>
</html>
