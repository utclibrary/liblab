<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Library Enhancement Initiative Form</title>
        <script type="text/javascript" src="form-validate-enha.js"></script> 
        <script type="text/javascript" src="popup.js"></script> 
        <link rel="stylesheet" href="form-style.css" />
        <style>
            span.note {
                font-weight: normal;
            }
        </style>
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
				"Dept: ".$_POST['dept']."\n".
				"Course: ".$_POST['course']."\n".
				"Amount: ".$_POST['amount']."\n".
				"Proposal:\n\n".$_POST['proposal']."\n\n".
				"Items:\n\n".$_POST['items']."\n\n";
            #$recipients = "brian-kysela@utc.edu";
            $recipients = "theresa-liedtka@utc.edu";
		    mail($recipients, "[Library Form] Enhancement Initiative submitted by ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu/faculty-and-staff.html'>Faculty &amp; Staff</a> page or the <a href='http://www.lib.utc.edu'>Library Home</a> page.</body></html>";
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
	    <h1>Library Enhancement Initiative Form</h1>
        <p> The library committee will only consider those proposals that follow all the guidelines. Please <a href="form-enha-guidelines.html" onClick="return show_hide_box(this,300,850,'2px dotted #c7cfd5')">review the guidelines</a> and submit your proposal using the form below by <strong>December 12th</strong>.</p>
<p>If you would prefer to submit a paper copy rather than using the form below, print out <a href="http://www.lib.utc.edu/joomla/images/documents/enhancement_initiative.pdf">this PDF form</a> and follow the instructions it contains.</p>
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
		            <label for="dept">Department</label>
		            <input type="text" name="dept" value="<?php if (isset ($_POST['dept'])) { echo $_POST['dept']; } ?>"/>
		        </p>
            </fieldset>
            <fieldset>
                <legend>Proposal Information</legend>
		        <p>
		            <label for="course">Course, program, or research project for which materials are requested</label>
		            <input type="text" name="course" value="<?php if (isset ($_POST['course'])) { echo $_POST['course']; } ?>"/> 
		        </p>
                <p>&nbsp;</p>
		        <p>
		            <label for="amount">Dollar amount of request</label>
		            <input type="text" name="amount" value="<?php if (isset ($_POST['amount'])) { echo $_POST['amount']; } ?>"/> <strong>$750.00 Maximum</strong>
		        </p>
				<p>
		    		<label for="proposal">Proposal narrative</label>
		    		<textarea wrap="Virtual" cols="40" rows="15" name="proposal"><?php if (isset ($_POST['proposal'])) { echo $_POST['proposal']; } ?></textarea>
		        </p>
				<p>
		    		<label for="items">List of Items to purchase <span class="note"><br/>Please include as much bibliographic information as possible.</span></label>
		    		<textarea wrap="Virtual" cols="40" rows="15" name="items"><?php if (isset ($_POST['items'])) { echo $_POST['items']; } ?></textarea>
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
