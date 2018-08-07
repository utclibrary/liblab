<!doctype html><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-gb"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en-gb"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-gb"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en-gb"><!--<![endif]-->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8"><!--[if IE 9]><meta http-equiv="X-UA-Compatible" content="IE=edgeindex,chrome=IE8"><![endif]-->
      <title>Library Walkthrough | UTC Library</title>
      	<!-- <script type="text/javascript" src="form-validate-reserves.js"></script> -->

      <meta name="Description" content="Description">

      <meta name="Keywords" content="Some keywords here">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- Prompt IE 6/7/8 users to install Chrome Frame.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 9]><div class="chromeframe alert alert-error alert-floating"></div>
  <div class="alert alert-info alert-floating" data-original-title="alert alert-info alert-floating"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Welcome to the website of the University of Tennessee at Chattanooga.</strong> <p>Your web browser is outdated. For the best experience on this site,&nbsp; <a href="http://browsehappy.com/">upgrade to a modern browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</p> </div><![endif]-->
  <!-- compiling css via codekit from kickstrap.less & its imports -->
  <link rel="stylesheet" type="text/css" href="http://www.utc.edu/_resources/css/kickstrap.css?ver=2.3.2.1" media="all">
  <!-- Push HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://www.utc.edu/_resources/Kickstrap/apps/html5shiv/dist/html5shiv.js"></script>
  <style>a.side-menu-link{display:none}</style>
  <![endif]-->
<link rel="shortcut icon" type="image/x-icon" href="http://www.utc.edu/favicon.ico">
<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
<meta name="twitter:site" content="@UTChattanooga">
<script type="text/javascript">
            var page_id="http://www5.lib.utc.edu/forms/form-scanning.php";
        </script></head>
   <!-- Body classes
================================================== -->
   <body class="utcms department simple">
      <div id="skip"><a class="btn btn-success btn-large btn-block" tabindex="1" href="#content">Skip to Main Content</a></div>
      <div id="sf-wrapper">
         <!-- stickyfooter wrapper -->
         <!-- Top Menus & Logotype
================================================== -->
         <!-- Main Top Navigation, Scrolls with window
    ================================================== -->
         <div id="mainTopNav" class="navbar navbar-static-top navbar-inverse frontpage" role="navigation">
            <div class="navbar-inner"><a class="btn btn-navbar" data-toggle="collapse" data-target="#mainTopNav .nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="http://www.utc.edu/" class="brand" data-toggle="collapse" data-target="#mainTopNav .nav-collapse">UTC.edu</a><div class="nav-collapse collapse">
<ul class="nav">
<li><a id="constituency-nav-students" href="http://www.utc.edu/about/student-resources.php">Students</a></li>
<li><a id="constituency-nav-facultystaff" href="http://www.utc.edu/about/faculty-staff-resources.php">Faculty&nbsp;&amp;&nbsp;Staff</a></li>
<li><a id="constituency-nav-alumni" href="http://www.utc.edu/about/alumni-friends.php">Alumni</a></li>
<li><a id="constituency-nav-parents" href="http://www.utc.edu/admissions/parents.php">Parents</a></li>
</ul>
                  <!-- Search form
                ================================================== -->
<!-- GSA Search Box Begins -->
<form class="form-search navbar-search" action="http://www.utc.edu/search.php" method="post">
	<div class="input-append">
		<label for="q" class="hidden">Search:</label><input name="q" id="q" type="text" class="input span2 search-query" placeholder="Search&hellip;"><button type="submit" value="Go Search" aria-label="Go Search" class="btn btn-inverse"><i class="icon-search"><!-- icon --></i></button>
	</div>
</form>
                  <!-- Extreme right top menu items, priority
                ================================================== -->
