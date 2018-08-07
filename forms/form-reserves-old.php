<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
    <head>
        <title>The UTC Library - Reserves Submission Form</title>
		<!-- <script type="text/javascript" src="form-validate-reserves.js"></script> -->
        <link rel="stylesheet" href="form-style2.css" />
    </head>
    <body>
		<?php
		require_once('recaptchalib.php');
		$publickey = "6LcaZwAAAAAAAAxzZYmCWidnkWPFZUQjjT441JGa";
		$privatekey = "6LcaZwAAAAAAALjAQIDapshaYaBAkZOQ2NTf8YjL'";
		$copyrightSites = " adhere to <a href='http://www.utc.edu/library/services/faculty-staff/copyright-fair-use.php'>copyright and fair use policies</a>, and <a href='http://bot.tennessee.edu/counsel-copyright.html'>University of Tennessee copyright policies</a>.";
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
 if ($resp->is_valid && $_POST['certify'] == "on" && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['utcid']) && !empty($_POST['department']) && !empty($_POST['number']) && !empty($_POST['title']) && $_POST['semesteron'] != "0") {
                $headers = "FROM:".$_POST['email']."\n";
                $headers .= "Cc:".$_POST['email'];
		        $body = "Name: ".$_POST['name']."\n".
				"UTCid: ".$_POST['utcid']."\n\n".
				"Department: ".$_POST['department']."\n".
				"Course Number: ".$_POST['number']."\n".
				"Section Number: ".$_POST['section']."\n".
				"Course Title: ".$_POST['title']."\n".
				"Course Cross Listing: ".$_POST['cross']."\n\n".
				"Reserve Starts: ".$_POST['semesteron']."\n\n".
			
				"Citation: ".$_POST['biblio']."\n".
				"Item is: ".$_POST['item']."\n".
				"Explanation of Other: ".$_POST['ifother']."\n".
				"Call number: ".$_POST['call']."\n".
               "Loan Length: ".$_POST['loan']."\n".
				"Need by: ".$_POST['need']."\n\n".
              
			   "Citation: ".$_POST['biblio2']."\n".
				"Item is: ".$_POST['item2']."\n".
				"Explanation of Other: ".$_POST['ifother2']."\n".
				"Call number: ".$_POST['call2']."\n".
                "Loan Length: ".$_POST['loan2']."\n".
				"Need by: ".$_POST['need2']."\n\n".
			
				"Citation: ".$_POST['biblio3']."\n".
				"Item is: ".$_POST['item3']."\n".
				"Explanation of Other: ".$_POST['ifother3']."\n".
				"Call number: ".$_POST['call3']."\n".
                "Loan Length: ".$_POST['loan3']."\n".
				"Need by: ".$_POST['need3']."\n\n".
				
				"Citation: ".$_POST['biblio4']."\n".
				"Item is: ".$_POST['item4']."\n".
				"Explanation of Other: ".$_POST['ifother4']."\n".
				"Call number: ".$_POST['call4']."\n".
                 "Loan Length: ".$_POST['loan4']."\n".
				"Need by: ".$_POST['need4']."\n\n".
			
				"Citation: ".$_POST['biblio5']."\n".
				"Item is: ".$_POST['item5']."\n".
				"Explanation of Other: ".$_POST['ifother5']."\n".
				"Call number: ".$_POST['call5']."\n".
                 "Loan Length: ".$_POST['loan5']."\n".
				"Need by: ".$_POST['need5']."\n\n".
              
				"Certified: ".$_POST['certify']."\n\n".				

            $recipients = "reserves@utc.edu";
		    mail($recipients, "[Library Form] Reserve request for ".$_POST['name'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1> <h2>Thank you, The UTC Library</h2> <p>Return to  the <a href='http://http:/www.utc.edu/library/'>Library Home</a> page, or submit another <a href='http://www5.lib.utc.edu/forms/form-reserves.php'>Reserves Request.</a></body></html>";
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
		  	if (empty($_POST['department']) || empty($_POST['number']) || empty($_POST['title']) || $_POST['semesteron'] == "0")
			{
				$noCourse = true;
			}
		  }
		}
		?>

        <div class="form">
	    <h1>UTC Library Reserves Submission Form</h1>
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
<li>Please bring any personal copies (or non-library owned items) to be placed on Course Reserve to the Circulation Desk of the UTC Library.  We recommend printing the email copy of your submission and including that when you drop off your personal copies.</li>
<li>Please send electronic copies of any personal items to <a href="mailto:reserves@utc.edu">reserves@utc.edu</a></li>
<li>Reserves requests are processed in the order they are received.</li>
<li>Library staff members will retrieve and process all copies of library owned materials requested.</li>
</ul>
</p>
		<p>
		<h3>Copyright</h3>
		All course reserve requests must <?php echo $copyrightSites;?>
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
<?php if (isset($noCourse)) { echo "<span class='error'>Course information is incomplete.</span>"; } ?>							
                        <fieldset>
                        <legend>Your Course</legend>
		        <p>
		            <label for="department">Department *</label>
		            <input type="text" name="department" value="<?php if (isset ($_POST['department'])) { echo $_POST['department']; } ?>"/>
		        </p>
		        <p>
		            <label for="number">Course Number *</label>
		            <input type="text" name="number" value="<?php if (isset ($_POST['number'])) { echo $_POST['number']; } ?>"/>
		        </p>
		        
		             <p>
		            <label for="section">Section Number *</label>
		            <input type="text" name="section" value="<?php if (isset ($_POST['section'])) { echo $_POST['section']; } ?>"/>
		        </p>
		        
		             <p>
		            <label for="title">Course Title *</label>
		            <input type="text" name="title" value="<?php if (isset ($_POST['title'])) { echo $_POST['title']; } ?>"/>
		        </p>

                                <label for="cross">Course Cross Listing</label>
		            <input type="text" name="cross" value="<?php if (isset ($_POST['cross'])) { echo $_POST['cross']; } ?>"/>
		        </p>

                <p>

                <table border="0" width="100%">
<tr>
<td>
<label>On Reserve for *</label>
        <select name="semesteron">
		<option value="0">--- Choose One ---</option>
		<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Spring2014")) { echo " selected"; } ?> value="Spring2014">Spring 2014</option>
		<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Summer2014")) { echo " selected"; } ?> value="Summer2014">Summer 2014</option>
		<!--<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Fall2014")) { echo " selected"; } ?> value="Fall2014">Fall 2014</option>
		<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Spring2015")) { echo " selected"; } ?> value="Spring2015">Spring 2015</option>
		<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Summer2015")) { echo " selected"; } ?> value="Summer2015">Summer 2015</option>
		<option<?php if (isset($_POST['semesteron']) && ($_POST['semesteron'] == "Fall2015")) { echo " selected"; } ?> value="Fall2015">Fall 2015</option>-->

                    </select>

                    </td>

</tr>
</table>


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
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "book")) { echo " selected"; } ?> value="book">Book</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "dvd")) { echo " selected"; } ?> value="dvd">DVD</option>
        <option<?php if (isset($_POST['item']) && ($_POST['item'] == "vhs")) { echo " selected"; } ?> value="vhs">VHS</option>
		<option<?php if (isset($_POST['item']) && ($_POST['item'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call"><?php if (isset ($_POST['call'])) { echo $_POST['call']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
                 <p style="font-weight: bold;">Loan Length</p>
                    <select name="loan">
		<option value="0">--- Choose One ---</option>
        <option<?php if (isset($_POST['loan']) && ($_POST['loan'] == "electronic")) { echo " selected"; } ?> value="electronic">Electronic</option>
		<option<?php if (isset($_POST['loan']) && ($_POST['loan'] == "threehour")) { echo " selected"; } ?> value="threehour">3 hours</option>
		<option<?php if (isset($_POST['loan']) && ($_POST['loan'] == "oneday")) { echo " selected"; } ?> value="oneday">1 Day</option>
		<option<?php if (isset($_POST['loan']) && ($_POST['loan'] == "threeday")) { echo " selected"; } ?> value="threeday">3 Days</option>
		<option<?php if (isset($_POST['loan']) && ($_POST['loan'] == "sevenday")) { echo " selected"; } ?> value="sevenday">7 Days</option>
                    </select>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Students need by</p>

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
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "book")) { echo " selected"; } ?> value="book">Book</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "dvd")) { echo " selected"; } ?> value="dvd">DVD</option>
        <option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "vhs")) { echo " selected"; } ?> value="vhs">VHS</option>
		<option<?php if (isset($_POST['item2']) && ($_POST['item2'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call2"><?php if (isset ($_POST['call2'])) { echo $_POST['call2']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
                 <p style="font-weight: bold;">Loan Length</p>
                    <select name="loan2">
		<option value="0">--- Choose One ---</option>
        <option<?php if (isset($_POST['loan2']) && ($_POST['loan2'] == "electronic")) { echo " selected"; } ?> value="electronic">Electronic</option>
		<option<?php if (isset($_POST['loan2']) && ($_POST['loan2'] == "threehour")) { echo " selected"; } ?> value="threehour">3 hours</option>
		<option<?php if (isset($_POST['loan2']) && ($_POST['loan2'] == "oneday")) { echo " selected"; } ?> value="oneday">1 Day</option>
		<option<?php if (isset($_POST['loan2']) && ($_POST['loan2'] == "threeday")) { echo " selected"; } ?> value="threeday">3 Days</option>
		<option<?php if (isset($_POST['loan2']) && ($_POST['loan2'] == "sevenday")) { echo " selected"; } ?> value="sevenday">7 Days</option>
                    </select>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Students need by</p>

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
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "book")) { echo " selected"; } ?> value="book">Book</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "dvd")) { echo " selected"; } ?> value="dvd">DVD</option>
        <option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "vhs")) { echo " selected"; } ?> value="vhs">VHS</option>
		<option<?php if (isset($_POST['item3']) && ($_POST['item3'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

                    <textarea wrap="Virtual" cols="20" rows=1" name="call3"><?php if (isset ($_POST['call3'])) { echo $_POST['call3']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
                 <p style="font-weight: bold;">Loan Length</p>
                    <select name="loan3">
		<option value="0">--- Choose One ---</option>
        <option<?php if (isset($_POST['loan3']) && ($_POST['loan3'] == "electronic")) { echo " selected"; } ?> value="electronic">Electronic</option>
		<option<?php if (isset($_POST['loan3']) && ($_POST['loan3'] == "threehour")) { echo " selected"; } ?> value="threehour">3 hours</option>
		<option<?php if (isset($_POST['loan3']) && ($_POST['loan3'] == "oneday")) { echo " selected"; } ?> value="oneday">1 Day</option>
		<option<?php if (isset($_POST['loan3']) && ($_POST['loan3'] == "threeday")) { echo " selected"; } ?> value="threeday">3 Days</option>
		<option<?php if (isset($_POST['loan3']) && ($_POST['loan3'] == "sevenday")) { echo " selected"; } ?> value="sevenday">7 Days</option>
                    </select>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Students need by</p>

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
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "book")) { echo " selected"; } ?> value="book">Book</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "dvd")) { echo " selected"; } ?> value="dvd">DVD</option>
        <option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "vhs")) { echo " selected"; } ?> value="vhs">VHS</option>
		<option<?php if (isset($_POST['item4']) && ($_POST['item4'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

         <textarea wrap="Virtual" cols="20" rows=1" name="call4"><?php if (isset ($_POST['call4'])) { echo $_POST['call4']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
                 <p style="font-weight: bold;">Loan Length</p>
                    <select name="loan4">
		<option value="0">--- Choose One ---</option>
        <option<?php if (isset($_POST['loan4']) && ($_POST['loan4'] == "electronic")) { echo " selected"; } ?> value="electronic">Electronic</option>
		<option<?php if (isset($_POST['loan4']) && ($_POST['loan4'] == "threehour")) { echo " selected"; } ?> value="threehour">3 hours</option>
		<option<?php if (isset($_POST['loan4']) && ($_POST['loan4'] == "oneday")) { echo " selected"; } ?> value="oneday">1 Day</option>
		<option<?php if (isset($_POST['loan4']) && ($_POST['loan4'] == "threeday")) { echo " selected"; } ?> value="threeday">3 Days</option>
		<option<?php if (isset($_POST['loan4']) && ($_POST['loan4'] == "sevenday")) { echo " selected"; } ?> value="sevenday">7 Days</option>
                    </select>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Students need by</p>

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
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "book")) { echo " selected"; } ?> value="book">Book</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "article")) { echo " selected"; } ?> value="article">Article</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "chapter")) { echo " selected"; } ?> value="chapter">Chapter</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "dvd")) { echo " selected"; } ?> value="dvd">DVD</option>
        <option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "vhs")) { echo " selected"; } ?> value="vhs">VHS</option>
		<option<?php if (isset($_POST['item5']) && ($_POST['item5'] == "other")) { echo " selected"; } ?> value="other">Other</option>
                    </select>
          </td>

            <td width="25%" VALIGN="top">

                   <p style="font-weight: bold;">Call number</p>

         <textarea wrap="Virtual" cols="20" rows=1" name="call5"><?php if (isset ($_POST['call5'])) { echo $_POST['call5']; } ?></textarea>
          </td>
            <td width="25%" VALIGN="top">
                 <p style="font-weight: bold;">Loan Length</p>
                    <select name="loan5">
		<option value="0">--- Choose One ---</option>
        <option<?php if (isset($_POST['loan5']) && ($_POST['loan5'] == "electronic")) { echo " selected"; } ?> value="electronic">Electronic</option>
		<option<?php if (isset($_POST['loan5']) && ($_POST['loan5'] == "threehour")) { echo " selected"; } ?> value="threehour">3 hours</option>
		<option<?php if (isset($_POST['loan5']) && ($_POST['loan5'] == "oneday")) { echo " selected"; } ?> value="oneday">1 Day</option>
		<option<?php if (isset($_POST['loan5']) && ($_POST['loan5'] == "threeday")) { echo " selected"; } ?> value="threeday">3 Days</option>
		<option<?php if (isset($_POST['loan5']) && ($_POST['loan5'] == "sevenday")) { echo " selected"; } ?> value="sevenday">7 Days</option>
                    </select>
          </td>
            <td width="25%" VALIGN="top">
             <p style="font-weight: bold;">Students need by</p>

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
			&nbsp;I certify that the materials I am submitting to be placed on course reserve <?php echo $copyrightSites;?></p> 
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
