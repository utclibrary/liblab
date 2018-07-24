<?php
//error reporting - default N off
$errorReporting = "Y";
//template system to replicate main website look and feel
$title = "A to Z Databases Dev | UTC Library";
$description = "Full A to Z list of databases available at the UTC Library";
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
  input#search-highlight {
    margin-right: 2em;
      /*width: -webkit-fill-available;
      width: -moz-available;*/
      font-size: 1.25em;
      height: auto;
      line-height: 2em;
  }
  input#search-highlight.hidden {
      display: none;
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
/* for new db list */
/* fix ul */
ul.s-lg-link-list li a{
   font-weight:bold;
   border-bottom: none !important;
}
ul.s-lg-link-list li a:hover{
   background-color: transparent;
}
ul.s-lg-link-list{
  margin-bottom: -10px;
  padding: .5em 0 0 0;
  margin-left: 0px;
}
ul.s-lg-link-list li{
 margin-bottom:1em;
 padding-bottom:.5em;
 border-bottom:1px solid #adafaa;
  list-style:none;
}
ul.s-lg-link-list li:hover{
  background-color: whitesmoke;
  box-shadow: 0 0 5px 5px whitesmoke;
}
.dbItem:hover{
  background-color: white;
  box-shadow: 0 0 5px 5px white;
}
/*
#subject-select{
  font-size:1.5em;
  height:auto;
  width:auto;
}*/
#subject-select{
  /* styling */
  height: auto;
    font-size: 1.125em;
    width: auto;
  background-color: white;
  border: thin solid blue;
  border-radius: 4px;
  display: inline-block;
  line-height: 1.5em;
  padding: 0.5em 3.5em 0.5em 1em;

  /* reset */

  margin: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;

  background-image:
    linear-gradient(45deg, transparent 50%, gray 50%),
    linear-gradient(135deg, gray 50%, transparent 50%),
    linear-gradient(to right, #ccc, #ccc);
  background-position:
    calc(100% - 20px) calc(1em + 2px),
    calc(100% - 15px) calc(1em + 2px),
    calc(100% - 2.5em) 0.5em;
  background-size:
    5px 5px,
    5px 5px,
    1px 1.5em;
  background-repeat: no-repeat;
}

#subject-select:focus {
  background-image:
    linear-gradient(45deg, green 50%, transparent 50%),
    linear-gradient(135deg, transparent 50%, green 50%),
    linear-gradient(to right, #ccc, #ccc);
  background-position:
    calc(100% - 15px) 1em,
    calc(100% - 20px) 1em,
    calc(100% - 2.5em) 0.5em;
  background-size:
    5px 5px,
    5px 5px,
    1px 1.5em;
  background-repeat: no-repeat;
  border-color: green;
  outline: 0;
}
#subject-select:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #000;
}
div.dbItem.alert-info{
  margin: 0.75em 0;
  border-bottom: 0px;
  border-radius: 10px;
}
</style>";
$addfoot = "<script type='text/javascript' src='//www.utc.edu/library/_resources/js/jquery.hideseek.min.js'></script>
		  <!-- hide search jquery plugin-->
      		<script type='text/javascript'>
          //<![CDATA[
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
/* toggle search button */
/*
$( '#searchbutton' ).toggle(function() {
  console.log( 'First' );
  $('#searchbox').slideUp();
  $('#searchbox').focus();
  $('#alphlist li:not(:first);
  $('#subject-select').hide();
}, function() {
  console.log( 'Second' );
  $('#searchbox').slideDown();
  $('#alphlist li:not(:first);
  $('#subject-select').show();
});
*/
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
/* reload page on select */
$( '#subject-select' ).change(function() {
  window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $( '#subject-select').val();
 });
