<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The Lupton Library - Purchase Recommendation Form</title>
        <script type="text/javascript" src="form-validate-purchase.js"></script> 
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
		        $body = "Name:       ".$_POST['name']."\n".
				"Phone:      ".$_POST['phone']."\n".
				"Email:      ".$_POST['email']."\n".
				"Status:     ".$_POST['status']."\n".
        "Dept:       ".$_POST['department']."\n".
        "Author:     ".$_POST['author']."\n".
        "Title:      ".$_POST['title']."\n".
        "Place:      ".$_POST['place']."\n".
        "Publisher:  ".$_POST['publisher']."\n".
        "Year:       ".$_POST['year']."\n".
        "Edition:    ".$_POST['edition']."\n".
        "Other Ed?:  ".$_POST['other']."\n".
        "ISBN:       ".$_POST['isbn']."\n".
				"Message:    ".$_POST['message']."\n";
                $recipients = "mike-bell@utc.edu";
		    mail($recipients, "[Library Form] Purchase Recommendation from ".$_POST['name'],$body,$headers);
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
	    <h1>Library Purchase Recommendation Form</h1>
        <p>
         Have a purchase recommendation for the Lupton Library? Please check that the Library doesn't already own or have on order the item you need by searching the <a href="http://opac.lib.utc.edu/">online catalog</a>. If the item you need does not appear in the online catalog, please send your purchase recommendation using the form below.
        </p>
        <p><strong>*UTC Faculty:</strong> Please submit purchase recommendations through your department's library liaison (see <a href="/about/collections/CD_faculty.html">Collection Development for UTC Faculty</a>) in lieu of using this form. Thank you!
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
            <p>
              <label for="department">Department</label>
              <select name="department">
                <option>--- Choose One ---</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Accounting/Finance")) { echo " selected"; } ?>>Accounting/Finance</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Art")) { echo " selected"; } ?>>Art</option>

                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Biology")) { echo " selected"; } ?>>Biology</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Chemistry")) { echo " selected"; } ?>>Chemistry</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Communications")) { echo " selected"; } ?>>Communications</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Computer Science")) { echo " selected"; } ?>>Computer Science</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Economics")) { echo " selected"; } ?>>Economics</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Education--EHLS")) { echo " selected"; } ?>>Education--EHLS</option>

                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Education--Graduate")) { echo " selected"; } ?>>Education--Graduate</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Education--HECO")) { echo " selected"; } ?>>Education--HECO</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Education--TPA")) { echo " selected"; } ?>>Education--TPA</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "English")) { echo " selected"; } ?>>English</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Engineering")) { echo " selected"; } ?>>Engineering</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Foreign Languages")) { echo " selected"; } ?>>Foreign Languages</option>

                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Geosciences")) { echo " selected"; } ?>>Geosciences</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "History")) { echo " selected"; } ?>>History</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Interdisciplinary Studies")) { echo " selected"; } ?>>Interdisciplinary Studies</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Library")) { echo " selected"; } ?>>Library</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Management")) { echo " selected"; } ?>>Management</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Marketing")) { echo " selected"; } ?>>Marketing</option>

                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Mathematics")) { echo " selected"; } ?>>Mathematics</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Music")) { echo " selected"; } ?>>Music</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Nursing")) { echo " selected"; } ?>>Nursing</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Philosophy/Religion")) { echo " selected"; } ?>>Philosophy/Religion</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Physical Therapy")) { echo " selected"; } ?>>Physical Therapy</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Physics/Astronomy")) { echo " selected"; } ?>>Physics/Astronomy</option>

                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Political Science")) { echo " selected"; } ?>>Political Science</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Psychology")) { echo " selected"; } ?>>Psychology</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Social/Community Services")) { echo " selected"; } ?>>Social/Community Services</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Sociology/Anthropology")) { echo " selected"; } ?>>Sociology/Anthropology</option>
                <option<?php if (isset($_POST['department']) && ($_POST['department'] == "Theater/Speech")) { echo " selected"; } ?>>Theater/Speech</option>
              </select>
            </p>
            </fieldset>
            <fieldset>
                <legend>Your Recommendation</legend>
		        <p>
                    <label for="author">Author</label>
                    <input value="<?php if (isset ($_POST['author'])) { echo $_POST['author']; } ?>" name="author" type="text" size="30">
		        </p>
            <p>
              <label for='title'>Title</label>
              <input value="<?php if (isset ($_POST['title'])) { echo $_POST['title']; } ?>" name='title' type='text' size='30'>
            </p>
            <p>
              <label for='place'>Place of Publication</label>
              <input value="<?php if (isset ($_POST['place'])) { echo $_POST['place']; } ?>" type='text' size='30' name='place'>
            </p>
            <p>
              <label for='publisher'>Publisher</label>
              <input value="<?php if (isset ($_POST['publisher'])) { echo $_POST['publisher']; } ?>" type='text' size='30' name='publisher'>
            </p>
            <p>
              <label for='year'>Year of Publication</label>
              <input value="<?php if (isset ($_POST['year'])) { echo $_POST['year']; } ?>" type='text' size='30' name='year'>
            </p>
            <p>
              <label for='edition'>Edition</label>
              <input value="<?php if (isset ($_POST['edition'])) { echo $_POST['edition']; } ?>" type='text' size='30' name='edition'>
            </p>
            <p>
              <label for='other'>Other Edition Acceptable?</label>
              <select name='other'>
                <option>
                  Yes
                </option>
                <option>
                  No
                </option>
              </select>
            </p>
            <p>
              <label for='isbn'>ISBN</label>
              <input value="<?php if (isset ($_POST['isbn'])) { echo $_POST['isbn']; } ?>" type='text' size='30' name='isbn'>
            </p>
                <p>
                    <label for="message">Additional Information</label>
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
