<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Distance Learner TBR/UT Card Request Form</title>
        <script type="text/javascript" src="form-validate-card.js"></script> 
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
		        $body = "".
                "      Name: ".$_POST['name']."\n".
				"     Phone: ".$_POST['phone']."\n".
				"Eve. Phone: ".$_POST['eve_phone']."\n".
				"     Email: ".$_POST['email']."\n".
				"     UTCid: ".$_POST['utcid']."\n".
				"   Address: ".$_POST['address']."\n".
				"      City: ".$_POST['city']."\n".
				"     State: ".$_POST['state']."\n".
				"       Zip: ".$_POST['zip']."\n";
                $recipients = "ill@utc.edu";
		    mail($recipients, "[Library Form] Distance Learner TBR/UT Card Request from ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu/distance-education-students.html'>Distance Education Students</a> page or the <a href='http://www.lib.utc.edu'>Library Home</a> page.</body></html>";
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
	    <h1>Distance Learner TBR/UT Card Request Form</h1>
        <p>
        If you are a UTC Distance Education student and would like to apply for a TBR/UT Card online, please submit the form below.  This card allows authorized users to borrow materials from other TBR/UT libraries and expires at the end of each semester for which a user is enrolled.
        </p>
        </ul>
        <p>For more information about Distance Education library services, please call the InterLibrary Services Department at 423-425-4739.
        </p>
        <?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: your entry did not match the image. <a href='#submit'>Try again.</a></span>"; } ?>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
		    <fieldset>
		        <legend>Your Information</legend>
		        <p>
		            <label for="name">Name</label>
		            <input type="text" name="name" value="<?php if (isset ($_POST['name'])) { echo $_POST['name']; } ?>" />
		        </p>
		        <p>
		            <label for="phone">Daytime Phone</label>
		            <input type="text" name="phone" value="<?php if (isset ($_POST['phone'])) { echo $_POST['phone']; } ?>"/>
		        </p>
		        <p>
		            <label for="eve_phone">Evening Phone</label>
		            <input type="text" name="eve_phone" value="<?php if (isset ($_POST['eve_phone'])) { echo $_POST['eve_phone']; } ?>"/>
		        </p>
		        <p>
		            <label for="email">Email</label>
		            <input type="text" name="email" value="<?php if (isset ($_POST['email'])) { echo $_POST['email']; } ?>"/>
		        </p>
		        <p>
		            <label for="address">Street Address</label>
		            <input type="text" name="address" value="<?php if (isset ($_POST['address'])) { echo $_POST['address']; } ?>" />
		        </p>
		        <p>
		            <label for="city">City</label>
		            <input type="text" name="city" value="<?php if (isset ($_POST['city'])) { echo $_POST['city']; } ?>" />
		        </p>
		        <p>
		            <label for="state">State</label>
		            <input type="text" name="state" value="<?php if (isset ($_POST['state'])) { echo $_POST['state']; } ?>" />
		        </p>
		        <p>
		            <label for="zip">Zip Code</label>
		            <input type="text" name="zip" value="<?php if (isset ($_POST['zip'])) { echo $_POST['zip']; } ?>" />
		        </p>
		        <p>
		            <label for="utcid">UTCID</label>
		            <input type="text" name="utcid" value="<?php if (isset ($_POST['utcid'])) { echo $_POST['utcid']; } ?>"/> e.g. abc123
        </p>
        <p>If you do not have a UTCID, please enter the last three digits of your Social Security Number for verification.
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
