<?php
include('variables.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/head-v2.php');
include("instructions.php");
?>

<style>
#push{
	height:calc(25vh + 1em);
}
</style>

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
<center><input type="submit" value="Calculate"></center>
</form>
 <?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/foot-v2.php');
?>
