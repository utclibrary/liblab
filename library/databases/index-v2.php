<?php
// updates for v2 bootstrap 4 only
//error reporting - default N offx
$errorReporting = "Y";
//template system to replicate main website look and feel
$title = "Databases | UTC Library";
$description = "Databases available at the UTC Library.";
$keywords = "databases";
//in case you need to add anything in the head or footer
$addhead = "";
$addfoot = "";
//show or hide help button
$help = "show";
// include new head and php functions for db display - reused for lg lists
include($_SERVER['DOCUMENT_ROOT']."/includes/head-v2.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.inc");
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
// connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
// declare variables
$lastLetter = "";$currentLetter = "";//used with $currentletter to track and insert alpha for each group in list
$error = "An error has occurded";//set database error message
//  set variables in case paramater is not passed
$typeExists = 0;
$subjectExists = 0;
$alpha = "ALL";
$queryKey = "";
$queryKeySubj = "";
$urlsubjappend="";
$queryKeySubjAtoZ="";
$outputSLA = "";
$outputLG = "";
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
if (isset($_GET["subj"])&&($_GET["subj"] !== "All")) {
    $subj = htmlentities($_GET["subj"]);
    $h1Prepend = str_replace('Databases','',$subj);
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
    $('ul#alphalist > li > a.alpha').css('cursor', 'default');
    //override hover functions
    $('a.alpha').hover(function() {
    $(this).css('background-color', '#dde6ee');
    $(this).css('color','#00386b');
}, function() {
    $(this).css('background-color', '#dde6ee');
    $(this).css('color','#00386b');
});
//prevent click function
    $('ul#alphalist > li > a.alpha').click(function(e){
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
        echo "<style>h2.badge,div.subjects{display:none;}</style>";
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
        $outputSLA .= "<div id='outputSLA' class='featureBox'>
				<h3 id='subjectList' class='featureTitle'>Subject";
        $outputSLA .= "</h3><hr class='featureHR'/><ul>";
        while ($row = mysqli_fetch_array($resultSLA)) {
					if (($row['Format'] === "type")&&($typeExists === 0)){
						$outputSLA .= "</ul><h3 id='typeList' class='featureTitle'>Type</h3><hr class='featureHR'><ul>";
					}
            $outputSLA .= "<li class='".$row['Format']."'><a href=\"".$currentFile."?subj=".$row['Subject']."\">".$row['Subject']."</a></li>";
						if ($row['Format'] === "type"){$typeExists++;}
						if ($row['Format'] === "subject"){$subjectExists++;}
        }
        $outputSLA .= "</ul></div>";
    }

    //echo $outputSLA;
}//close letter set
// this changes dynamcially based on subject paramater - jquery updates the page title
echo "
<div class='row'>
<div class='col'>
<div class='filters'>
  <div id='alpha' class='row'>
	<div class='col'>";
	if (($alpha === "ALL")&&($subj === "A to Z")&&($vendor === "")&&($contentType === "")) {
			//echo "<a id='atoz-reset-btn-disabled' class='active btn btn-large'>RESET</a>";
	} else {
			echo "<a id='atoz-reset-btn' class='active btn btn-large btn-danger' href='".$currentFile."?alpha=ALL'>RESET</a>";
	}
echo "<h1>".$h1Prepend." Databases".$displayAlpha."</h1>
<h2>Filtering Options</h2>
<script type='text/javascript'>
    $(document).ready(function() {
        document.title = \"".$h1Prepend." Databases".$displayAlpha." | UTC Library\";
    });
</script>";
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
echo "

<ul id='alphalist' class='nav nav-fill'>";

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
</div><!-- close #alpha .col -->
</div><!-- close #alpha -->";
// get a list of current subjects for select box exclude
$querySubjectList = reuseSubjQuery(0, "");

$resultSL = mysqli_query($conLuptonDB, "set names 'utf8'");
$resultSL = mysqli_query($conLuptonDB, $querySubjectList) or die($error);
  echo "<div class='row topMargin'>
	<div class='col-lg-7'>
";
  //show search box only on full atoz
  if (($subj === "A to Z")&&($alpha === "ALL")) {
      echo"";
  }
      //show subject select box atoz and subject selected
//if ($alpha === "ALL"){
echo "
<div class='row topMargin' id='searchbox'>
	<div class='col'>
		<div class='form-group'>
			<label for='search-highlight'>Search</label>
				<span class='fa fa-search search-icon'></span>
					<input id='search-highlight' class='form-control clearable' autocomplete='off' name='search-highlight' type='text' placeholder='Databases by name or description' data-list='.highlight_list' data-toggle='tooltip' title='SEARCH' />
		</div><!-- .form-group -->
  </div><!-- .col -->
</div><!-- .row -->
<div class='row'>
	<div class='col-md topMargin'>
      <label for='subjectSelect'>Limit by Subject</label>
      <select class='form-control' id='subjectSelect'>
      <option>All</option>";
  while ($row = mysqli_fetch_array($resultSL)) {
      echo "<option";
      if (strpos($row['Subject'], $subj) === 0) {
          echo " selected='selected' ";
      }
      echo" value=\"".$row['Subject']."\">".$row['Subject']."</option>";
  }
  echo "</select></div><!-- .com-md .topMargin -->
	<div class='col-md topMargin'>";
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
      <label for='typeSelect'>Limit by Type</label>
      <select class='form-control' id='typeSelect' ".$resultTLdisabled.">
      <option>All</option>";
  while ($row = mysqli_fetch_array($resultTL)) {
      echo "<option";
      if (strpos($row['Subject'], $subj) === 0) {
          echo " selected='selected' ";
      }
      echo" value=\"".$row['Subject']."\">".$row['Subject']."</option>";
  }
  echo "</select></div><!-- .com-md .topMargin -->";
//}
// END select by type

    echo"</div></div>
		<div class='col-lg-5 topMargin'>";
		if ($outputSLA === ""){
?>
		            <div class="featureBox">
		              <h3 class="featureTitle"><span class="fa fa-star"></span>&nbsp;Featured Database</h3>
		              <hr class="featureHR">
									<?php
								  $randquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases
								  WHERE Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 AND Dbases.Key_ID <> 529 ORDER BY RAND() LIMIT 1";
								     $result = mysqli_query($conLuptonDB, $randquery) or die($error);

								     if (!mysqli_num_rows($result)) {
								         echo "There are no databases meeting the parameters:<p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
								     } else {
								         generatelist($result);
								     } ?>
		            </div><!-- close feature box -->
  <?php
}else{
	// show subjects by alpha
	echo $outputSLA;
}
	echo "</div></div></div><!-- close .filters .col & .row -->
		";

// main query to generate lists of dbs
$query = "SELECT Dbases.Title, Dbases.NotProxy, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL, DBRanking.TryTheseFirst, SubjectList.LibGuidesPage,VendorName,
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
    echo "
    <p id='totalResults'>Total results: " . $totalRows . "</p>";

    $i = 0;
    // loop through results
    while ($row = mysqli_fetch_array($result)) {
        if ((strpos($row['Subjects'], $subj) !== false)||($subj==="A to Z")) {
            // if subj show Libguide once
            if ($i == 0) {
                if ((!empty($row['LibGuidesPage']))&&($subj != "A to Z")) {
                    $outputLG = $row['LibGuidesPage'];
                }
                //if this is a subject list show alpha rank buttons
                if ($subj != "A to Z") {
                    ?>
      <div id="alphaRankedSortBtn" class="row">
        <button type="button" class="btn col btn-secondary active" id="numBtn">Ranked Sort</button>
        <button type="button" class="btn btn-secondary col" id="alphBtn">Alphabetical Sort</button>
      </div>

		<div id='subject_list_items' class='highlight_list'>

      <?php
                } else {
                    echo "<div class='highlight_list'>";
                }
                $i++;
            }
            // create styled letter SEPARATOR
            $currentletter = strtoupper(substr($row['Title'], 0, 1));
            if (($lastLetter != $currentletter)&&(preg_match("/[A-Z]|1/i", $currentletter))) {
                echo '<h2 id="Letter' . $currentletter .  '">' . $currentletter . '</h2>';
                $lastLetter = $currentletter;
            }
            // set condition for new but not subjects
            if (((strpos($row['Subjects'], $subj) !== false)&&($subj != "A to Z"))||($subj==='A to Z')) {
                echo "<div class='dbCard'>";
                if (($row['NotProxy']) === '1') {
                    echo "<span class='fa fa-unlock float-right' data-toggle='tooltip' title='Freely Available'></span>";
                }else{
                  echo "<span class='fa fa-lock float-right' data-toggle='tooltip' title='Requires Login'></span>";
                }
                if ((($row['TryTheseFirst']) === '1')&&($subj != "A to Z")) {
                    echo "<span class='badge badge-primary float-right'>Try First</span>";
                }
                if (strpos($row['Subjects'], '<li>New</li>') !== false) {
                    echo "<span class='badge badge-warning float-right'> NEW </span>";
                }
                echo "<h3 class='dbTitle'><a href='";
                if (!empty($row['ShortURL'])) {
                    echo "https://www.utc.edu/" . $row['ShortURL'];
                } else {
                    echo "/scripts/LGForward.php?db=". $row['Key_ID'];
                }
                echo"' target='_blank'>" . $row['Title'] . "</a></h3>";
                if (!empty($row['ContentType'])) {
                    echo "<p class='contentType'> <a href=\"".$currentFile."?type=".$row['ContentType']."\">". $row['ContentType'] . "</a>";
                }
                echo "<p>" . $row['ShortDescription'];
                if (!empty($row['HighlightedInfo'])) {
                    echo "<span class='highlighted-info'> " . $row['HighlightedInfo'] . "</span>";
                }
                if ($row['SimUsers'] == 1) {
                    echo "<span class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
                } elseif ($row['SimUsers'] > 1) {
                    echo "<span class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
                }
								echo "</p>";
                if (!empty($row['VendorName'])) {
                    echo "<p class='vendor'>Vendor: <a href=\"".$currentFile."?vendor=".$row['VendorName']."\"> ".$row['VendorName']." </a></p>";
                }
                if (!empty($row['Subjects'])) {
                    echo "<div class='subjects'><ul class='subjectTags'><li>Subject";
                    if ((strpos($row['Subjects'], '</li><li>') == false)||(preg_match('/^<li>(.*?)(?!<li>)(.*?)<li>New<\/li>$|^<li>New<\/li>(.*?)(?!<li>)(.*?)<\/li>$/', $row['Subjects']))) {//single item or single item + new
                    } else {
                        echo "s";
                    }
                    echo ": </li>".$row['Subjects']."</ul></div>";
                }
                echo "</div>";//close each item
            }
        }
    }
}
echo "</div><!-- highlight_list -->";

