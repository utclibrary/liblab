<?php
//show errors Y or N - Yes|No
$errorReporting  = Y;
//template system to replicate main website look and feel
$title = "LibLab template | UTC Library";
$description = "description goes rychere";
$keywords = "this, that, & the other keywords";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="NO";
//in case you need to add anything in the head or footer
$addhead = "";
$addfoot = "";
//show or hide help button
$help = "show";
//show nav menu - left navigation menu Y or N
$navmenu = "N";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the $rightmenu var
*/
$rightmenu = 3;
include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");
?>
<!-- Insert content here BEGIN -->
<h1>Template Content!</h1>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque fermentum enim eu suscipit viverra. Morbi a metus ac est eleifend eleifend vel et ante. Donec ut justo mi. Curabitur sed quam eu velit maximus porttitor nec eu tellus. Morbi vel tortor dictum, molestie ante id, bibendum augue. Aenean pretium id augue ac vestibulum. Aliquam laoreet luctus risus, ut varius felis facilisis quis. Proin rhoncus elit luctus sapien laoreet, eget commodo arcu maximus. Praesent malesuada posuere nulla, sit amet ultricies nisl placerat ut. Maecenas mollis, neque at faucibus ornare, lorem ipsum pretium orci, porta ullamcorper nisl lectus hendrerit mi. Aenean volutpat, metus in facilisis dignissim, tellus massa convallis massa, sed lacinia sem sem et enim. Integer euismod vehicula mattis. Sed varius libero eros, id placerat eros imperdiet vitae.
</p>
<img src="https://placehold.it/720x480"/>
 <!-- Insert content here END -->
 <?php
//this is where the content goes for the right menu could also use
 if ($rightmenu==3){?>
 </div> <!-- close content div -->
 <div class="span3 sidebar" style="float: right;margin-left: 0;">
 <div class="sidebar well">
<h2 class="welltopperGold" style="font-size: 24px;">Need More Help?</h2>
<h3>Call</h3>
<p>(423) 425-4510</p>
<h3>Text</h3>
<p>(423) 521-0564</p>
<h3>Email</h3>
<p>library@utc.edu</p>
<p><a class="btn btn-success btn-normal" href="/library/services/students/research-appointments.php">Schedule An Appointment</a></p>
<div><a class="btn btn-special" href="/library/services/instruction/book-a-library-class.php">Schedule A Library Class</a></div>
</div>
</div>
<?php
 }
 include($_SERVER['DOCUMENT_ROOT']."/includes/foot.php"); ?>
<!-- add any additional footer code here -->
</html>
