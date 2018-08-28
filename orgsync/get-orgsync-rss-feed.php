<?php
//generate all list
$feedUrl2 ="https://mocsyncorgs.utc.edu/organization/utc-library/events.rss";
$data2 = file_get_contents($feedUrl2);
$file2 = fopen('/var/www/html/orgsync/orgsync-feed.txt',"w");
echo fwrite($file2,$data2);
fclose($file2);
echo "<br />all:".md5_file('/var/www/html/orgsync/orgsync-feed.txt');
// get blog alerts
//generate all list
$feedUrlAlerts ="https://blog.utc.edu/library/category/alerts/feed/";
$dataAlerts = file_get_contents($feedUrlAlerts);
$fileAlerts = fopen('/var/www/html/orgsync/alerts-rss.txt',"w");
echo fwrite($fileAlerts,$dataAlerts);
fclose($fileAlerts);
echo "<br />all:".md5_file('/var/www/html/orgsync/alerts-rss.txt');
?>