//this is where the content goes for the right menu could also use
// temp turn off but keep code for DOMEntityReference
$rightmenu = 0;
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
include($_SERVER['DOCUMENT_ROOT']."/includes/foot-v2.php");
echo "
<script src='//www.utc.edu/library/_resources/js/jquery.hideseek.min.js'></script>
<script>
$('#search-highlight').hideseek({
		min_chars: 3,
		highlight: true,
	nodata: 'No results found'
});
$(document).ready(function() {
  restartTooltip();
	$('html, body').animate({
        scrollTop: $('.filters').offset().top
    }, 500);
  var url = window.location.pathname;
  var filename = url.substring(url.lastIndexOf('/')+1);
  $( '.subjects li' ).each(function() {
    var subject = $( this ).text();
    if (subject =='New'){
      //$(this).html('<span class=\"badge badge-success\">NEW !</span>');
      //$(this).closest('li').addClass('float-right');
      $(this).closest('li').hide();
    }else{
      if (subject.indexOf('Subject') <= -1){
    $(this).html('<a href=\"'+ filename + '?subj=' + subject + '\">' + subject + '</a>');
    }
}
});";
echo "\n";
if ($outputLG != ""){
	echo "$('.featureBox').replaceWith(\"<div class='featureBox lgCard'><h3 class='featureTitle'>Research Guide</h3><hr class='featureHR'><ul class='s-lg-link-list'><li><a href='https://guides.lib.utc.edu/".$outputLG."' target='_blank'>".$subj."</a></li></ul></div>\");";
}
if ($typeExists > 1){
	echo "$('#typeList').append('s');";
}
if ($subjectExists > 1){
	echo "$('#subjectList').append('s');";
}
echo"
/* get content of totalCount */
var cloneTotalResults = $('#totalResults').text();
/* on keyup modify total results or reset to orig */
$('#search-highlight').keyup(function() {
		if ($(this).val() == '') { // check if value changed
			$('#totalResults').html(cloneTotalResults);
        $('#alphaRankedSortBtn').show();
		}
		else{
			var totalResults = $('.dbCard:visible').length;
				$('#totalResults').html('Total results: ' + totalResults);
		}
});
$('[data-toggle=\"tooltip\"]').tooltip();
$('h2#Letter1').text('#');
/* jquery for clearable fields */

// CLEARABLE INPUT
function tog(v){return v?'addClass':'removeClass';}
$(document).on('input', '.clearable', function(){
  $('#alphaRankedSortBtn').hide();
	$(this).addClass('input-hold');
	$('.clearable')[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
	$('.clearable')[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');  $(this).removeClass('input-hold');
}).on('touchstart click', '.onX', function( ev ){
  $(this).removeClass('input-hold');
	ev.preventDefault();
	$('.clearable').removeClass('x onX').val('').change();
	$('#totalResults').html(cloneTotalResults);
resetsearch();
});
var divContent = $('div.dbCard');
$('#numBtn').attr('disabled', 'disabled');
var sliContent = $('#subject_list_items').html();
$('#alphBtn').on('click', function () {
$('#numBtn').removeAttr('disabled');
$(this).attr('disabled', 'disabled');
var alphabeticallyOrderedDivs = divContent.sort(function (a, b) {
  //return $(a).find('a').text() > $(b).find('a').text();
  return $(a).find('a').text() > $(b).find('a').text()  ? 1 : -1;
});
$('#subject_list_items').html(alphabeticallyOrderedDivs);
restartTooltip();
});

$('#numBtn').on('click', function () {
$('#alphBtn').removeAttr('disabled');
$(this).attr('disabled', 'disabled');
$('#subject_list_items').html(sliContent);
  restartTooltip();
});
});/* close doc ready */
function resetsearch() {
    $('#alphaRankedSortBtn').show();
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
$( '#subjectSelect' ).change(function() {
  window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $( '#subjectSelect').val();
 });
 /* reload page on type select */
 $( '#typeSelect' ).change(function() {
   window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $( '#typeSelect').val();
  });
  function restartTooltip(){
    $('[data-toggle=\"tooltip\"]').tooltip();
  }
</script>";
?>
