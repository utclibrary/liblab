<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>UTC Library Walkthrough</title>
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
		        $email = "lib-it@utc.edu";
                        $headers = "FROM:".$_POST['email']."\n";
		        $body = "".
                "      Ok? : ".$_POST['ok']."\n".
		"   Why not? : ".$_POST['text']."\n";
                $recipients = "lisa-price@utc.edu,jason-griffey@utc.edu,layton-jackson@utc.edu,Cheryl-VanMater@utc.edu,theresa-liedtka@utc.edu,joshua-cash@utc.edu,anna-lane@utc.edu,mike-bell@utc.edu,virginia-cairns@utc.edu,laird-leathers@utc.edu";
		    mail($recipients, "[Library Walkthrough]: ".$_POST['ok'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1><p>Return to the <a href='http://www5.lib.utc.edu/forms/form-bldg.php'>Library Walkthrough</a> page or the <a href='http://library.utc.edu'>Library Home</a> page.</body></html>";
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
	    <h1>UTC Library Walkthrough</h1>
        <p>
        Please indicate any issues in the text field. If there are no issues, please click OK and submit.
        </p>
       <?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: your entry did not match the image. <a href='#submit'>Try again.</a></span>"; } ?>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
		    <fieldset>
		        <legend>Walkthrough</legend>
		        <p>
		            <label for="ok">OK!</label>
		            <input type="radio" name="ok" value="ok" />
		        </p>
		        <p>
                            <label for="not_ok">Not OK.</label>
                            <input type="radio" name="ok" value="Not ok" />
                       </p>
                       
                       </fieldset>
                       <fieldset>
                       <legend>Not OK</legend>
                            <label for="text">Why are things not ok?</label>
		               		<textarea wrap="Virtual" cols="40" rows="5" name="text"><?php if (isset ($_POST['text'])) { echo $_POST['text']; } ?></textarea>
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