<ul class="nav pull-right">
<li><a id="top-nav-schedule" href="https://ssb.utc.edu/cbanpr/zzckschd.p_disp_dyn_sched/" target="ssb">Class Schedule&nbsp;<i class="icon-small icon-external-link"><!-- External Link --></i></a></li>
<li><a id="top-nav-my" title="" href="https://my.utc.edu/" target="myMocsNet">My MocsNet&nbsp;<i class="icon-small icon-external-link"><!-- External Link --></i></a></li>
<li><a id="top-nav-utconline" href="http://www.utc.edu/learn/">UTC Learn&nbsp;<i class="icon-globe icon-large"><!-- globe --></i></a></li>
</ul>
<!-- Middle right top menu items, hidden mid/small
================================================== -->
<ul class="nav pull-right superfluous">
<li aria-label="UTC Home Page"><a id="top-nav-home" href="http://www.utc.edu/"><i class="icon-home icon-large"><span class="hidden">UTC Home</span></i></a></li>
<li><a id="top-nav-apply" href="http://www.utc.edu/apply/">Apply</a></li>
</ul>
               </div>
            </div>
         </div>
         <!-- Logotype, .header-image gets inline style for background image, uploaded by user
    ================================================== -->
         <div class="utc-logo row">
            <div class="utc-logo-inner">
               <div class="container header-image" style="background-image:url('http://www.utc.edu/library/images/mastheads/information-commons.jpg');">
                  <div id="header-text" class="pull-left"><a href="http://www.utc.edu"><img src="http://www.utc.edu/_resources/img/utc-lettertype-logo-small.png" alt="UTC wordmark"></a><h2><a href="http://www.utc.edu/library/">UTC Library</a></h2>
                  </div>
               </div>
            </div>
         </div>
         <!-- Secondary Navigation
    ================================================== -->
         <div id="secondaryTopNav" role="navigation" class="navbar frontpage department">
            <div class="navbar-inner">
               <div class="squeezer container"><a class="btn btn-navbar" data-toggle="collapse" data-target="#secondaryTopNav .nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="#" class="brand" data-toggle="collapse" data-target="#secondaryTopNav .nav-collapse">Menu</a><div class="nav-collapse collapse">
                     <ul class="nav">

                        <li><a href="http://www.utc.edu/library/index.php">Home</a></li>

                        <li class="dropdown"><a id="lib-menu-collections" class="dropdown-toggle" href="#" data-toggle="dropdown">Collections<strong class="caret">
                                 <!--icon--></strong></a>

                           <ul class="dropdown-menu">

                              <li><a href="http://www.utc.edu/library/collections/index.php">Search Library Resources</a></li>

                              <li><a id="lib-menu-media" href="http://guides.lib.utc.edu/audio-video" target="_blank">DVDs and Videos</a></li>

                              <li><a id="lib-menu-ebooks" href="http://guides.lib.utc.edu/ebooks" target="_blank">eBooks</a></li>

                              <li><a id="lib-menu-theses" href="http://guides.lib.utc.edu/theses" target="_blank">Theses and Dissertations</a></li>

                              <li><a href="http://www.utc.edu/library/special-collections/index.php">Special Collections and University Archives</a></li>

                              <li><a href="http://www.utc.edu/library/collections/">--- more ---</a></li>

                           </ul>

                        </li>

                        <li class="dropdown"><a id="lib-menu-help" class="dropdown-toggle" href="#" data-toggle="dropdown">Research Help<strong class="caret">
                                 <!--icon--></strong></a>

                           <ul class="dropdown-menu">

                              <li><a href="http://www.utc.edu/library/help/index.php">Ask A Librarian</a></li>

                              <li><a href="http://www.utc.edu/library/services/students/research-appointments.php">Research Appointments</a></li>

                              <li><a href="http://www.utc.edu/library/help/tutorials/index.php">Tutorials</a></li>

                              <li><a id="lib-menu-guides" href="http://guides.lib.utc.edu/eresources" target="_blank">Subject Guides</a></li>

                              <li><a id="lib-menu-citing" href="http://guides.lib.utc.edu/content.php?pid=98364&amp;sid=737677" target="_blank">Citing Sources</a></li>

                              <li><a href="http://www.utc.edu/library/help/endnote.php">EndNote</a></li>

                              <li><a href="http://www.utc.edu/library/help/">--- more ---</a></li>

                           </ul>

                        </li>

                        <li class="dropdown"><a id="lib-menu-services" class="dropdown-toggle" href="#" data-toggle="dropdown">Services<strong class="caret">
                                 <!--icon--></strong></a>

                           <ul class="dropdown-menu">

                              <li><a href="http://www.utc.edu/library/services/check-out-renew.php">Check Out and Renew</a></li>

                              <li><a href="http://www.utc.edu/library/services/interlibrary-loan.php">Interlibrary Loan</a></li>

                              <li><a href="http://www.utc.edu/library/services/workshops.php">Workshops</a></li>

                              <li><a href="http://www.utc.edu/library/services/students/">Student Services</a></li>

                              <li><a href="http://www.utc.edu/library/services/faculty-staff/">Faculty and Staff Services</a></li>

                              <li><a href="http://www.utc.edu/library/services/alumni-visitors/">Alumni and Visitor Services</a></li>

                              <li><a href="http://www.utc.edu/library/services/">--- more ---</a></li>

                           </ul>

                        </li>

                        <li class="dropdown"><a id="lib-menu-about" class="dropdown-toggle" href="#" data-toggle="dropdown">About<strong class="caret">
                                 <!--icon--></strong></a>

                           <ul class="dropdown-menu">

                              <li><a href="http://www.utc.edu/library/about/hours.php">Hours</a></li>

                              <li><a href="http://www.utc.edu/library/about/maps.php">Maps</a></li>

                              <li><a href="http://www.utc.edu/library/about/forms-policies.php">Forms and Policies</a></li>

                              <li><a href="http://www.utc.edu/library/about/contact.php">Contact Us</a></li>

                              <li><a href="http://www.utc.edu/library/about/jobs/index.php">Jobs</a></li>

                              <li><a href="http://www.utc.edu/library/profiles/">Directory</a></li>

                              <li><a href="http://www.utc.edu/library/about/">--- more ---</a></li>

                           </ul>

                        </li>

                     </ul>
                     <ul class="nav pull-right"><style>
	a.libhours:link {color:#FFFFFF; text-decoration:none;}    /* unvisited link */
	a.libhours:visited {color:#FFFFFF; text-decoration:none;} /* visited link */
	a.libhours:hover {color:#B8B8B8; text-decoration:none;}   /* mouse over link */
	a.libhours:active {color:#FFFFFF; text-decoration:none;}  /* selected link */
</style>

<div class='pull-right'><?php

echo file_get_contents('http://www5.lib.utc.edu/scripts/Hours/');

?></div><br/>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="container"><a href="#menu" class="side-menu-link btn btn-mini btn-inverse">Section Menu <i class="icon-reorder"></i></a>
            <!-- Breadcrumbs
    ================================================== --><ul class="breadcrumb" data-original-title="breadcrumb"></ul>
            <div id="wrap" class="row-fluid wrap">
               <!--full-width page has no navigation-->
               <div id="content" class="span12 content">
                  <p>
		<?php
		date_default_timezone_set('America/New_York');
		$todaystamp = time();
		$today = date('l, n/j/y, g:ia',$todaystamp);
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
		        $email = "libbuilding@utc.edu";
                $headers = "FROM:".$email;
		        $body = "UTC Library Building Walk Through\n\n".
		        "Date: " . $today . "\n\n" .
                "Is Everything Ok?\n".$_POST['ok']."\n\n".
				"Building Maintenance Issues?\n";
				if (empty($_POST['building'])) $body .= "No new issues to report.\n\n";
				else $body .= $_POST['building']."\n\n";
				$body .= "Cleaning Issues?\n";
				if (empty($_POST['cleaning'])) $body .= "No new issues to report.\n\n";
				else $body .= $_POST['cleaning']."\n\n";
				$body .= "Security Issues?\n";
				if (empty($_POST['security'])) $body .= "No new issues to report.\n\n";
				else $body .= $_POST['security']."\n\n";
				$body .= "IT Issues?\n";
				if (empty($_POST['it'])) $body .= "No new issues to report.\n\n";
				else $body .= $_POST['it']."\n\n";
				$body .= "Other Issues?\n";
				if (empty($_POST['other'])) $body .= "No new issues to report.\n\n";
				else $body .= $_POST['other']."\n";

                $recipients = "libbuilding@utc.edu";
		    mail($recipients, "UTC Library Building Walkthrough: ".$_POST['ok'],$body,$headers);
		    echo "<h1>The form has been submitted.</h1><p>Return to the <a href='http://www5.lib.utc.edu/forms/form-bldg-new.php'>Library Walkthrough</a> page or the <a href='http://www.utc.edu/library/'>Library Home</a> page.</body></html>";
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
       <?php if (isset($error)) { echo "<span class='error'>Stop Spam, Read Books: your entry did not match the image.</span>"; } ?>
	    <form action="" method="post" onSubmit="return checkWholeForm(this);" />
		    <div class="form-group">
		        <legend>Walkthrough</legend>
		        <label for="ok">OK!</label>
		        <input type="radio" name="ok" value="ok" />
				<label for="not_ok">Not OK.</label>
				<input type="radio" name="ok" value="Not ok" />
			</div>
            <div class="form-group">
            	<legend>Not OK</legend>
                <label for="building">Building Maintenance Issues (Plumbing, Heat/Air, Elevators, Door operation)</label>
		        <textarea rows="8" name="building"><?php if (isset ($_POST['building'])) { echo $_POST['building']; } ?></textarea>
		        <label for="cleaning">Cleaning Issues (Spills, Restroom Supplies, Areas Needing Attention)</label>
		        <textarea rows="8" name="cleaning"><?php if (isset ($_POST['cleaning'])) { echo $_POST['cleaning']; } ?></textarea>
		        <label for="security">Security Issues  (Doors open, Patrons found inside building, Swipes not working)</label>
		        <textarea rows="8" name="security"><?php if (isset ($_POST['security'])) { echo $_POST['security']; } ?></textarea>
		        <label for="it">IT Issues (Computers, LCDs, Printers)</label>
		        <textarea rows="8" name="it"><?php if (isset ($_POST['it'])) { echo $_POST['it']; } ?></textarea>
		        <label for="other">Other Issues (Anything else out of the ordinary / worth reporting)</label>
		        <textarea rows="8" name="other"><?php if (isset ($_POST['other'])) { echo $_POST['other']; } ?></textarea>
		    </div>
			<div>
		        <legend>Stop Spam, Read Books</legend>
                <p>Please enter the words you see in the box below, in order and separated by a space. Doing so helps prevent automated programs from abusing this service.</p>
    		    <?php echo recaptcha_get_html($publickey, $error); ?>
    		</div>
    		<input type="hidden" name="submit" value="true"/>
    		<button class="btn btn-default" type="submit">Submit</button>
	    </form>
        </div>
        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
        </script>
        <script type="text/javascript">
        _uacct = "UA-1265795-1";
        _udn="lib.utc.edu";
        urchinTracker();
        </script>
 </p>
               </div>
               <!--/span12 column-->
            </div>
            <!--/row-fluid-->
         </div>
         <!-- /container -->
         <div id="push">
            <!-- pushes footer down -->
         </div>
      </div>
      <!-- /stickyfooter wrapper -->
      <!-- Footer with (map) navs, fine print and document close
================================================== -->
      <footer class="achieve-2">
         <div class="container">
            <div class="row">
               <div class="span12">
                  <h3 class="center">UTC Library</h3>
               </div>
            </div>
            <div class="row">
               <div class="span12">
                  <p class="achieve pushup center">
                  	  UTC Library
                     &nbsp;|&nbsp;
                  	  Dept.&nbsp;6456
                     &nbsp;|&nbsp;
                      600 Douglas Street
                     &nbsp;|&nbsp;
                      Chattanooga, TN 37403
                     &nbsp;|&nbsp;
                     (423) 425-4501 (p)
                     &nbsp;|&nbsp;
                     <a href="http://www.utc.edu/library/about/contact.php">Contact Us</a></p>
               </div>
            </div>
         </div><div class="container">
<div class="row">
<div class="span12">
<p class="fineprint"><a id="legal-questions" href="http://www.utc.edu/about/contact/">Questions?</a> <span id="directedit">©</span>&nbsp;2012-2014 The University of Tennessee at Chattanooga. All rights reserved. <a id="legal-eeo" href="http://www.utc.edu/university-relations/editorial-guidelines/eeo.php">EEO Statement</a>. <a id="legal-privacy" href="http://www.utc.edu/about/privacy.php">Privacy Statement</a>.</p>
<p class="fineprint">A Carnegie engaged, metropolitan campus of the <a id="legal-ut" href="http://www.tennessee.edu/" target="_blank">University of Tennessee System</a></p>
<p class="fineprint">and partner in the <a id="global-footer-nav1-transfers" href="http://www.tntransferpathway.org/" target="_blank"><img style="margin-top: -10px;" src="http://www.utc.edu/images/tn-transfer-pathway-logo.png" alt="Tennessee Transfer Pathway logo" width="172" height="34" /></a></p>
</div>
</div>
</div>
      </footer>
      <!-- document close
================================================== --><!-- FOOTER - jQuery 1.8 series for OU LDP compatibility -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- Common Bootstrap Scripts for all pages -->
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<!-- Fit Text plugin for big hero-unit -->
<script type="text/javascript" src="http://www.utc.edu/_resources/Kickstrap/apps/fittext/jquery.fittext.js?ver=1.0"></script>
<!-- Image Zoom plugin -->
<script type="text/javascript" src="http://www.utc.edu/_resources/Kickstrap/apps/zoom/jquery.zoom.js"></script>
<!-- Document Ready scripts for all pages -->
<script type="text/javascript" src="http://www.utc.edu/_resources/Kickstrap/apps/thememain/main.js?ver=3.2.5"></script>
<script type="text/javascript" src="http://www.utc.edu/_resources/js/directedit.js"></script><a id="de" href="http://www.omniupdate.com/oucampus/de.jsp?user=UTC&amp;site=Main&amp;path=%2Flibrary%2Fprivate%2Fblank.pcf" >&copy;</a></body>
</html>
