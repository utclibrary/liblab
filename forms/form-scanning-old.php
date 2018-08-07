<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The UTC Library - Faculty and Staff Scanning Request Form</title>
		<!-- <script type="text/javascript" src="form-validate-reserves.js"></script> -->
        <link rel="stylesheet" href="form-style2.css" />
    </head>
    <body>
		<?php
		require_once('recaptchalib.php');
		$publickey = "6LcaZwAAAAAAAAxzZYmCWidnkWPFZUQjjT441JGa";
		$privatekey = "6LcaZwAAAAAAALjAQIDapshaYaBAkZOQ2NTf8YjL'";
		$copyrightSites = " adhere to the <a href='http://www.utc.edu/library/services/faculty-and-staff/scanning-materials.php'>Guidelines for Faculty Scanning</a>, <a href='http://www.utc.edu/library/services/faculty-and-staff/copyright-and-fair-use-information.php'>fair use policy</a>, and <a href='http://bot.tennessee.edu/counsel-copyright.html'>University of Tennessee copyright policies</a>.";
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
 if ($resp->is_valid && $_POST['certify'] == "on" && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['utcid'])) {
                $headers = "FROM:".$_POST['email']."\n";
                $headers .= "Cc:".$_POST['email'];
		        $body = "Name: ".$_POST['name']."\n".
				"UTCid: ".$_POST['utcid']."\n\n".
			
				"Citation: ".$_POST['biblio']."\n".
				"Item is: ".$_POST['item']."\n".
				"Explanation of Other: ".$_POST['ifother']."\n".
				"Call number: ".$_POST['call']."\n".
				"Need by: ".$_POST['need']."\n\n".
              
			    "Citation: ".$_POST['biblio2']."\n".
				"Item is: ".$_POST['item2']."\n".
				"Explanation of Other: ".$_POST['ifother2']."\n".
				"Call number: ".$_POST['call2']."\n".
				"Need by: ".$_POST['need2']."\n\n".
			
				"Citation: ".$_POST['biblio3']."\n".
				"Item is: ".$_POST['item3']."\n".
				"Explanation of Other: ".$_POST['ifother3']."\n".
				"Call number: ".$_POST['call3']."\n".
				"Need by: ".$_POST['need3']."\n\n".
				
				"Citation: ".$_POST['biblio4']."\n".
				"Item is: ".$_POST['item4']."\n".
				"Explanation of Other: ".$_POST['ifother4']."\n".
				"Call number: ".$_POST['call4']."\n".
				"Need by: ".$_POST['need4']."\n\n".
			
				"Citation: ".$_POST['biblio5']."\n".
				"Item is: ".$_POST['item5']."\n".
				"Explanation of Other: ".$_POST['ifother5']."\n".
				"Call number: ".$_POST['call5']."\n".
				"Need by: ".$_POST['need5']."\n\n".
              
				"Certified: ".$_POST['certify']."\n\n".				

            $recipients = "reserves@utc.edu";
		    mail($recipients, "[Library Form] Scanning request for ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The UTC Library</h2> <p>Return to  the <a href='http://www.lib.utc.edu'>Library Home</a> page, or submit another <a href='http://www5.lib.utc.edu/forms/form-scanning.php'>Scanning Request.</a></body></html>";
		    exit;
		  } else {
		    if (!$resp->is_valid)
		    {
			  	# set the error code so that we can display it. You could also use
			    # die ("reCAPTCHA failed"), but using the error message is
			    # more user friendly
			    $error = $resp->error;
		    }
		    if ($_POST['certify'] != "on")
		    {
		    	$noCopy = true;
			}
			if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['utcid']))
			{
				$noInstructor = true;
			}
		  }
		}
		?>

        <div class="form">
	    <h1>UTC Library Faculty and Staff Scanning Request Form</h1>
        <p>
	<h3>Complete the Form Below</h3>
