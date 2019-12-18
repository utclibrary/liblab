<?php
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
//set persistent API variable
$lgApiContent = file_get_contents("http://lgapi-us.libapps.com/1.1/guides?site_id=197&key=79bdc1495b75e4857998a4bf192051a6&sort_by=name&status=1");
// check to see if LibGuide exists
function checkLGExists($api, $url){
  return strpos($api, $url);
}
//get LibGuide description if it exists
// function getLGDescription($api, $url){
//   $parsed = get_string_between($api, 'description', '"friendly_url":"'.$url );
//   $part = substr($parsed, strrpos($parsed, "{"));
//   $description = get_string_between($part, "description\":\"", "\",\"redirect_url\"");
//   return $description;
// }
// function get_string_between($string, $start, $end){
//     $string = ' ' . $string;
//     $ini = strpos($string, $start);
//     if ($ini == 0) return '';
//     $ini += strlen($start);
//     $len = strpos($string, $end, $ini) - $ini;
//     return substr($string, $ini, $len);
// }
