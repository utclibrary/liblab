<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Distance Learner Registration Form</title>
        <script type="text/javascript" src="form-validate-dist.js"></script> 
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
				"Eve. Phone: ".$_POST['eve_phone']."\n".
				"Email: ".$_POST['email']."\n".
				"UTCid: ".$_POST['utcid']."\n".
				"Dept: ".$_POST['dept']."\n".
				"Course No.: ".$_POST['number']."\n".
				"Course Title: ".$_POST['title']."\n".
				"Professor: ".$_POST['professor']."\n";
                $recipients = "ill@utc.edu";
		    mail($recipients, "[Library Form] Distance Learner Registration from ".$_POST['name'],$body,$headers);
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
	    <h1>Distance Learner Registration Form</h1>
        <p>
        All book and article requests for distance learners 
          are routed through our InterLibrary Loan system, ILLiad. To register 
          with Lupton Library as a Distance Education student:</p>
        <ul>
          <li>Fill out and submit this form, <strong>AND</strong></li>
          <li>Go to the ILLiad website and <a href="http://illiad.lib.utc.edu/">L<span class="bodyText">ogon 
            to ILLiad</span></a><span class="bodyText"> using your UTCID and password 
            to complete and submit the ILLiad new user registration form.</span></li>

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
		            <label for="utcid">UTCID</label>
		            <input type="text" name="utcid" value="<?php if (isset ($_POST['utcid'])) { echo $_POST['utcid']; } ?>"/> e.g. abc123
        </p>
        <p>If you do not have a UTCID, please enter the last three digits of your Social Security Number for verification.
		        </p>
            </fieldset>
            <fieldset>
                <legend>Distance Education Course</legend>
		        <p>
		            <label for="dept">Department</label>
		            <input type="text" name="dept" value="<?php if (isset ($_POST['dept'])) { echo $_POST['dept']; } ?>" />
		        </p>
		        <p>
		            <label for="number">Course Number</label>
		            <input type="text" name="number" value="<?php if (isset ($_POST['number'])) { echo $_POST['number']; } ?>" />
		        </p>
		        <p>
		            <label for="title">Course Title</label>
		            <input type="text" name="title" value="<?php if (isset ($_POST['title'])) { echo $_POST['title']; } ?>" />
		        </p>
		        <p>
		            <label for="professor">Professor</label>
		            <input type="text" name="professor" value="<?php if (isset ($_POST['professor'])) { echo $_POST['professor']; } ?>" />
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
