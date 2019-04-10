<?php
//check to see if error reporting is OFF N or Y ON
if ($errorReporting == "N"){
	// Turn off all error reporting
error_reporting(0);
}
else{
error_reporting(E_ALL);
ini_set('display_errors', 1);
}
?>
<!doctype html><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-gb"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en-gb"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en-gb"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8"><!--[if IE 9]><meta http-equiv="X-UA-Compatible" content="IE=edgeindex,chrome=IE8"><![endif]-->
      <title><?php echo $title; ?></title>

      <meta name="Description" content="<?php echo $description; ?>">

      <meta name="Keywords" content="<?php echo $keywords; ?>">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- Prompt IE 6/7/8 users to install Chrome Frame.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 9]><div class="chromeframe alert alert-error alert-floating"></div>
  <div class="alert alert-info alert-floating" data-original-title="alert alert-info alert-floating"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Welcome to the website of the University of Tennessee at Chattanooga.</strong> <p>Your web browser is outdated. For the best experience on this site,&nbsp; <a href="http://browsehappy.com/">upgrade to a modern browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</p> </div><![endif]-->
  <!-- compiling css via codekit from kickstrap.less & its imports -->
<!-- remove kickstrap
  <link rel="stylesheet" type="text/css" href="/includes/css/kickstrap.css" media="all">
-->
  <!-- Push HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="https://www.utc.edu/_resources/Kickstrap/apps/html5shiv/dist/html5shiv.js"></script>
  <style>a.side-menu-link{display:none}</style>
  <![endif]-->
<link rel="shortcut icon" href="/favicon.ico?v=2a" type="image/x-icon" />
<link rel="apple-touch-icon" href="/apple-touch-icon.png?v=2a" />
<!--
<link rel="stylesheet" type="text/css" href="https://www.utc.edu/includes/print.css">
-->
<!-- new css links for BS4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/solid.css" integrity="sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B" crossorigin="anonymous" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/fontawesome.css" integrity="sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="/includes/css/db-page-bootstrap.css" media="all">


<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
<script>(function(){"use strict";var c=[],f={},a,e,d,b;if(!window.jQuery){a=function(g){c.push(g)};f.ready=function(g){a(g)};e=window.jQuery=window.$=function(g){if(typeof g=="function"){a(g)}return f};window.checkJQ=function(){if(!d()){b=setTimeout(checkJQ,100)}};b=setTimeout(checkJQ,100);d=function(){if(window.jQuery!==e){clearTimeout(b);var g=c.shift();while(g){jQuery(g);g=c.shift()}b=f=a=e=d=window.checkJQ=null;return true}return false}}})();</script>
<meta name=”twitter:site” content=”@UTChattanooga”>
<script type="text/javascript">
            var page_id="//www.utc.edu/library/about/mission.php";
        </script>
		<style>
/* fix for random black background on sub menu */
.navbar .nav li.dropdown.active > .dropdown-toggle{
  background-color: transparent;
}
#dev-environment{
	display:none;
}
		</style>
		<?php echo $addhead; ?>
		</head>
   <!-- Body classes
================================================== -->
   <body class="utcms department simple">
<!-- Data Layer for Google Tag Manager -->
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TRJN3JP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TRJN3JP');</script>
<!-- End Google Tag Manager -->
<div id="dev-environment" class="alert alert-info" role="alert" style="padding: .25em;text-align: center;margin-bottom: 0px;">
            | <strong>STAGING</strong> environment | </div>
      <div id="skip"><a class="btn btn-success btn-large btn-block" tabindex="1" href="#content">Skip to Main Content</a></div>
      <div id="sf-wrapper">
         <!-- stickyfooter wrapper -->
         <!-- Top Menus & Logotype
================================================== -->
         <!-- Main Top Navigation, Scrolls with window
    ================================================== -->
         <div id="mainTopNav" class="navbar navbar-static-top navbar-inverse frontpage" role="navigation">
            <div class="navbar-inner"><a class="btn btn-navbar" data-toggle="collapse" data-target="#mainTopNav .nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a href="#" class="brand" data-toggle="collapse" data-target="#mainTopNav .nav-collapse">UTC.edu</a><div class="nav-collapse collapse">
<ul class="nav">
<li><a id="constituency-nav-students" href="//www.utc.edu/about/student-resources.php">Students</a></li>
<li><a id="constituency-nav-facultystaff" href="//www.utc.edu/about/faculty-staff-resources.php">Faculty&nbsp;&amp;&nbsp;Staff</a></li>
<li><a id="constituency-nav-alumni" href="//www.utc.edu/about/alumni-friends.php">Alumni</a></li>
<li><a id="constituency-nav-parents" href="//www.utc.edu/admissions/parents.php">Parents</a></li>
</ul>
                  <!-- Search form
                ================================================== -->
<!-- GSA Search Box Begins -->
<form class="form-search navbar-search" action="//www.utc.edu/search.php" method="post">
	<div class="input-append">
		<label for="q" class="hidden">Search:</label><input name="q" id="q" type="text" class="input span2 search-query" placeholder="Search&hellip;"><button type="submit" value="Go Search" aria-label="Go Search" class="btn btn-inverse"><i class="icon-search"><!-- icon --></i></button>
	</div>
</form>
                  <!-- Extreme right top menu items, priority
                ================================================== -->
<ul class="nav pull-right">
<li><a id="top-nav-schedule" href="https://ssb.utc.edu/cbanpr/zzckschd.p_disp_dyn_sched/" target="ssb">Class Schedule&nbsp;<i class="icon-small icon-external-link"><!-- External Link --></i></a></li>
<li><a id="top-nav-my" href="//www.utc.edu/my/index.php" target="myMocsNet">My MocsNet&nbsp;<i class="icon-small icon-external-link"><!-- External Link --></i></a></li>
<li><a id="top-nav-utconline" href="//www.utc.edu/learn/">UTC Learn&nbsp;<i class="icon-globe icon-large"><!-- globe --></i></a></li>
</ul>
<!-- Middle right top menu items, hidden mid/small
================================================== -->
<ul class="nav pull-right superfluous">
<li aria-label="UTC Home Page"><a id="top-nav-home" title="UTC Home Page" alt="UTC Home Page" href="//www.utc.edu/"><i class="icon-home icon-large"><span class="hidden">UTC Home</span></i></a></li>
<li><a id="top-nav-apply" href="//www.utc.edu/apply/">Apply</a></li>
</ul>
               </div>
            </div>
         </div>
         <!-- Logotype, .header-image gets inline style for background image, uploaded by user
    ================================================== -->
         <div class="utc-logo row">
            <div class="utc-logo-inner">

                  <div id="header-text" class="pull-left">
                     <h1><a href="//www.utc.edu/">
					 <img src="/includes/img/utc-lettertype-logo-small.png" alt="UTC wordmark"></a></h1>
                     <h2><a href="//www.utc.edu/library/">UTC Library</a></h2>
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
                       <li><a href="//www.utc.edu/library/index.php">Library Home</a></li>
                       <li><a id="lib-menu-collections" href="//www.utc.edu/library/collections/">Collections</a></li>
                       <li><a id="lib-menu-help" href="//www.utc.edu/library/help/" >Research Help</a></li>
                       <li><a id="lib-menu-services" href="//www.utc.edu/library/services/">Services</a></li>
                       <li><a id="lib-menu-about" href="//www.utc.edu/library/about/">About</a></li>
                     </ul>
<?php
include($_SERVER['DOCUMENT_ROOT']."/scripts/hours.php");
?>
                  </div>
               </div>
            </div>
         </div>
<div class="container">
