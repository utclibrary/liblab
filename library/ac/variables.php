<?php
$errorReporting = "Y";
$title = "Assignment Calculator | UTC Library";
$description = "Tool to plan your next research project";
$keywords = "assignment calculator,research help";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="NO";
//in case you need to add anything in the head or footer
$addhead = "
  <link rel='stylesheet' href='ac-styles.css'>
  <link rel='stylesheet' href='//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'>
  <link rel='stylesheet' type='text/css' href='/includes/print.css'>
  ";
$addfoot = "
  <script src='//code.jquery.com/ui/1.11.4/jquery-ui.js'></script>
<script src='//code.jquery.com/ui/1.11.4/jquery-ui.js'></script>
<!-- AddThisEvent -->
<script type='text/javascript' src='https://addthisevent.com/libs/1.6.0/ate.min.js'></script>
 <script>
 $(function() {
   $( '.date-field' ).datepicker();
 });
 </script>";
$rightmenu=0;
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu=0;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
?>
