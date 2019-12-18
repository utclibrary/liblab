<?php
//error reporting - default N offx
$errorReporting = "N";
//template system to replicate main website look and feel
$title = "Databases | UTC Library";
$description = "Databases available at the UTC Library.";
$keywords = "databases";
//in case you need to add anything in the head or footer
$addhead = "<link rel='stylesheet' type='text/css' href='/includes/css/introjs.css' media='all'>";
$addfoot = "<script type='text/javascript' src='/includes/js/intro.js'></script>";
//show or hide help button
$help = "show";
// include new head and php functions for db display - reused for lg lists
include($_SERVER['DOCUMENT_ROOT']."/includes/head.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.inc");
// Get current file name and directory to use in links
$currentFile = $_SERVER['PHP_SELF'];
// connect to database
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php';
// declare variables
$lastLetter = "";$currentLetter = "";//used with $currentletter to track and insert alpha for each group in list
$error = "An error has occurded";//set database error message
//  set variables in case paramater is not passed
$typeExists = $subjectExists = 0;
$alpha = "ALL";
$queryKey = $queryKeySubj = $outputSLA = $outputLG = $h1Prepend = $contentType = $queryContentType = "";
if (isset($_GET["type"])) {
    $contentType = htmlentities($_GET["type"]);
    $h1Prepend = $contentType;
    $queryContentType = "AND ContentType = '" .$contentType. "'";
}
// get subject param if set
if (isset($_GET["subj"])&&($_GET["subj"] !== "All")) {
    $subj = htmlentities($_GET["subj"]);
    $h1Prepend = str_replace('Databases', '', $subj);
    // ignore limit by subject selection
    if (strpos($subj, 'Limit') !== false) {
        // if no subject change var and query used in $query
        $subj = "A to Z";
        $orderby = "Dbases.Title";
    } else {
        echo"
  <script>
  $(document).ready(function() {
    $('ul#alphalist > li').each(function(){
      $(this).addClass('emptyAlpha');
    });
  });
  </script>
  ";
        // sanitize
        $subject = preg_replace('/[^a-zA-Z0-9]+/', '%', $subj);
        // set query variables for subjects used in main $query
        $queryKeySubj = "AND SubjectList.Subject LIKE '".$subject."'";
        // hide alpha badges on subject pages
        echo "<style>h2.badge,div.subjects{display:none;}</style>";
        // set order by used in $query
        $orderby = "DBRanking.Ranking";
        //hide letter badges on clear search
        //echo "<style>.highlight_list h2[id^='Letter']{display:none;}</style>";
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
            if (($row['Format'] === "type")&&($typeExists === 0)) {
                $outputSLA .= "</ul><h3 id='typeList' class='featureTitle'>Type</h3><hr class='featureHR'><ul>";
            }
            $outputSLA .= "<li class='".$row['Format']."'><a href=\"".$currentFile."?subj=".$row['Subject']."\">".$row['Subject']."</a></li>";
            if ($row['Format'] === "type") {
                $typeExists++;
            }
            if ($row['Format'] === "subject") {
                $subjectExists++;
            }
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
  ?>
  <button class="btn fas fa-info-circle pageInfoPopper" data-toggle="popover" a="" href="#" data-popover-content="#pageInfo" data-original-title="" title="" aria-describedby="popover276455"></button>

  <?php
echo "<h1>".$h1Prepend." Databases".$displayAlpha."</h1>
<script type='text/javascript'>
    $(document).ready(function() {
        document.title = \"".$h1Prepend." Databases".$displayAlpha." | UTC Library\";
    });
</script>";
?>
<div id="pageInfo" class="hidden">
   <div class="popover-heading"><span class="infoHeading">What is this page?</span></div>
   <div class="popover-body"><p>Databases contain searchable collections of published resources, including articles, ebooks, images, and more! Use this page to select the database that best meets your information needs.</p>
   <div class="popoverQL"><h2>Related Resources</h2>
   <ul>
   <li><a href="https://utc.primo.exlibrisgroup.com/discovery/search?vid=01UTC_INST:01UTC&lang=en" target="_blank">Quick Search</a><p>Search the library's physical resources, and many electronic resources, in a single search.</li>
   <li><a href="https://www.utc.edu/library/help/tutorials/reseach-basics.php" target="_blank">Research Basics</a><p>Need help getting started? Begin with the basics!</p></li>
   <li><a href="https://www.utc.edu/library/about/electronic-resource-use.php" target="_blank">Electronic Resource Use Policy</a><p>Guidelines for using the library’s online resources.</li>
   </div>
   </div>
   </div>
<?php
//check for alpha in db
$alphaListFull="";
// query to generate a to z
$queryAlpha = "SELECT DISTINCT
LEFT(Title, 1) as letter
FROM LuptonDB.Dbases
LEFT JOIN LuptonDB.DBRanking
ON Dbases.Key_ID = DBRanking.Key_ID
LEFT JOIN LuptonDB.SubjectList
ON DBRanking.Subject_ID = SubjectList.Subject_ID
WHERE Dbases.Key_ID <> 529 AND Dbases.Masked = 0 ".$queryKeySubj.$queryContentType."
ORDER BY letter";
//echo "<pre>".$queryAlpha."</pre>";
$alphaList = mysqli_query($conLuptonDB, "set names 'utf8'");
$alphaList = mysqli_query($conLuptonDB, $queryAlpha) or die($error);
while ($row = mysqli_fetch_array($alphaList)) {
    $alphaListFull .= $row['letter'];
}
echo "

<ul id='alphalist' class='nav nav-fill'>";

foreach (range('A', 'Z') as $column) {
    if ($column == $alpha) {
        echo "<li class='active'>";
    } elseif (strpos($alphaListFull, $column) !== false) {
        echo "<li>";
    } else {
        // if letter not in query change class to grey it out
        echo "<li class='emptyAlpha'>";
    }
    echo "<a class='alpha' href=\"".$currentFile."?alpha=".$column."\"> ".$column." </a></li>";
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
echo "
<div class='row topMargin' id='searchbox'>
	<div class='col'>
		<div class='form-group'>
			<label for='search-highlight'>Search</label>
				<span class='fa fa-search search-icon'></span>
					<input id='search-highlight' class='form-control clearable' autocomplete='off' name='search-highlight' type='text' placeholder='Databases by name or description' data-list='.highlight_list'/>
		</div><!-- .form-group -->
  </div><!-- .col -->
</div><!-- .row -->
<div id='limitByGroup' class='row'>
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
  if ((($subj !== "A to Z")&&($alpha === "ALL"))or($alpha !== "ALL")) {
      //only scroll after selecting action
      echo "
    <script type='text/javascript'>
        $(document).ready(function() {
          scrollToBox();
        });
    </script>";
  }
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
// END select by type
    echo"</div>";
    if (($alpha === "ALL")&&($subj === "A to Z")&&($contentType === "")) {
    } else {
        echo "<div class='row topMargin'>
                <div class='col'>
                               <a id='atoz-reset-btn' class='active btn btn-large btn-danger' href='".$currentFile."?alpha=ALL'>RESET</a>
                </div>
              </div>";
    }
    echo"</div><!-- close col-lg-7 -->
		<div class='col-lg-5 topMargin'>";
        if (($outputSLA === "")&&($alpha === "ALL")) {
            ?>
<div class="featureBox">
<p><strong>New Here?</strong></p> <p>Take a moment to learn about this page.</p>

<a href="javascript:void(0);" onclick="showIntro();" class="btn btnFeature">
<span class="fas fa-info-circle"></span>
    <strong> Start Tour</strong>
</a>
</div>
<?php
        } elseif (($outputSLA === "")&&($alpha !== "ALL")) {
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
        } else {
            // show subjects by alpha
            echo $outputSLA;
        }
    echo "</div></div></div><!-- close .filters .col & .row -->
		";
    // wrap in conditional to check for default page
    if (($subj === "A to Z")&&($alpha === "ALL")) {
        ?>
<div id="promos" class="row">
<div class="col-lg-8 row-eq-height">
    <div class="promoCard1">
    <h2 class="promoTitle">
<span class="fa fa-star"></span>&nbsp;Multisubject Databases</h2>
<?php
$multiquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases INNER JOIN DBRanking ON DBRanking.Key_ID = Dbases.Key_ID INNER JOIN SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID WHERE SubjectList.SubjectCode = 'MULTI' AND DBRanking.TryTheseFirst = 0 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY DBRanking.Ranking";
        $resultMulti = mysqli_query($conLuptonDB, $multiquery) or die($error);
        if (!mysqli_num_rows($resultMulti)) {
            echo "There are no databases meeting the parameters: <p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
        } else {
            generatelist($resultMulti);
        } ?>
       </div>
    </div>
    <div class="col-lg-4 row-eq-height">
    <div class="promoCard2">
    <h2 class="promoTitle">
<span class="fas fa-bullhorn"></span>&nbsp;New Databases</h2>
<?php
$newquery = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers, Dbases.ShortURL FROM Dbases INNER JOIN DBRanking ON DBRanking.Key_ID = Dbases.Key_ID INNER JOIN SubjectList ON DBRanking.Subject_ID = SubjectList.Subject_ID WHERE SubjectList.SubjectCode = 'NEW' AND DBRanking.TryTheseFirst = 1 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY DBRanking.Ranking";
        $result = mysqli_query($conLuptonDB, $newquery) or die($error);
        if (!mysqli_num_rows($result)) {
            echo "There are no databases meeting the parameters:<p>sub=$subject</p><p>set=$set</p><p>ebks=$ebks</p>";
        } else {
            generatelist($result);
        } ?>
      </div>
    </div>
    </div>
<?php
    }//end check to show promo content on default page
// main query to generate lists of dbs
$query = "SELECT Dbases.Title, Dbases.NotProxy, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.TutorialURL, Dbases.SimUsers, Dbases.ShortURL, DBRanking.TryTheseFirst, SubjectList.LibGuidesPage,GROUP_CONCAT( DISTINCT '<li>' , SubjectList.Subject , '</li>' ORDER BY SubjectList.Subject SEPARATOR '') AS Subjects
          FROM LuptonDB.Dbases
          LEFT JOIN LuptonDB.DBRanking
          ON DBRanking.Key_ID = Dbases.Key_ID
          LEFT JOIN LuptonDB.SubjectList
          ON DBRanking.Subject_ID = SubjectList.Subject_ID
					WHERE Dbases.Key_ID <> 529 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ".$queryKey.$queryKeySubj.$queryContentType."
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
    <div class='row align-items-end'>
    <div class='col-lg-6'>
    <p id='totalResults'>Total results: " . $totalRows . "</p>
    </div>";
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
    <div class="col-lg-6">
      <div id="alphaRankedSortBtn" class="row">
        <div id="alphaRankedSortBtn" class="btn-group" role="group" aria-label="Sorting options">
        <button type="button" class="btn btn-secondary active" id="numBtn">Ranked Sort</button>
        <button type="button" class="btn btn-secondary" id="alphBtn">Alphabetical Sort</button>
      </div>
      </div>
    </div>

</div>
		<div id='subject_list_items' class='highlight_list'>
      <?php
                } else {
                    echo "</div><div class='highlight_list'>";
                }
                $i++;
            }
            // create styled letter SEPARATOR
            $currentletter = strtoupper(substr($row['Title'], 0, 1));
            if ($currentletter === "1") {
                $currentletter = "#";
            }
            if (($lastLetter != $currentletter)&&(preg_match("/[A-Z]|#/i", $currentletter))) {
                echo '<h2 id="Letter' . $currentletter .  '">' . $currentletter . '</h2>';
                $lastLetter = $currentletter;
            }
            // set condition for new but not subjects
            if (((strpos($row['Subjects'], $subj) !== false)&&($subj != "A to Z"))||($subj==='A to Z')) {
                echo "<div class='dbCard'>";
                if (($row['NotProxy']) === '1') {
                    echo "<span class='fa fa-unlock float-right' data-toggle='tooltip' title='Freely Available'></span>";
                } else {
                    echo "<span class='fa fa-lock float-right' data-toggle='tooltip' title='Requires UTC ID'></span>";
                }
                if ((($row['TryTheseFirst']) === '1')&&($subj != "A to Z")) {
                    echo "<span class='badge badge-primary float-right'>Try First</span>";
                }
                if (strpos($row['Subjects'], '<li>New</li>') !== false) {
                    echo "<span class='badge badge-warning float-right'> NEW </span>";
                }
                //if (!empty($row['ContentType'])) {
                //  echo "<p class='contentType'> <a href=\"".$currentFile."?type=".$row['ContentType']."\">". $row['ContentType'] . "\n</a>";
                //}
                echo "<h3 class='dbTitle'><a href='";
                if (!empty($row['ShortURL'])) {
                    echo "https://www.utc.edu/" . $row['ShortURL'];
                } else {
                    echo "/scripts/LGForward.php?db=". $row['Key_ID'];
                }
                echo"' target='_blank'>" . $row['Title'] . "\n</a></h3>";

                echo "<p>" . $row['ShortDescription'];
                if (!empty($row['HighlightedInfo'])) {
                    echo "<span class='highlighted-info'> " . $row['HighlightedInfo'] . "</span>";
                }
                if ($row['SimUsers'] == 1) {
                    echo "<span class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
                } elseif ($row['SimUsers'] > 1) {
                    echo "<span class='limitTo'> Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
                }
                /* START add TutorialURL link */
                if (!empty($row['TutorialURL'])) {
                   echo "<span class='tutorialLink'><span class='fa fa-question-circle'></span> <a href=\"".$row['TutorialURL']."\" target=\"_blank\"> ".$row['Title']." Tip Sheet</a></span>";
               }
               /* END add TutorialURL link */
                echo "</p>";
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
include($_SERVER['DOCUMENT_ROOT']."/includes/foot.php");
echo "
<script src='/includes/js/jquery.hideseek.mod.js'></script>
<script src='/includes/js/db.js'></script>
<script>
$(document).ready(function() {";
echo "\n";
if ($outputLG != "") {
    echo "$('.featureBox').replaceWith(\"<div class='featureBox lgCard'><h3 class='featureTitle'>Research Guide</h3><hr class='featureHR'><ul class='s-lg-link-list'><li><a href='https://guides.lib.utc.edu/".$outputLG."' target='_blank'>".$subj."</a></li></ul><div class='subjectGuideDesc'>Looking for more? Check out our research guide for books, websites, and other suggested resources curated by UTC Librarians.</div></div>\");";
}
if ($typeExists > 1) {
    echo "$('#typeList').append('s');";
}
if ($subjectExists > 1) {
    echo "$('#subjectList').append('s');";
}
echo"
});/* close doc ready */
</script>";
?>
