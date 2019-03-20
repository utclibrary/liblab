<?php
//error reporting - default N offx
$errorReporting = "Y";
//template system to replicate main website look and feel
$title = "Databases | UTC Library";
$description = "Databases available at the UTC Library.";
$keywords = "databases";
//do you want to override the folder structure for menu? (default is NO)
$override_side_menu="NO";
//in case you need to add anything in the head or footer
$addhead = "
<style>
span.vendor{
  //padding-top: 0.25em;
}
span.subjects, span.vendor{
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
	font-size: 40px;
}
#outputSLA > h2.badge{
  font-size: 20px;
}
.highlight_list > h2.badge, #outputSLA > h2.badge{
	min-width: 25px;
	padding: 15px;
	margin-top: 10px;
	text-align: center;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
::-moz-placeholder { /* Firefox 19+ */
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
:-ms-input-placeholder { /* IE 10+ */
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
:-moz-placeholder { /* Firefox 18- */
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

/*
input#search-highlight::placeholder{
  color:whitesmoke;
  opacity:1;
}

input#search-highlight::-webkit-input-placeholder{
    color:whitesmoke;
}
input#search-highlight:-moz-placeholder {
    color:whitesmoke;
    opacity:1;
}

input#search-highlight:hover::placeholder{
    color:#781e1e;
    opacity:1;
}

input#search-highlight:hover::-webkit-input-placeholder{
    color:#781e1e;
}
input#search-highlight:hover:-moz-placeholder{
    color:#781e1e;
}
*/
input#search-highlight{
  padding-left:.5em;
  background-color:white;
  max-width: 97%;
  border:1px solid grey;
  margin-right: 1em;
  font-size: 1.5em;
  height: 2em;
  line-height: 2em;
  }
input#search-highlight:hover, input#search-highlight:focus{
    cursor:pointer;
    border:1px solid #e0aa0f;
    background-color:white;
  }
input#search-highlight.hidden {
      display: none;
  }
#search-highlight::-ms-clear {
    display: none;
}
input#search-highlight.x{
  font-size:1.5em;
  font-family: \"Open Sans\", \"Helvetica Neue\", Helvetica, Arial, sans-serif;
  width:100%;
  background-color:white;
}
.clearable.onX {
    cursor: pointer;
}
.clearable.x {
    background-position: right 5px center;
}
.clearable {
    background: url(//i.stack.imgur.com/mJotv.gif) right -10px center no-repeat #fff;
    /*border: 1px solid #999;*/
    padding: 3px 18px 3px 4px;
    border-radius: 3px;
    transition: background .4s;
}
#alpha>.first{
		border-left: 1px solid black;
}
#alpha{
	width:100%;
	margin:1em 0;
}
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
.form-dropdown::-ms-expand {
  display: none;
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
.dbItem:hover,.dbItemLG:hover{
  background-color: white;
  box-shadow: 0 0 5px 5px white;
}
/*
#subject-select{
  font-size:1.5em;
  height:auto;
  width:auto;
}*/
#subject-select, #type-select{
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
div.dbItemLG.alert-info{
  margin: 0.75em 0;
  border-bottom: 0px;
  border-radius: 10px;
}
.highlighted-info{
  color:#781e1e;
}
.page-search {
  width: 100%;
  -webkit-transition: all .5s ease;
  -moz-transition: all .5s ease;
  transition: all .5s ease;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  text-decoration: inherit;
}
.input-hold{
  width:100%;
}
#alpha .nav-pills > .red-btn > a{
  background-color: #781e1e;
}
.subjects .badge{
  margin:6px 10px 5px 5px;
}
.subjects .nav-pills > li:nth-of-type(2) > a{
  border-left:1px solid black;
}
.subjects .nav-pills > li > a,.subjects .nav-pills > li > a:hover{
  font-size:.85em;
  border-right: 1px solid black;
  border-bottom:0px;
  padding:0 5px;
  text-decoration:none;
  border-radius:0px;
}
.subjects .nav-pills > li > a:hover{
  color: white;
  background: darkblue;
}
.subjects ul.nav{
  margin:2px 2px 2px 50px;
  padding:3px;
}
.dbItem .badge{
  margin-left:5px;
}
.dbItem .strong{
  margin-left:-55px;
  font-size: .85em;
  padding-right: 5px;
  font-weight: bold;
}
/* webkit solution */
/*
input#search-highlight::-webkit-input-placeholder { text-align:right; }
*/
/* mozilla solution */
/*
input#search-highlight:-moz-placeholder { text-align:right; }
*/
#alphaRankedSortBtn{
  margin: 10px 10px 10px 0px;
}
.dbItemLG{
  padding: 10px;
}
.dbItemLG i.icon-compass{
  padding-right: .25em;
}
.sidebar h2.welltopperGold{
  font-size: 24px;
}
.sidebar h2.welltopperGold i.icon-search{
  padding-right: .25em;
}
#multiSubject{
  float: right;
  margin-left: 0;
}
#checkItOut h2.welltopperGold i.icon-star{
  padding-right: .25em;
}
#newDBs h2.welltopperBlue i.icon-bullhorn{
  padding-right: .25em;
}
#atoz-reset-btn{
  margin:0 10px;
  float:right;
}
#atoz-reset-btn a{
  color:white;
}
#atoz-reset-btn a:hover{
  box-shadow: inset 0 0 100px 100px rgba(255, 255, 255, 0.1);
  text-decoration: none;
  background: transparent;
  color:white;
}
#atoz-reset-btn-disabled{
    margin:0 10px;
  float: right;
  cursor: default;
  color: darkgrey;
}
#outputSLA li.type{
  text-align:right;
}
span.db-title{
  display:block;
  font-style:bold;
}
</style>
";
$addfoot = "<script src='//www.utc.edu/library/_resources/js/jquery.hideseek.min.js'></script>
		  <!-- hide search jquery plugin-->
      		<script>
          //<![CDATA[
	$('#search-highlight').hideseek({
      min_chars: 3,
  		highlight: true,
		nodata: 'No results found'
	});
