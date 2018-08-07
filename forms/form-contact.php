<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Contact Form</title>
        <script type="text/javascript" src="form-validate-contact.js"></script> 
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
                $headers .= "Cc: virginia-cairns@utc.edu,chris-ryan@utc.edu,theresa-liedtka@utc.edu\n";
		        $body = "Name: ".$_POST['name']."\n".
				"Phone: ".$_POST['phone']."\n".
				"Email: ".$_POST['email']."\n".
				"Status: ".$_POST['status']."\n".
				"Message Type: ".$_POST['type']."\n".
				"Message:\n".$_POST['message']."\n";
                $recipients = "ask-a-librarian@utc.edu";
		    mail($recipients, "[Library Form] Feedback from ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu'>Library Home</a> page.</body></html>";
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
	    <h1>Library Contact Form</h1>
        <p>
        Have a question, comment, or suggestion? Send an email to the Lupton Library using the form below.
        </p>
        <p>
        If you need 
        immediate research assistance, please call the Reference Desk at <strong>423-425-4510</strong> during <a href="http://www.lib.utc.edu/library-hours-2.html">operating hours</a>.
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
		            <label for="phone">Phone</label>
		            <input type="text" name="phone" value="<?php if (isset ($_POST['phone'])) { echo $_POST['phone']; } ?>"/>
		        </p>
		        <p>
		            <label for="email">Email</label>
		            <input type="text" name="email" value="<?php if (isset ($_POST['email'])) { echo $_POST['email']; } ?>"/>
		        </p>
                <p>
                    <label for="status">Status</label>
                    <select name="status">
			            <option value="0">--- Choose One ---</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Faculty")) { echo " selected"; } ?>>Faculty</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Staff")) { echo " selected"; } ?>>Staff</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Graduate Student")) { echo " selected"; } ?>>Graduate Student</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Undergraduate")) { echo " selected"; } ?>>Undergraduate Student</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Alumnus")) { echo " selected"; } ?>>Alumnus</option>
			            <option<?php if (isset($_POST['status']) && ($_POST['status'] == "Other")) { echo " selected"; } ?>>Other</option>
                    </select>
                </p>
            </fieldset>
            <fieldset>
                <legend>Your Message</legend>
		        <p>
                    <label for="type">Message Type</label>
                    <select name="type">
			            <option<?php if (isset($_POST['type']) && ($_POST['type'] == "Comment")) { echo " selected"; } ?>>Comment</option>
			            <option<?php if (isset($_POST['type']) && ($_POST['type'] == "Question")) { echo " selected"; } ?>>Question</option>
			            <option<?php if (isset($_POST['type']) && ($_POST['type'] == "Suggestion")) { echo " selected"; } ?>>Suggestion</option>
			            <option<?php if (isset($_POST['type']) && ($_POST['type'] == "Complaint")) { echo " selected"; } ?>>Complaint</option>
			            <option<?php if (isset($_POST['type']) && ($_POST['type'] == "Compliment")) { echo " selected"; } ?>>Compliment</option>
                    </select>
		        </p>
                <p>
                    <label for="message">Message</label>
		    		<textarea wrap="Virtual" cols="40" rows="5" name="message"><?php if (isset ($_POST['message'])) { echo $_POST['message']; } ?></textarea>
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
