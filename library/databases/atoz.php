<?php
//error reporting - default N off
$errorReporting = "Y";
//template system to replicate main website look and feel
$title = "A to Z Databases | UTC Library";
$description = "A to Z list of databases available at UTC Library";
$keywords = "databases";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="NO";
//in case you need to add anything in the head or footer
$addhead = "<style>
span.subjects{
  padding-top: 0.25em;
  display: block;
  color: #00386b;
}
#alpha .nav-pills > .active > a, #alpha .nav-pills > .active > a:hover {
  color:#00386b;
  background-color: whitesmoke;
  font-weight: bold;
  border-top: 2px solid #00386b;
  border-left: 2px solid #00386b;
  border-right: 2px solid #00386b;
  border-bottom: transparent !important;
}
#alpha .nav-pills > li > a, #alpha .nav-pills > li > a {
    background-color: #e9e9e9;
    border: 1px solid #00386b;
    color: #00386b;
}
/*
#alpha .nav-pills > li {
  margin: 0 .125em -2px .125em;
}
*/
#alpha .nav-pills > .active > a, #alpha .nav-pills > .active > a:hover{
  color:white;
  background-color: #00386b;
  text-decoration: none;
}
#alpha .nav-pills > li > a:hover {
  color: white;
  background-color: #00386b;
  text-decoration: none;
/*  border-bottom: 1px solid #EFD487;*/
}
.highlight_list > h2.badge{
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
	min-width: 25px;
	font-size: 40px;
	padding: 15px;
	margin-top: 10px;
	text-align: center;
}
@media (max-width: 768px)
	{
input#search-highlight {
    display: none;
}
	}
input#search-highlight{
	width:50%;
	}
#search-highlight::-ms-clear {
    display: none;
}
.clearable.onX {
    cursor: pointer;
}
.clearable.x {
    background-position: right 5px center;
}
.clearable {
    background: url(//i.stack.imgur.com/mJotv.gif) right -10px center no-repeat #fff;
    border: 1px solid #999;
    padding: 3px 18px 3px 4px;
    border-radius: 3px;
    transition: background .4s;
}
#alpha>.first{
		border-left: 1px solid black;
}
/*
#alpha{
	font-weight:bold;
  font-size:1em;
	width:100%;
	margin:1em 0;
}
*/
#alpha>.itemAlpha{
	border-right:1px solid black;
	width:3.3333333%;
	text-align:center;
	display:inline-block;
}
/*
#alpha a:hover{
	background:	#00386b;
	color:white;
}
#alpha a, #alpha a:visited{
	display:inline-block;
  width:100%;
  height:100%;
	text-decoration: none;
}
.selected{
	border-right:1px solid black;
	background:#e0aa0f;
}
*/
.dbItem{
	padding:1em;
	border-bottom:1px solid #adafaa;
}
#alpha .nav-pills > li.emptyAlpha > a{
  border: 1px solid lightgrey;
	pointer-events: none;
 cursor: default;
	color:#adafaa;
}
h2[id^='Letter'].badge.badge-info.no-results{
  float:left;
}
</style>";
$addfoot = "<script type='text/javascript' src='//www.utc.edu/library/_resources/js/jquery.hideseek.min.js'></script>
		  <!-- hide search jquery plugin-->
      		<script type='text/javascript'>
	$('#search-highlight').hideseek({
  		highlight: true,
		nodata: 'No results found'
	});