$(document).ready(function() {
  /* get content of totalCount */
  var cloneTotalResults = $('#totalResults').text();
  $('#search-highlight').keyup(function() {
      if ($(this).val() == '') { // check if value changed
        $('#totalResults').html(cloneTotalResults);
      }
      else{
        var totalResults = $('.dbItem:visible').length;
          $('#totalResults').html('Total results: ' + totalResults);
      }
  });
  $('[data-toggle=\"tooltip\"]').tooltip();
  $('h2#Letter1').text('#');
/* jquery for clearable fields */

console.log(cloneTotalResults);
// CLEARABLE INPUT
function tog(v){return v?'addClass':'removeClass';}
$(document).on('input', '.clearable', function(){

    $(this).addClass('input-hold');
    $('.clearable')[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
    $('.clearable')[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');  $(this).removeClass('input-hold');
}).on('touchstart click', '.onX', function( ev ){  $(this).removeClass('input-hold');
    ev.preventDefault();
    $('.clearable').removeClass('x onX').val('').change();
    $('#totalResults').html(cloneTotalResults);
	resetsearch();
});
});
function resetsearch() {
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
/* reload page on subject select */
$( '#subject-select' ).change(function() {
  window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $( '#subject-select').val();
 });
 /* reload page on type select */
 $( '#type-select' ).change(function() {
   window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $( '#type-select').val();
  });
//]]>
</script>
";
//show or hide help button
$help = "show";
/*if right column is added set the following variable so that we can adjust the content width
set to 0 if no right menu
set to 3 and modify the content of the
*/
$rightmenu=3;
/* switch leftmenu on or off Y or N*/
$navmenu="N";
include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");
?>
<!-- Insert content here BEGIN -->
<?php
// include functions
//include($_SERVER['DOCUMENT_ROOT']."/includes/functions.inc");
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
// declare variables
$lastletter = "";
$error = "";
// connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
//  set variables in case paramater is not passed
$alpha = "ALL";
$queryKey = "";
$queryKeySubj = "";
$urlsubjappend="";
$queryKeySubjAtoZ="";
$outputSLA = "";
$h1Prepend = "";
//try adding by filter by contentType
$contentType = "";
$queryContentType = "";
if (isset($_GET["type"])) {
    $contentType = htmlentities($_GET["type"]);
    $h1Prepend = $contentType;
    $queryContentType = "AND ContentType = '" .$contentType. "'";
}//try adding by filter by contentType
$vendor = "";
$queryVendor = "";
if (isset($_GET["vendor"])) {
    $vendor = htmlentities($_GET["vendor"]);
    $h1Prepend = $vendor;
    $queryVendor = "AND VendorName = '" .$vendor. "'";
}
// get subject param if set
if (isset($_GET["subj"])) {
    $subj = htmlentities($_GET["subj"]);
    $h1Prepend = $subj;
    // ignore limit by subject selection
    if (strpos($subj, 'Limit') !== false) {
        // if no subject change var and query used in $query
        $subj = "A to Z";
        $orderby = "Dbases.Title";
    } else {
        echo"
  <script>
  $(document).ready(function() {
    //remove hand cursor from alpha
    $('a.alpha').css('cursor', 'default');
    //override hover functions
    $('a.alpha').hover(function() {
    $(this).css('background-color', '#e9e9e9');
    $(this).css('color','#00386b');
}, function() {
    $(this).css('background-color', '#e9e9e9');
    $(this).css('color','#00386b');
});
//prevent click function
    $('a.alpha').click(function(e){
       e.preventDefault();
     });
  });
  </script>
  ";
        // sanitize
        $subject = preg_replace('/[^a-zA-Z0-9]+/', '%', $subj);
        // set query variables for subjects used in main $query
        $queryKeySubj="AND (SubjectList.Subject LIKE '".$subject."' OR SubjectList.Subject = 'New')";
        //this is used in alpha query to show letters available in this subject
        $queryKeySubjAtoZ="AND SubjectList.Subject LIKE '".$subject."'";
        // create append for alpha clicks within subject
        //$urlsubjappend = "&subj=".$subj;

        // hide alpha badges on subject pages
        echo "<style>h2.badge,span.subjects{display:none;}</style>";
        // set order by used in $query
        $orderby = "DBRanking.Ranking";
        //hide letter badges on clear search
        echo "<style>.highlight_list h2[id^='Letter']{display:none !important;}</style>";
    }
} else {
    // if no subject change var and query used in $query
    $subj = "A to Z";
    $orderby = "Dbases.Title";
}
// get alpha if set
$queryKeyAlpha = "";
$displayAlpha = "";
if (isset($_GET["alpha"])) {
    $alpha = $_GET["alpha"];
    $displayAlpha = " - ".$alpha;
}
// check to see if alpha is num, empty or letter to change query used in $query*(s)
if ($alpha === "num") {
    $queryKey = " AND Dbases.Title REGEXP '^[0-9]'";
    $queryKeyAlpha = "&alpha=num";
} elseif ($alpha === "ALL") {
    $queryKey = "";
    $displayAlpha = "";
} else {//letter selected
    //$queryKeyAlpha = "&alpha=".$alpha;
    $queryKey = "AND Dbases.Title LIKE '".$alpha."%'";
    // added to generate subject list on alpha click
    // query subjects by alpha
    $querySubjectListAlpha = " SELECT DISTINCT SubjectList.Subject,
IF (SubjectList.NotSubjectList = 0,'true','false') AS NotSubjectList,
IF (SubjectList.Format = 0,'subject','type')AS Format
FROM LuptonDB.SubjectList
WHERE SubjectList.NotSubjectList = 0 AND SubjectList.Subject_ID <> 59 AND SubjectList.Subject LIKE '".$alpha."%'
ORDER BY SubjectList.Format , SubjectList.Subject
  ";
    //generate subject list when alpha selected
    $resultSLA = mysqli_query($conLuptonDB, "set names 'utf8'");
    $resultSLA = mysqli_query($conLuptonDB, $querySubjectListAlpha) or die($error);
    $totalRows = mysqli_num_rows($resultSLA);
    if (mysqli_num_rows($resultSLA)!=0) {
        // need to apply styling for this section
        $outputSLA .= "<div id='outputSLA'><h2 class='badge badge-info'>Subject";
        if (mysqli_num_rows($resultSLA)> 1) {
            $outputSLA .= "s";
        }
        $outputSLA .= "</h2><ul class='nav nav-list'>";
        while ($row = mysqli_fetch_array($resultSLA)) {
            $outputSLA .= "<li class='".$row['Format']."'><a href=\"".$currentFile."?subj=".$row['Subject']."\">".$row['Subject']."</a></li>";
        }
        $outputSLA .= "</ul></div>";
    }

    //echo $outputSLA;
}//close letter set
// this changes dynamcially based on subject paramater - jquery updates the page title
echo "<h1>".$h1Prepend." Databases".$displayAlpha."</h1>
<h2>Filtering Options</h2>
<script type='text/javascript'>
    $(document).ready(function() {
        document.title = \"".$h1Prepend." Databases".$displayAlpha." | UTC Library\";
    });
</script>";
// get a list of current subjects for select box exclude
$querySubjectList = reuseSubjQuery(0, "");

$resultSL = mysqli_query($conLuptonDB, "set names 'utf8'");
$resultSL = mysqli_query($conLuptonDB, $querySubjectList) or die($error);
  echo "<div class='clearfix'>";
  //show search box only on full atoz
  if (($subj === "A to Z")&&($alpha === "ALL")) {
      echo"";
  }
      //show subject select box atoz and subject selected
//if ($alpha === "ALL"){
echo "<span class='row' id='searchbox'>
      <label class='hidden sr-only' for='search-highlight' aria-label='Search'>Search in page</label>
      <input id='search-highlight' class='clearable page-search' autocomplete='off' name='search-highlight' type='text' placeholder='Search by name or description' data-list='.highlight_list'></span><!--
      <button id='searchbutton' class='btn btn-primary'><i class='icon-search'>

      <span class='hidden'>Search Databases</span></i></button> -->
      <label for='subject-select' class='hidden'>Subject Select</label>
      <select id='subject-select'>
      <option>Limit by Subject</option>";
  while ($row = mysqli_fetch_array($resultSL)) {
      echo "<option";
      if (strpos($row['Subject'], $subj) === 0) {
          echo " selected='selected' ";
      }
      echo" value=\"".$row['Subject']."\">".$row['Subject']."</option>";
  }
  echo "</select>";
//}
//select by type
// get a list of current subjects for select box
$queryTypeList = reuseSubjQuery(1, "");

$resultTL = mysqli_query($conLuptonDB, "set names 'utf8'");
$resultTL = mysqli_query($conLuptonDB, $queryTypeList) or die($error);
$totalRows = mysqli_num_rows($resultTL);
if (!mysqli_num_rows($resultTL)) {//if no results disable select box
    $resultTLdisabled = "disabled";
} else {
    $resultTLdisabled="";
}
  //show search box only on full atoz
  if (($subj === "A to Z")&&($alpha === "ALL")) {
      echo"";
  }
      //show subject select box atoz and subject selected
//if ($alpha === "ALL"){
echo"
      <label for='type-select' class='hidden'>Type Select</label>
      <select id='type-select' ".$resultTLdisabled.">
      <option>Limit by Type</option>";
  while ($row = mysqli_fetch_array($resultTL)) {
      echo "<option";
      if (strpos($row['Subject'], $subj) === 0) {
          echo " selected='selected' ";
      }
      echo" value=\"".$row['Subject']."\">".$row['Subject']."</option>";
  }
  echo "</select>";
  if (($alpha === "ALL")&&($subj === "A to Z")&&($vendor === "")&&($contentType === "")) {
      //echo "<a id='atoz-reset-btn-disabled' class='active btn btn-large'>RESET</a>";
  } else {
      echo "<a id='atoz-reset-btn' class='active btn btn-large btn-danger' href='".$currentFile."?alpha=ALL'>RESET</a>";
  }
//}
// END select by type
//check for alpha in db
$alphaListFull="";
// query to generate a to z
$queryAlpha = "SELECT DISTINCT
LEFT(Title, 1) as letter
FROM LuptonDB.Dbases
LEFT JOIN LuptonDB.Vendor
ON Dbases.Vendor_ID = Vendor.Vendor_ID
LEFT JOIN LuptonDB.DBRanking
ON Dbases.Key_ID = DBRanking.Key_ID
LEFT JOIN LuptonDB.SubjectList
ON DBRanking.Subject_ID = SubjectList.Subject_ID
WHERE Dbases.Key_ID <> 529 AND Dbases.Masked = 0 ".$queryKeySubjAtoZ.$queryContentType.$queryVendor."
ORDER BY letter";
//echo "<pre>".$queryAlpha."</pre>";
$alphaList = mysqli_query($conLuptonDB, "set names 'utf8'");
$alphaList = mysqli_query($conLuptonDB, $queryAlpha) or die($error);
while ($row = mysqli_fetch_array($alphaList)) {
    $alphaListFull .= $row['letter'];
}
echo " <div id='alpha' class='fluid-row'>
<ul id='alphalist' class='nav nav-pills'>";

//if ($alpha === "num"){
//echo "<li class='active'>";
//}
//else{
    echo "<li>";
//}
//echo "<a href='".$currentFile."?alpha=num'>#</a></li>";
// loop through A to Z highight if selected
foreach (range('A', 'Z') as $column) {
    if ($column == $alpha) {
        echo "<li class='active'>";
    } elseif (strpos($alphaListFull, $column) !== false) {
        echo "<li>";
    } else {
        // if letter not in query change class to grey it out
        echo "<li class='emptyAlpha'>";
    }
    echo "<a class='alpha' href=\"".$currentFile."?alpha=".$column.$urlsubjappend."\"> ".$column." </a></li>";
}
echo "
</ul>
    </div>";
    echo"</div>";

// main query to generate lists of dbs
$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL, DBRanking.TryTheseFirst, SubjectList.LibGuidesPage,VendorName,
GROUP_CONCAT( DISTINCT '<li>' , SubjectList.Subject , '</li>' ORDER BY SubjectList.Subject SEPARATOR '') AS Subjects
          FROM LuptonDB.Dbases
          LEFT JOIN LuptonDB.Vendor
          ON Dbases.Vendor_ID = Vendor.Vendor_ID
          LEFT JOIN LuptonDB.DBRanking
          ON Dbases.Key_ID = DBRanking.Key_ID
          LEFT JOIN LuptonDB.SubjectList
          ON DBRanking.Subject_ID = SubjectList.Subject_ID
					WHERE Dbases.Key_ID <> 529 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ".$queryKey.$queryKeySubj.$queryContentType.$queryVendor."
          GROUP BY Title
          ORDER by ".$orderby;
         //echo "<pre>".$query."</pre>";
$result = mysqli_query($conLuptonDB, "set names 'utf8'");
$result = mysqli_query($conLuptonDB, $query) or die($error);
if (!mysqli_num_rows($result)) {
    echo "No results";
} else {
    $totalRows = mysqli_num_rows($result);
    echo "<p id='totalResults'>Total results: " . $totalRows . "</p>";
    // show subjects by alpha
    echo $outputSLA;
    $i = 0;
    // loop through results
    while ($row = mysqli_fetch_array($result)) {
        if ((strpos($row['Subjects'], $subj) !== false)||($subj==="A to Z")) {
            // if subj show Libguide once
            if ($i == 0) {
                if ((!empty($row['LibGuidesPage']))&&($subj != "A to Z")) {
                    echo "<div class='dbItemLG alert-info'>
    <i class='icon-large icon-compass'><span class='hidden'> ".$subj." Guide</span> </i>
      <span class='libguidename'><a href='https://guides.lib.utc.edu/".$row['LibGuidesPage']."'>".$subj." Subject Guide</a></span></div>";
                }
                //if this is a subject list show alpha rank buttons
                if ($subj != "A to Z") {
                    ?>
      <div id="alphaRankedSortBtn" class="span12">
        <button class="span6 active" id="numBnt">Ranked Sort</button>
        <button class="span6" id="alphBnt">Alphabetical Sort</button>
      </div>
      <div id='subject_list_items' class='highlight_list'>
      <script>
      $( document ).ready(function() {
        var $divs = $("div.dbItem");
        $('#numBnt').attr("disabled", "disabled");

  $('#alphBnt').on('click', function () {
    $('#numBnt').removeAttr('disabled');
    $(this).attr("disabled", "disabled");
      var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
          //return $(a).find("a").text() > $(b).find("a").text();
          return $(a).find("a").text() > $(b).find("a").text()  ? 1 : -1;
      });
      $("#subject_list_items").html(alphabeticallyOrderedDivs);
  });

  $('#numBnt').on('click', function () {
    $('#alphBnt').removeAttr('disabled');
    $(this).attr("disabled", "disabled");
    $("#subject_list_items").load(" #subject_list_items > *");

      //$("#subject_list_items").load("#subject_list_items > *");
  });
});
    </script>
      <?php
                } else {
                    echo "<div class='highlight_list'>";
                }
                $i++;
            }
            // create styled letter SEPARATOR
            $currentletter = strtoupper(substr($row['Title'], 0, 1));
            if (($lastletter != $currentletter)&&(preg_match("/[A-Z]|1/i", $currentletter))) {
                echo '<h2 id="Letter' . $currentletter .  '" class="badge badge-info">' . $currentletter . '</h2>';
                $lastletter = $currentletter;
            }
            // set condition for new but not subjects
            if (((strpos($row['Subjects'], $subj) !== false)&&($subj != "A to Z"))||($subj==='A to Z')) {
                echo "<div class='dbItem'>";
                if ((($row['TryTheseFirst']) === '1')&&($subj != "A to Z")) {
                    echo "<span class='badge badge-primary pull-right'>Try First</span>";
                }
                if (strpos($row['Subjects'], '<li>New</li>') !== false) {
                    echo "<span class='badge badge-warning pull-right'> NEW </span>";
                }
                echo "<span class='db-title'><a href='";
                if (!empty($row['ShortURL'])) {
                    echo "https://www.utc.edu/" . $row['ShortURL'];
                } else {
                    echo "/scripts/LGForward.php?db=". $row['Key_ID'];
                }
                echo"' target='_blank'>" . $row['Title'] . "</a></span>";
                if (!empty($row['ContentType'])) {
                    echo "<span class='contentType'> <a href=\"".$currentFile."?type=".$row['ContentType']."\">". $row['ContentType'] . "</a></span>: ";
                }
                echo "<span class='shortDescription'>" . $row['ShortDescription'] . "</span>";
                if (!empty($row['HighlightedInfo'])) {
                    echo "<span class='highlighted-info'> " . $row['HighlightedInfo'] . "</span>";
                }
                if ($row['SimUsers'] == 1) {
                    echo "<span class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
                } elseif ($row['SimUsers'] > 1) {
                    echo "<spah class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
                }
                if (!empty($row['VendorName'])) {
                    echo "<span class='vendor'>Vendor: <a class='alpha' href=\"".$currentFile."?vendor=".$row['VendorName']."\"> ".$row['VendorName']." </a></span>";
                }
                if (!empty($row['Subjects'])) {
                    echo "<span class='subjects'><ul class='nav nav-pills'><li class='strong'>Subject";
                    if ((strpos($row['Subjects'], '</li><li>') == false)||(preg_match('/^<li>(.*?)(?!<li>)(.*?)<li>New<\/li>$|^<li>New<\/li>(.*?)(?!<li>)(.*?)<\/li>$/', $row['Subjects']))) {//single item or single item + new
                    } else {
                        echo "s";
                    }
                    echo ": </li>".$row['Subjects']."</ul></span>";
                }
                echo "</div>";//close each item
            }
        }
    }
}
echo "</div><!-- highlight_list -->";

//this is where the content goes for the right menu could also use
 if ($rightmenu==3) {
     ?>
 </div> <!-- close content div -->
<div id="multiSubject" class="span3">
<div class="sidebar well">
<h2 class="welltopperGold">
<i class="icon-search"><span class="hidden"> Multi-subject</span> </i>Multi-subject</h2>
<?php
$multiquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases INNER JOIN DBRanking ON DBRanking.Key_ID = Dbases.Key_ID INNER JOIN SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID WHERE SubjectList.SubjectCode = 'MULTI' AND DBRanking.TryTheseFirst = 0 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY DBRanking.Ranking";
     $resultMulti = mysqli_query($conLuptonDB, $multiquery) or die($error);

     if (!mysqli_num_rows($resultMulti)) {
         echo "There are no databases meeting the parameters: <p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
     } else {
         generatelist($resultMulti);
     } ?>
</div>
<?php
// only show new on home page
if (($alpha=== "ALL")&&($subj === "A to Z")) {
    ?>
    <div id="checkItOut" class="sidebar well">
     <h2 class="welltopperGray">
 <i class="icon-star"><span class="hidden"> Check it out</span> </i>Check Out</h2>
 <?php
 $randquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases
 WHERE Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 AND Dbases.Key_ID <> 529 ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conLuptonDB, $randquery) or die($error);

    if (!mysqli_num_rows($result)) {
        echo "There are no databases meeting the parameters:<p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
    } else {
        generatelist($result);
    } ?>
</div>
<div id="newDBs" class="sidebar well">
<h2 class="welltopperBlue">
<i class="icon-bullhorn"><span class="hidden"> New</span> </i>New</h2>
<?php
$newquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases INNER JOIN DBRanking ON DBRanking.Key_ID = Dbases.Key_ID INNER JOIN SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID WHERE SubjectList.SubjectCode = 'NEW' AND DBRanking.TryTheseFirst = 1 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY DBRanking.Ranking";
    $result = mysqli_query($conLuptonDB, $newquery) or die($error);

    if (!mysqli_num_rows($result)) {
        echo "There are no databases meeting the parameters:<p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
    } else {
        generatelist($result);
    } ?>
</div>

<?php
}
     //show multi on all pages?>
</div>
<?php
mysqli_close($conLuptonDB);
 }
 // reusable function to query subject splitting out content types (zero or one)
 function reuseSubjQuery($num, $queryKey)
 {
     return "SELECT DISTINCT SubjectList.Subject,
   IF (SubjectList.NotSubjectList = 0,'true','false') AS NotSubjectList
   FROM LuptonDB.SubjectList
   INNER JOIN LuptonDB.DBRanking
   ON DBRanking.Subject_ID = SubjectList.Subject_ID
   INNER JOIN LuptonDB.Dbases
   ON Dbases.Key_ID = DBRanking.Key_ID
   WHERE SubjectList.NotSubjectList = 0 AND SubjectList.Subject_ID <> 59 AND SubjectList.Format=".$num." ".$queryKey."
   ORDER BY SubjectList.Subject
   ";
 }
 function generatelist($result)
 {
     echo "<ul class='s-lg-link-list'>";
     while ($row = mysqli_fetch_array($result)) {
         echo "<li><a href='";
         if (!empty($row['ShortURL'])) {
             echo "https://www.utc.edu/" . $row['ShortURL'];
         } else {
             echo "/scripts/LGForward.php?db=" . $row['Key_ID']  ;
         }
         echo"' target='_blank'>" . $row['Title'] . "</a>";
         if (!empty($row['ContentType'])) {
             echo "<div class='s-lg-link-desc'><span class='contentType'><span class='strong'>" . $row['ContentType'] . ": </span></span>";
         }
         echo $row['ShortDescription'];
         if (!empty($row['HighlightedInfo'])) {
             echo "<span class='highlightedInfo'>  " . $row['HighlightedInfo'] . "</span>";
         }
         if (!empty($row['SimUsers'])) {
             if ($row['SimUsers'] == 1) {
                 echo "<span class='highlightedInfo'>  Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
             } elseif ($row['SimUsers'] > 1) {
                 echo "<span class='highlightedInfo'>  Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
             }
         }
         echo "</div></li>";
     }
     echo "</ul>";
 }
include($_SERVER['DOCUMENT_ROOT']."/includes/foot.php");
echo "
<script>$(document).ready(function() {
  var url = window.location.pathname;
  var filename = url.substring(url.lastIndexOf('/')+1);
  $( '.subjects li' ).each(function() {
    var subject = $( this ).text();
    if (subject =='New'){
      //$(this).html('<span class=\"badge badge-success\">NEW !</span>');
      //$(this).closest('li').addClass('pull-right');
      $(this).closest('li').hide();
    }else{
      if (subject.indexOf('Subject') <= -1){
    $(this).html('<a href=\"'+ filename + '?subj=' + subject + '\">' + subject + '</a>');
    }
}
  });
});</script>";
?>
<!-- add any additional footer code here -->
