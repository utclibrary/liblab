<?php
function generatelist($result){
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
            echo "<div class='s-lg-link-desc'><span class='contentType'><strong>" . $row['ContentType'] . ": </strong></span>";
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
?>
