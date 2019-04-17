<?php
//check to see if error reporting is OFF N or Y ON
if ($errorReporting === "Y"){
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}else{
  error_reporting(0);
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
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<!--
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
-->
      <!-- Prompt IE 6/7/8 users to install Chrome Frame.
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
            <a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>
      <div id="sf-wrapper">
         <!-- stickyfooter wrapper -->
         <!-- Top Menus & Logotype
================================================== -->
         <!-- Main Top Navigation, Scrolls with window
    ================================================== -->
    <nav class="navbar navbar-expand-lg navbarUtc">
      <a class="navbar-brand" href="#">UTC.edu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarUTC" aria-controls="navbarUTC" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarUTC">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/about/student-resources.php">Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/about/faculty-staff-resources.php">Faculty&nbsp;&amp;&nbsp;Staff</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/about/alumni-friends.php">Alumni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/admissions/parents.php">Parents</a>
          </li>
        </ul>
        <form class="form-inline ouSearch my-lg-0" action="https://www.utc.edu/search.php" method="post">
          <div class="input-group" role="search" aria-label="Search Form">
            <label for="q" class="hidden sr-only" aria-label="Search">Search:</label>
            <input name="q" id="q" type="text" class="form-control input search-query" placeholder="Search&hellip;" aria-label="Search Input">
            <div class="input-group-append">
              <button class="btn btnUtcSearch" type="submit" value="Go Search" aria-label="Go Search"><span class="fas fa-search">
                  <!-- icon --></span><span class="sr-only">&nbsp;Search</span></button>
            </div>
          </div>
        </form>
        <ul class="navbar-nav ml-auto flex-column-reverse flex-lg-row">
          <li class="nav-item utcHome">
            <a class="nav-link" href="https://www.utc.edu/"><span class="fas fa-home"><span class="sr-only">UTC Home</span></span></a>
          </li>
          <li class="nav-item">
            <a id="top-nav-apply" class="nav-link" href="https://www.utc.edu/apply/">Apply</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/records/registration-information/class-schedule.php"><span class="menu-hide">Class </span>Schedule&nbsp;<span class="fas fa-external-link-alt fa-xs" aria-hidden="true">
                <!-- External Link --></span><span class="sr-only">Link opens in new window</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/my/index.php target=" _blank"" target="_blank"><span class="menu-hide">My </span>MocsNet&nbsp;<span class="fas fa-external-link-alt fa-xs"></span><span class="sr-only">Link opens in new
                window</span><!-- External Link --></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/learn/"><span class="menu-hide">UTC </span>Learn&nbsp;<span class="fas fa-globe-americas" aria-hidden="true">
                <!-- globe --></span></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col blueHeader">

          <a href="https://utc.edu/">
            <img src="https://utc.edu/_resources/img/web-wordmark-retina.png" alt="UTC wordmark">
          </a>
          <h1><a href="https://www.utc.edu/library/">UTC Library</a></h1>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbarLib">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav navbarLibMain">
          <li class="nav-item ml-lg-4">
            <a class="nav-link" href="https://www.utc.edu/library">Library Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/library/collections">Collections</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/library/help">Research Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/library/collections">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.utc.edu/library/collections">About</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item order-lg-1">
            <a class="nav-link account" href="https://www.utc.edu/library/services/accounts.php" title="Library Accounts">
              <span class="fas fa-user-circle"></span>
              <span class="d-lg-none">&nbsp;Library Accounts</span>
            </a>
          </li>
          <li id="libHours" class="nav-item order-lg-0">
            <a class="nav-link" href="https://www.utc.edu/library/about/hours.php"><span class="fas fa-clock"></span>&nbsp;Today's Hours:
              <?php
            include($_SERVER['DOCUMENT_ROOT']."/scripts/hours-v2.php");
            ?>
          </a>
          </li>
        </ul>
      </div>
    </nav>


<div id="content" class="container">
