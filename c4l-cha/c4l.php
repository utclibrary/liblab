<!DOCTYPE html>
<?php // Report all errors
error_reporting(E_ALL);
?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Code4Lib - Chattanooga</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/clean-blog.css" rel="stylesheet">
    <link href="css/chatype.css" type="text/css" rel="stylesheet" charset="utf-8" />
    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Navigation -->
<!--
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
-->
            <!-- Brand and toggle get grouped for better mobile display -->
<!--
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/c4l-cha/">Chattanooga 2017 | Code4lib National Conference Proposal</a>
            </div>
-->
            <!-- Collect the nav links, forms, and other content for toggling -->
<!--
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="post.html">Sample Post</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>

            </div>
-->
            <!-- /.navbar-collapse -->
<!--
        </div>
-->
        <!-- /.container -->
<!--
    </nav>
-->
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Chattanooga 2017ish</h1>
                        <hr class="small">
                        <span class="subheading">Code4lib National Conference Proposal</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container" id="c4l">
      <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">

<?php
include('get-doc.php');
// https://docs.google.com/document/d/______________/pub
$doc_id = "1y3n7K_r5rA6JH_ZPfycd3bAz-rtfsQrovN0zeKvgjdI";
$map_placeholder = "<span>Google Map of Potential Places (feel free to edit &amp; add):</span>";
$replace_map = "<div style='overflow:hidden;width:95%;padding-left:5%;'>
<iframe src='https://www.google.com/maps/d/embed?mid=zOu4AK4RRr84.kKmAEy6BqIU0' width='95%' height='480'></iframe>
</div>";
$raw = getGoogleDoc($doc_id);
$display = strstr($raw, '<h1 class=');
$add_map = str_replace($map_placeholder, $replace_map, $display);
print $add_map;
?>
</div></div>
<hr />

  <!-- Footer -->
    <footer>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
<li><a href="http://chatype.com/">Chattanooga, a type unto ourselves</a></li>
<hr/>
<li><div xmlns:dc="http://purl.org/dc/terms/" xmlns:cc"http://creativecommons.org/#ns" about="https://www.flickr.com/photos/bryce_edwards/2094119137/in/photolist-4c3UEn-iGAvHM-a4yY5-5ceSmo-bvAsby-9FMJ7f-8hixP9-7FAGAX-9sVZKj-s4ifjh-fNGvu7-5kiasg-5camYZ-Fo4b-qBmzN1-fPW2B3-5carEK-5Ngcq8-5ceSms-keUkV-PCZVQ-PPz6t-4Mf2HK-ocsX5a-85wEqq-8hirgG-cwFfB3-duRJzW-gAHj5-hLq1wh-Cs5bsW-dCQ35k-jRHX66-vCGKAb-8gQ23B-aT1BbT-ow62Ch-8iPrCN-dyM11E-osaA9a-e8TdLj-9sVZio-aEsPJf-aEsH25-aEoQqn-aEoUNK-aEp3Nk-9Z5yKP-8htDfw-4sxbcr"><span property="dct:title">John Ross Bridge | Flickr - Photo Sharing! | </span><a rel="cc:attributionName" href="undefined" target="_blank">Bryce Edwards</a> | <a rel="license" target="_blank" href="https://creativecommons.org/licenses/by/2.0/"> Attribution 2.0 Generic /  CC BY 2.0 </a></div>
</li>
                    </ul>
                    <!--
                    <p class="copyright text-muted">Copyright &copy; Your Website 2014</p>
                  -->
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script>
$(document).ready(function() {
      $("span:contains('https://www.google.com/maps/d/edit?mid=zOu4AK4RRr84.kKmAEy6BqIU0&usp=sharing')").hide();
});
</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>
</html>