$(document).ready(function() {
	console.log('dev code is running');
  $('h2#Letter1').text('#');
/* jquery for clearable fields */
// CLEARABLE INPUT
function tog(v){return v?'addClass':'removeClass';}
$(document).on('input', '.clearable', function(){
    $('.clearable')[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
    $('.clearable')[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
}).on('touchstart click', '.onX', function( ev ){
    ev.preventDefault();
    $('.clearable').removeClass('x onX').val('').change();
	console.log('field cleared');
	resetsearch();
});
});
function resetsearch() {
console.log('who clicked that');
    $('#search-highlight').val('').trigger('keyup').focus();
    var press = jQuery.Event('keypress');
    press.bubbles = true;
    press.cancelable = true;
    press.charCode = 8;
    press.currentTarget = $('#search')[0];
    press.eventPhase = 2;
    press.keyCode = 8;
    press.returnValue = true;
    press.srcElement = $('#search')[0];
    press.target = $('#search')[0];
    press.type = 'keyup';
    press.view = Window;
    press.which = 8;
    $('#search-highlight').trigger(press);
}
</script>";
//show or hide help button
$help = "show";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu=3;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
include("/var/www/html/includes/head.php");
?>
<!-- Insert content here BEGIN -->
<h1>A to Z Databases</h1>
<?php
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
$lastletter = "";
$error = "";
//specify databases
$dbname = "LuptonDB";
// connect to database
require_once '/var/www/html/includes/dbconnect.php';
//require_once ("/var/www/html/includes/mysqlconnect.php');
//$con = new mysqli('localhost','root','','LuptonDB');
$subj = "";
$alpha = "ALL";
$queryKey = "";
$queryKeySubj = "";
if(isset($_GET["subj"])){
$subj = $_GET["subj"];
$queryKeySubj="AND SubjectList.Subject = \"".$subj."\" ";
}
if(isset($_GET["alpha"])){
$alpha = $_GET["alpha"];
}
if ($alpha === "num"){
$queryKey = " AND Dbases.Title REGEXP '^[0-9]'";
}
elseif ($alpha === "ALL"){
	$queryKey = "";
}
else{
	$queryKey = "AND Dbases.Title LIKE '".$alpha."%'";
}
//check for alpha in db
$alphaListFull="";
$queryAlpha = "SELECT DISTINCT
LEFT(Title, 1) as letter
FROM LuptonDB.Dbases ORDER BY letter";
$alphaList = mysqli_query($con , "set names 'utf8'");
$alphaList = mysqli_query($con , $queryAlpha) or die($error);
while($row = mysqli_fetch_array($alphaList))
{
	$alphaListFull .= $row['letter'];
}
echo " <div id='alpha' class='fluid-row'><ul class='nav nav-pills'>";
if ($alpha === "ALL"){
	echo "<li class='active'>";
}
else{
echo "<li>";
}
echo "<a href='".$currentFile."?alpha=ALL'>ALL</a></li>";
if ($alpha === "num"){
echo "<li class='active'>";
}
else{
	echo "<li>";
}
echo "<a href='".$currentFile."?alpha=num'>#</a></li>";
foreach (range('A', 'Z') as $column){
	if ($column == $alpha){
		echo "<li class='active'>";
	}
elseif (strpos($alphaListFull, $column) !== FALSE){
		echo "<li>";
	}
else{
 echo "<li class='emptyAlpha'>";
}
echo "<a href='".$currentFile."?alpha=".$column."'> ".$column." </a></li>";
}
echo "</ul>";
// get a list of current subjects - dev????
/*$querySubjectList = " SELECT SubjectList.Subject
FROM LuptonDB.SubjectList
";
//echo $querySubjectList;
$resultSL = mysqli_query("set names 'utf8'");
$resultSL = mysqli_query($querySubjectList) or die($error);
echo "<div class='span12 clearfix'><select>
      <option>Limit by Subject</option>";
while($row = mysqli_fetch_array($resultSL)){
  echo "<option>".$row['Subject']."</option>";
}
echo "</select>*/
echo"
	<label class='hidden sr-only' for='search-highlight' aria-label='Search'>Search in page</label>
	<input id='search-highlight' class='clearable pull-right' autocomplete='off' name='search-highlight' type='text' placeholder='Type here to search page' data-list='.highlight_list'>
</div>";

$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL,
GROUP_CONCAT( SubjectList.Subject SEPARATOR ', ') AS Subjects
					FROM Dbases
          LEFT JOIN LuptonDB.DBRanking
          ON Dbases.Key_ID = DBRanking.Key_ID
          LEFT JOIN LuptonDB.SubjectList
          ON DBRanking.Subject_ID = SubjectList.Subject_ID
					WHERE Dbases.Key_ID <> 529 AND Dbases.Masked = 0 ".$queryKey.$queryKeySubj.
          "GROUP BY Title
          ORDER by Dbases.Title";
//echo "diag<hr />".$query."<hr /><br />";
$result = mysqli_query($con , "set names 'utf8'");
$result = mysqli_query($con , $query) or die($error);
echo "<div class='highlight_list'>";
if (!mysqli_num_rows($result)){
echo "There are no databases meeting the parameters:<br/>alpha=$alpha";
}
else
{
while($row = mysqli_fetch_array($result))
{
$currentletter = strtoupper(substr($row['Title'] , 0 , 1));
	if (($lastletter != $currentletter)&&(preg_match("/[A-Z]|1/i", $currentletter))){
	    echo '<h2 id="Letter' . $currentletter .  '" class="badge badge-info">' . $currentletter . '</h2>';
	    $lastletter = $currentletter;
	}
	echo "<div class='dbItem'><strong><a href='";
  if (!empty($row['ShortURL'])){
	echo "https://www.utc.edu/" . $row['ShortURL'];
  }
  else{
  echo "https://www5.utc.edu/databases/LGForward.php?db=". $row['Key_ID'];
  }
  echo"' target='_blank'>" . $row['Title'] . "</a></strong><br />";
	if (!empty($row['ContentType'])){
		echo "<strong>" . $row['ContentType'] . ": </strong>";
  }
	echo $row['ShortDescription'];
	if (!empty($row['HighlightedInfo'])){
		echo "<strong><font color='red'>  " . $row['HighlightedInfo'] . "</font></strong>";
  }
	if ($row['SimUsers'] == 1){
		echo "<strong><font color='red'>  Limited to " . $row['SimUsers'] . " simultaneous user.</font></strong>";
  }
	else if ($row['SimUsers'] > 1){
		echo "<strong><font color='red'>  Limited to " . $row['SimUsers'] . " simultaneous users.</font></strong>";
  }
  if (!empty($row['Subjects'])){
  echo "<span class='subjects'><strong>Subjects:</strong> ".$row['Subjects']."</span>";
}
  echo "</div>";
}
}
echo "</div><!-- highlight_list -->";

mysqli_close($con);


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
include("/var/www/html/includes/foot.php");
?>
<!-- add any additional footer code here -->