<ul>
<li>Please complete the form below in its entirety to expedite the processing of your request. </li>  
<li>You will receive an email copy of your submission at the address you provide.</li>
<li>Please provide full bibliographic information for all items submitted as failure to provide this information will slow down the processing of your request.</li>
</ul></p>
<p>
<h3>Processing</h3>
<ul>
<li>Please bring any personal copies (or non-library owned items) to be scanned to the Circulation Desk of the UTC Library.  We recommend printing the email copy of your submission and including that when you drop off your personal copies.</li>
<li>Scanning requests are processed in the order they are received.</li>
<li>Library staff members will retrieve and scan all copies of library owned materials requested.</li>
</ul>
</p>
		<p>
		<h3>Copyright</h3>
		All scanning requests must <?php echo $copyrightSites;?>
</p>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
<?php if (isset($noInstructor)) { echo "<span class='error'>Insructor information is incomplete.</span>"; } ?>	            
            <fieldset>
                <legend>Your Information</legend>

		        <p>
		            <label for="name">Your Name *</label>
		            <input type="text" name="name" value="<?php if (isset ($_POST['name'])) { echo $_POST['name']; } ?>"/>
		        </p>
		        <p>
		            <label for="utcid">UTCID *</label>
		            <input type="text" name="utcid" value="<?php if (isset ($_POST['utcid'])) { echo $_POST['utcid']; } ?>"/>
		        </p>
                        <p>
		            <label for="email">Email *</label>
		            <input type="text" name="email" value="<?php if (isset ($_POST['email'])) { echo $_POST['email']; } ?>"/>
		        </p>

                        </fieldset>
<br />
            <fieldset>
             <legend>Item One</legend>
                 
				 <label for="biblio">Full bibliographic citation</label>
     		<textarea wrap="Virtual" cols="80" rows="5" name="biblio"><?php if (isset ($_POST['biblio'])) { echo $_POST['biblio']; } ?></textarea>
		
		<br />
		
          <table border="0">
          <tr width="100%">
          <td width="25%" VALIGN="top">
          <p style="font-weight: bold;">Item is a</p>
                    <select name="item">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
        <option<?php if (isset($_POST['item']) && ($_POST['item'] == "microfilm")) { echo " selected"; } ?> value="microfilm">Microfilm</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call"><?php if (isset ($_POST['call'])) { echo $_POST['call']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Need by</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="need"><?php if (isset ($_POST['need'])) { echo $_POST['need']; } ?></textarea>
          </td>

          </tr>
          </table>
   <label for="ifother">If item is "other", please explain:</label>
  		<textarea wrap="Virtual" cols="80" rows="1" name="ifother"><?php if (isset ($_POST['ifother'])) { echo $_POST['ifother']; } ?></textarea>
</fieldset>

<fieldset>
             <legend>Item Two</legend>
                 <label for="biblio2">Full bibliographic citation</label>
                
   		<textarea wrap="Virtual" cols="80" rows="5" name="biblio2"><?php if (isset ($_POST['biblio2'])) { echo $_POST['biblio2']; } ?></textarea>
		
		      <br />
	

          <table border="0">
          <tr width="100%">
          <td width="25%" VALIGN="top">
          <p style="font-weight: bold;">Item is a:</p>
                    <select name="item2">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
        <option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "microfilm")) { echo " selected"; } ?> value="microfilm">Microfilm</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call2"><?php if (isset ($_POST['call2'])) { echo $_POST['call2']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Need by</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="need2"><?php if (isset ($_POST['need2'])) { echo $_POST['need2']; } ?></textarea>
          </td>

          </tr>
          </table>
   <label for="ifother2">If item is "other", please explain:</label>
  		<textarea wrap="Virtual" cols="80" rows="1" name="ifother2"><?php if (isset ($_POST['ifother2'])) { echo $_POST['ifother2']; } ?></textarea>
