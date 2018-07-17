<?php
include('variables.php');
include('/var/www/html/includes/head.php');
include("instructions.php");
?>
<h1>The Assignment Calculator</h1>
<div class="fields hero clearfix">
<form action="date.php" autocomplete="off">

<?php
// Added Jan 2012 to display an error if not everything is filled in
if (isset($_GET['err']) && $_GET['err'] == 1) {
	print "<div class='alert alert-danger' role='alert'>
  <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
  <span class='sr-only'>Please enter valid dates.</span></div>";
}
?>
<div class='align-date-fields'>
<p>Start Date:&#32;

<?php pres_date("one", date("j"), date("n"), date("Y")); ?>
</p><p>
&#32;&#32;Due Date:&#32;&#32;

<?php pres_date("two", "", "", ""); ?>
</p></div>
<center><input type="submit" class="btn btn-inverse btn-large" value="Calculate"></center>
</form>
 <?php
include ('/var/www/html/includes/foot.php');
?>
