<!DOCTYPE html>
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
</head>
<body>
<?php
$head_img_plus_attrib_array = array (
array('img/home-bg.jpg','<div xmlns:dc="http://purl.org/dc/terms/" xmlns:cc"http://creativecommons.org/#ns" about="https://www.flickr.com/photos/bryce_edwards/2094119137/in/photolist-4c3UEn-iGAvHM-a4yY5-5ceSmo-bvAsby-9FMJ7f-8hixP9-7FAGAX-9sVZKj-s4ifjh-fNGvu7-5kiasg-5camYZ-Fo4b-qBmzN1-fPW2B3-5carEK-5Ngcq8-5ceSms-keUkV-PCZVQ-PPz6t-4Mf2HK-ocsX5a-85wEqq-8hirgG-cwFfB3-duRJzW-gAHj5-hLq1wh-Cs5bsW-dCQ35k-jRHX66-vCGKAb-8gQ23B-aT1BbT-ow62Ch-8iPrCN-dyM11E-osaA9a-e8TdLj-9sVZio-aEsPJf-aEsH25-aEoQqn-aEoUNK-aEp3Nk-9Z5yKP-8htDfw-4sxbcr"><span property="dct:title">John Ross Bridge | Flickr - Photo Sharing! | </span><a rel="cc:attributionName" href="undefined" target="_blank"> Bryce Edwards</a> | <a rel="license" target="_blank" href="https://creativecommons.org/licenses/by/2.0/"> Attribution 2.0 Generic /  CC BY 2.0 </a>
  </div>'),
array('img/home-bg2.jpg','"Tennessee Aquarium in downtown Chattanooga" image courtesy of <a href="http://www.chattanoogafun.com/">Chattanooga Convention & Visitors Bureau</a>'),
array('img/home-bg3.jpg','<div xmlns:dc="http://purl.org/dc/terms/" xmlns:cc"http://creativecommons.org/#ns" about="https://www.flickr.com/photos/zackzen/3148950971/in/photolist-5Ngcq8-Tp98h-eMfs9-ejGvvf-aT1HHc-oipJZX-9sVZKj-s4ifjh-fNGvu7-Fo4b-qBmzN1-fPW2B3-5ceSms-keUkV-ocsX5a-8hirgG-gAHj5-hLq1wh-Cs5bsW-jRHX66-vCGKAb-8gQ23B-ow62Ch-8iPrCN-dyM11E-e8TdLj-PCZVQ-PPz6t-4Mf2HK-85wEqq-cwFfB3-duRJzW-dCQ35k-oibYJJ-aT1BbT-osaA9a-9sVZio-9Z5yKP-ebYPad-djHb9V-djH6do-6qvFjm-7xLaGY-9iCFf-5kiaA4-8hixt1-4c7QJQ-9qa1j-fNGs1A-67ktBv"><span property="dct:title">crepuscular carousel | Flickr - Photo Sharing!</span><a rel="cc:attributionName" href="undefined" target="_blank">zackzen</a><a rel="license" target="_blank" href="https://creativecommons.org/licenses/by-sa/2.0/"> Attribution-ShareAlike 2.0 Generic /  CC BY-SA 2.0 </a></div>'),
array('img/home-bg4.jpg','"Ruth Holmberg Glass-Bottom Bridge" image courtesy of <a href="http://www.chattanoogafun.com/">Chattanooga Convention & Visitors Bureau</a>'),
array('img/home-bg5.jpg','"Coolidge Park\'s interactive water fountain" image courtesy of <a href="http://www.chattanoogafun.com/">Chattanooga Convention & Visitors Bureau</a>'),
array('img/home-bg6.jpg','<div xmlns:dc="http://purl.org/dc/terms/" xmlns:cc"http://creativecommons.org/#ns" about="https://www.flickr.com/photos/91829349@N00/5422668472/in/photolist-9gbAq1-hvbMLR-grydJP-xwwC1z-k2b2v-5kiaGB-7uTA1F-dYq2v4-8NDLYv-nKoRt1-5yYAEi-FkxTc-db2QsH-og3eQW-bvAqpQ-dCkVCL-cde2z-5kiasR-bzDaV-gHSpmY-qqvFW2-5kiap8-7SQf-sCJ2B2-dmd6he-R6Xf-5knsbY-97ZHam-euKWKY-FkpBJ-9FJSDi-4Tns81-5kiarH-qqQVb6-qF14w9-21JyVp-ATiiBU-Xzbus-fFWCZ-pLvRnK-cwFbSU-9FJVRv-9xqqU-pw2z6Y-aFmpu6-9x4dui-nKxcbJ-onA6bc-gHSoWj-wzEwkP"><span property="dct:title">Moccasin Bend and Chattanooga | Flickr - Photo Sharing!</span><a rel="cc:attributionName" href="undefined" target="_blank">rjones0856</a><a rel="license" target="_blank" href="https://creativecommons.org/licenses/by/2.0/"> Attribution 2.0 Generic /  CC BY 2.0 </a></div>'),
array('img/home-bg7.jpg','<div xmlns:dc="http://purl.org/dc/terms/" xmlns:cc"http://creativecommons.org/#ns" about="https://www.flickr.com/photos/klobetime/2832845959/in/photolist-5jk5pH-eMfs9-ejGvvf-aT1HHc-oipJZX-4c3UEn-iGAvHM-a4yY5-5ceSmo-bvAsby-9FMJ7f-8hixP9-7FAGAX-9sVZKj-s4ifjh-fNGvu7-5kiasg-5camYZ-Fo4b-qBmzN1-fPW2B3-5carEK-5Ngcq8-5ceSms-keUkV-PCZVQ-PPz6t-4Mf2HK-ocsX5a-85wEqq-8hirgG-cwFfB3-duRJzW-gAHj5-hLq1wh-Cs5bsW-dCQ35k-jRHX66-oibYJJ-vCGKAb-8gQ23B-aT1BbT-ow62Ch-8iPrCN-dyM11E-osaA9a-e8TdLj-9sVZio-aEoQqn-aEsH25"><span property="dct:title">Chattanooga | Flickr - Photo Sharing!</span><a rel="cc:attributionName" href="undefined" target="_blank">Klobetime</a><a rel="license" target="_blank" href="https://creativecommons.org/licenses/by-sa/2.0/"> Attribution-ShareAlike 2.0 Generic /  CC BY-SA 2.0 </a></div>'),
array('img/home-bg8.jpg','"Flying Squirrel" image courtesy of <a href="http://www.chattanoogafun.com/">Chattanooga Convention & Visitors Bureau</a>'),
array('img/home-bg9.jpg','"Rock City Gardens Lover\'s Leap and flag court" image courtesy of <a href="http://www.chattanoogafun.com/">Chattanooga Convention & Visitors Bureau</a>')
);
$section = array_rand($head_img_plus_attrib_array);
echo '<header class="intro-header" style="background-image: url('.$head_img_plus_attrib_array[$section][0].')">';
?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Chattanooga 2017</h1>
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
$replace_map = "<div id='insertmap' style='overflow:hidden;width:95%;padding-left:5%;'>
<iframe src='https://www.google.com/maps/d/embed?mid=zOu4AK4RRr84.kKmAEy6BqIU0' width='95%' height='480'></iframe>
</div>";
$raw = getGoogleDoc($doc_id);
$display = strstr($raw, '<h1 class=');
$add_map = str_replace($map_placeholder, $replace_map, $display);
print $add_map;
?>
</div>
</div>
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
<li>
  <?php
echo $head_img_plus_attrib_array[$section][1];
   ?>
</li>
                    </ul>

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

    <script>
$(document).ready(function() {
      $("span:contains('https://www.google.com/maps/d/edit?mid=zOu4AK4RRr84.kKmAEy6BqIU0&usp=sharing')").hide();
});
</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.js"></script>

</body>
</html>
