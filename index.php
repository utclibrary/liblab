<?php 
$timestamp = filemtime(__FILE__);
$date = date('D, F j g:i A', $timestamp);
echo "Page last updated " . $date;
phpinfo(); 
?>