</fieldset>

 <fieldset>
             <legend>Item Three</legend>
                 <label for="biblio3">Full bibliographic citation</label>

                 
   		<textarea wrap="Virtual" cols="80" rows="5" name="biblio3"><?php if (isset ($_POST['biblio3'])) { echo $_POST['biblio3']; } ?></textarea>
		
		      <br />
	

          <table border="0">
          <tr width="100%">
          <td width="25%" VALIGN="top">
          <p style="font-weight: bold;">Item is a:</p>
                    <select name="item3">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
        <option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "microfilm")) { echo " selected"; } ?> value="microfilm">Microfilm</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call3"><?php if (isset ($_POST['call3'])) { echo $_POST['call3']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Need by</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="need3"><?php if (isset ($_POST['need3'])) { echo $_POST['need3']; } ?></textarea>
          </td>

          </tr>
          </table>
   <label for="ifother3">If item is "other", please explain:</label>
  		<textarea wrap="Virtual" cols="80" rows="1" name="ifother3"><?php if (isset ($_POST['ifother3'])) { echo $_POST['ifother3']; } ?></textarea>
</fieldset>

<fieldset>
             <legend>Item Four</legend>
                 <label for="biblio4">Full bibliographic citation</label>

                 
   		<textarea wrap="Virtual" cols="80" rows="5" name="biblio4"><?php if (isset ($_POST['biblio4'])) { echo $_POST['biblio4']; } ?></textarea>
		<br />
		

          <table border="0">
          <tr width="100%">
          <td width="25%" VALIGN="top">
          <p style="font-weight: bold;">Item is a:</p>
                    <select name="item4">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
        <option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "microfilm")) { echo " selected"; } ?> value="microfilm">Microfilm</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

         <textarea wrap="Virtual" cols="20" rows=1" name="call4"><?php if (isset ($_POST['call4'])) { echo $_POST['call4']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Need by</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="need4"><?php if (isset ($_POST['need4'])) { echo $_POST['need4']; } ?></textarea>
          </td>

          </tr>
          </table>
   <label for="ifother4">If item is "other", please explain:</label>
  		<textarea wrap="Virtual" cols="80" rows="1" name="ifother4"><?php if (isset ($_POST['ifother4'])) { echo $_POST['ifother4']; } ?></textarea>
</fieldset>

 <fieldset>
             <legend>Item Five</legend>
                 <label for="biblio5">Full bibliographic citation</label>

                 
   		<textarea wrap="Virtual" cols="80" rows="5" name="biblio5"><?php if (isset ($_POST['biblio5'])) { echo $_POST['biblio5']; } ?></textarea>
		
		        

          <table border="0">
          <tr width="100%">
          <td width="25%" VALIGN="top">
          <p style="font-weight: bold;">Item is a:</p>
                    <select name="item5">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
        <option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "microfilm")) { echo " selected"; } ?> value="microfilm">Microfilm</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

         <textarea wrap="Virtual" cols="20" rows=1" name="call5"><?php if (isset ($_POST['call5'])) { echo $_POST['call5']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Need by</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="need5"><?php if (isset ($_POST['need5'])) { echo $_POST['need5']; } ?></textarea>
          </td>

          </tr>
          </table>
   <label for="ifother5">If item is "other", please explain:</label>
  		<textarea wrap="Virtual" cols="80" rows="1" name="ifother5"><?php if (isset ($_POST['ifother5'])) { echo $_POST['ifother5']; } ?></textarea>
</fieldset>
<?php if (isset($noCopy)) { echo "<span class='error'>Copyright: You did not certify that your submissions adhere to the copyright policy.</span>"; } ?>	
			<fieldset>
			<p><div style="float:left;"><INPUT TYPE=CHECKBOX NAME="certify"></div>
			&nbsp;I certify that the materials I am submitting to be scanned <?php echo $copyrightSites;?></p> 
			</fieldset>
<br />
<?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: Your entry did not match the image.</span>"; } ?>
		    <fieldset>
		        <legend>Stop Spam, Read Books</legend>
                <p>
                Please enter the words you see in the box below, in order and separated by a space. Doing so helps prevent automated programs from abusing this service.
    		        <?php echo recaptcha_get_html($publickey, $error); ?>
    		        <input type="submit" name="submit" value="submit" />
                </p>
		    </fieldset>


            <a name="submit"></a>

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