//]]>
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
<?php
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
$lastletter = "";
$error = "";
// connect to database
require_once '/var/www/html/includes/dbconnect.php';
$alpha = "ALL";
$queryKey = "";
$queryKeySubj = "";
if(isset($_GET["subj"])){
$subj = htmlentities($_GET["subj"]);
$subject = preg_replace('/[^a-zA-Z0-9]+/', '%', $subj);
$queryKeySubj="AND SubjectList.Subject LIKE \"".$subject."\" ";
echo "<style>h2.badge,span.subjects{display:none;}</style>";
$orderby = "DBRanking.Ranking";
}else{
  $subj = "A to Z";
  $orderby = "Dbases.Title";
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
echo "<h1>$subj Databases</h1>";
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
echo " <div id='alpha' class='fluid-row'>
<ul id='alphlist' class='nav nav-pills'>";
if (($alpha === "ALL")&&($subj === "A to Z")){
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
echo "
</ul>
    </div>";
// get a list of current subjects - still working on this????
$querySubjectList = " SELECT SubjectList.Subject
FROM LuptonDB.SubjectList WHERE SubjectList.NotSubjectList = 0 AND SubjectList.Format = 0 ORDER BY SubjectList.Subject
";
//echo $querySubjectList;
$resultSL = mysqli_query($con , "set names 'utf8'");
$resultSL = mysqli_query($con , $querySubjectList) or die($error);
  echo "<div class='clearfix'>";
if ($alpha === "ALL"){
echo "<select id='subject-select'>
        <option>Limit by Subject</option>";
  while($row = mysqli_fetch_array($resultSL)){
    echo "<option";
    if (strpos($row['Subject'],$subj) === 0) {
      echo " selected='selected' ";
    }
    echo">".$row['Subject']."</option>";
  }
  echo "</select>
  <span id='searchbox'>";
if ($subj === "A to Z"){
  echo"<label class='hidden sr-only' for='search-highlight' aria-label='Search'>Search in page</label>
    	<input id='search-highlight' class='clearable pull-right' autocomplete='off' name='search-highlight' type='text' placeholder='Type here to search page' data-list='.highlight_list'></span><!--
      <button id='searchbutton' class='btn btn-primary'><i class='icon-search'><span class='hidden'>UTC Home</span></i></button> -->";
    }
}
echo"</div>";

$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL, DBRanking.TryTheseFirst, SubjectList.LibGuidesPage,
#GROUP_CONCAT( DISTINCT '<a href=\"$currentFile?alpha=ALL\&subj=', SubjectList.Subject, '\">', SubjectList.Subject, '</a>' ORDER BY SubjectList.Subject SEPARATOR ' | ') AS Subjects
GROUP_CONCAT( DISTINCT SubjectList.Subject ORDER BY SubjectList.Subject SEPARATOR ' | ') AS Subjects
					FROM Dbases

          LEFT JOIN LuptonDB.DBRanking
          ON Dbases.Key_ID = DBRanking.Key_ID
          LEFT JOIN LuptonDB.SubjectList
          ON DBRanking.Subject_ID = SubjectList.Subject_ID
					WHERE SubjectList.NotSubjectList = 0 AND Dbases.Key_ID <> 529 AND Dbases.Masked = 0 ".$queryKey.$queryKeySubj.
          "GROUP BY Title
          ORDER by ".$orderby;
//echo "diag<hr />".$query."<hr /><br />subject = $subject";
$result = mysqli_query($con , "set names 'utf8'");
$result = mysqli_query($con , $query) or die($error);
echo "<div class='highlight_list'>";
if (!mysqli_num_rows($result)){
echo "No results";
}
else
{
    $i = 0;
while($row = mysqli_fetch_array($result))
{
  if($i == 0){
    if ((!empty($row['LibGuidesPage']))&&($subj != "A to Z")) {
      echo "<div class='dbItem alert-info'>
    <i class='icon-compass' style='padding-right: .25em;'><span class='hidden'> New Databases</span> </i>
      <strong><a href='https://guides.lib.utc.edu/".$row['LibGuidesPage']."'>".$subj." Subject Guide</a></strong></div>";
    }
    $i++;
  }
$currentletter = strtoupper(substr($row['Title'] , 0 , 1));
	if (($lastletter != $currentletter)&&(preg_match("/[A-Z]|1/i", $currentletter))){
	    echo '<h2 id="Letter' . $currentletter .  '" class="badge badge-info">' . $currentletter . '</h2>';
	    $lastletter = $currentletter;
	}
	echo "<div class='dbItem'><strong>";
  if ((($row['TryTheseFirst']) === '1')&&($subj != "A to Z")){
  echo "<span class='badge badge-primary pull-right'>Try First</span>";
  }
  echo "<a href='";
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
  echo "<span class='subjects'><strong>Subjects:</strong>| ".$row['Subjects']." |</span>";
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
<h2 class="welltopperGold" style="font-size: 24px;">
<i class="icon-bullhorn" style="padding-right: .25em;"><span class="hidden"> New Databases</span> </i>New Databases</h2>
<?php echo file_get_contents('https://www5.utc.edu/databases/LGSubject.php?sub=NEW');?>
</div>
</div>
<?php
 }
include("/var/www/html/includes/foot.php");
?>
<!-- add any additional footer code here -->
