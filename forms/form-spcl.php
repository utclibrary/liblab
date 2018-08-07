<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Customized Instruction Form</title>
        <script type="text/javascript" src="form-validate.js"></script> 
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
				"Course: ".$_POST['course']."\n".
				"Section: ".$_POST['section']."\n".
				"Class Size: ".$_POST['class_size']."\n".
				"Start time: ".$_POST['start_time']."\n".
				"End time: ".$_POST['end_time']."\n".
				"Date: ".$_POST['date_time']."\n".
				"Alt. Date: ".$_POST['alternate_date_time']."\n\n".
				"Assignment:\n".$_POST['assignment']."\n\n".
				"Emphasize:\n".$_POST['emphasize'];
            $recipients = "virginia-cairns@utc.edu,beverly-simmons@utc.edu,layton-jackson@utc.edu";
#$recipients = "brian-kysela@utc.edu";
		    mail($recipients, "[Library Form] Customized Instruction with ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The Lupton Library</h2> <p>Return to the <a href='http://www.lib.utc.edu/index.php?option=com_content&task=view&id=26&Itemid=188'>Library Instruction</a> page or the <a href='http://www.lib.utc.edu'>Library Home</a> page.</body></html>";
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
	    <h1>Customized Instruction Form</h1>
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
            </fieldset>
            <fieldset>
                <legend>Class Information</legend>
		        <p>
		            <label for="course">Department and Course Name</label>
		            <input type="text" name="course" value="<?php if (isset ($_POST['course'])) { echo $_POST['course']; } ?>"/> e.g. ENGL122
		        </p>
		        <p>
		            <label for="section">Section Number</label>
		            <input type="text" name="section" value="<?php if (isset ($_POST['section'])) { echo $_POST['section']; } ?>"/>
		        </p>
		        <p>
		            <label for="class_size">Number of Students</label>
		            <input type="text" name="class_size" value="<?php if (isset ($_POST['class_size'])) { echo $_POST['class_size']; } ?>"/>
		        </p>
		        <p>
		            <label for="start_time">Start Time</label>
		            <input type="text" name="start_time" value="<?php if (isset ($_POST['start_time'])) { echo $_POST['start_time']; } ?>"/>
		        </p>
		        <p>
		            <label for="end_time">End Time</label>
		            <input type="text" name="end_time" value="<?php if (isset ($_POST['end_time'])) { echo $_POST['end_time']; } ?>"/>
		        </p>
		        <p>
		            <label for="date_time">Preferred Date</label>
		            <input type="text" name="date_time" value="<?php if (isset ($_POST['date_time'])) { echo $_POST['date_time']; } ?>" /> mm/dd :: day of the week :: time
		        </p>
		        <p>
		            <label for="alternate_date_time">Alternate Date</label>
		            <input type="text" name="alternate_date_time" value="<?php if (isset ($_POST['alternate_date_time'])) { echo $_POST['alternate_date_time']; } ?>" /> mm/dd :: day of the week :: time
		        </p>
		    </fieldset>
		    <fieldset>
				<legend>Your Assignment</legend>
				<p>
		    		Please attend this library instruction session with your class. Students should have 
		    		an assignment relating to the library instruction session before coming in to the session.
                    Please copy and paste your assignment into the field below.
				</p>
				<p>
		    		<label for="assignment">Assignment</label>
		    		<textarea wrap="Virtual" cols="40" rows="5" name="assignment"><?php if (isset ($_POST['assignment'])) { echo $_POST['assignment']; } ?></textarea>
		        <p>
		            <label for="emphasize">Subjects, resources, or research techniques you would like to have emphasized</label>
		            <textarea wrap="Virtual" cols="40" rows="5" name="emphasize" ><?php if (isset ($_POST['emphasize'])) { echo $_POST['emphasize']; } ?></textarea>
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
        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
        </script>
        <script type="text/javascript">
        _uacct = "UA-1265795-1";
        _udn="lib.utc.edu";
        urchinTracker();
        </script>
        </div>
    </body>
</html>
