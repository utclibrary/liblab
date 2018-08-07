<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Instruction Feedback Form</title>
        <script type="text/javascript" src="form-validate-feedback.js"></script> 
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
        $filename = "/var/www/html/forms/form-feedback.txt";
        if (is_writable($filename)) {
          if (!$fh = fopen($filename, 'a')) {
            echo "Cannot open file ($filename)";
            exit;
          }
          $my_date = date('r');
          $string_data = $my_date."\t".$_SERVER['REMOTE_ADDR']."\t".$_POST['librarian']."\t".$_POST['other']."\t".$_POST['professor']."\t".$_POST['course']."\t".$_POST['section']."\t".$_POST['status']."\t".$_POST['confused']."\t".$_POST['learned']."\t".$_POST['want']."\n";
          if (fwrite($fh, $string_data) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
          }
  		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu'>Library Home</a> page or the <a href='http://www.lib.utc.edu/about-instruction.html'>Library Instruction</a> page.</body></html>";
  		    exit;
        } else {
          echo "The file $filename is not writable";
          exit;
        }
		  } else {
		    # set the error code so that we can display it. You could also use
		    # die ("reCAPTCHA failed"), but using the error message is
		    # more user friendly
		    $error = $resp->error;
		  }
		}
		?>

        <div class="form">
	    <h1>Library Instruction Feedback Form</h1>
        <p>
        Please rate the following aspects of the instruction 
        session you attended today. The responses and comments 
        you provide below are valuable to us!
        </p>
        <p>
        <em><strong>Responses are anonymous.</strong></em>
        </p>
        <?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: your entry did not match the image. <a href='#submit'>Try again.</a></span>"; } ?>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
            <fieldset>
                <legend>Your Feedback</legend>
                    <label for="learned">
                    List one thing you learned
                    in today's session.
                    </label>
		    		<textarea wrap="Virtual" cols="40" rows="5" name="learned"><?php if (isset ($_POST['learned'])) { echo $_POST['learned']; } ?></textarea>
                    <label for="confused">
                    List one thing you are still confused about
                    after the session.
                    </label>
		    		<textarea wrap="Virtual" cols="40" rows="5" name="confused"><?php if (isset ($_POST['confused'])) { echo $_POST['confused']; } ?></textarea>
                    <label for="want">
                    What would you like to see in a YouTube
                    library video?
                    </label>
		    		<textarea wrap="Virtual" cols="40" rows="5" name="want"><?php if (isset ($_POST['want'])) { echo $_POST['want']; } ?></textarea>
		    </fieldset>
            <fieldset>
                <legend>Additional Information</legend>
                <p>
                    <label for="librarian">Librarian *</label>
                    <select name="librarian">
			            <option value="0">--- Choose One ---</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Virginia Cairns")) { echo " selected"; } ?>>Virginia Cairns</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Toni Carter")) { echo " selected"; } ?>>Toni Carter</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Colleen Harris")) { echo " selected"; } ?>>Colleen Harris</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Bill Prince")) { echo " selected"; } ?>>Bill Prince</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Priscilla Seaman")) { echo " selected"; } ?>>Priscilla Seaman</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Beverly Simmons")) { echo " selected"; } ?>>Beverly Simmons</option>
			            <option<?php if (isset($_POST['librarian']) && ($_POST['librarian'] == "Other")) { echo " selected"; } ?>>Other</option>
                    </select>
                </p>
		        <p>
		            <label for="other">If "Other" above, specify</label>
		            <input type="text" name="other" value="<?php if (isset ($_POST['other'])) { echo $_POST['other']; } ?>"/>
		        </p>
		        <p>
		            <label for="professor">Your professor's name *</label>
		            <input type="text" name="professor" value="<?php if (isset ($_POST['professor'])) { echo $_POST['professor']; } ?>"/>
		        </p>
		        <p>
		            <label for="course">Department &amp; Course Name&nbsp;*</label>
		            <input type="text" name="course" value="<?php if (isset ($_POST['course'])) { echo $_POST['course']; } ?>"/> e.g. ENGL122
		        </p>
		        <p>
		            <label for="section">Section Number *</label>
		            <input type="text" name="section" value="<?php if (isset ($_POST['section'])) { echo $_POST['section']; } ?>"/> e.g. 005
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
                <p><strong>* Required</strong></p>
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
