<?php
// Based on http://www.realisingdesigns.com/2009/10/29/using-google-docs-as-a-quick-and-easy-cms/
// $expires default is = 5

function getUrl($url, $expires = 0)
{
	$cache_file = '/var/www/html/c4l-cha/cache/' . preg_replace('~\W+~', '-', $url) . '.txt';
// default next line (time() - 60 *
	if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * $expires ))) {
		return file_get_contents($cache_file);
	}

	/*
	$options = array(
		'http'=>array(
			'method'=> "GET",
			'header'=>
					"Accept-language: en\r\nUser-Agent: Just A Simple Request-er :)\r\n" // i.e. An iPad
					/*
					//"Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
					"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
					*
		)
	);

	$file = file_get_contents($url, false, stream_context_create($options));
	*/
	$file = file_get_contents($url);

	// Our cache is out-of-date, so load the data from our remote server,
	// and also save it over our cache for next time.
	$file = file_get_contents($url);
	//file_put_contents($cache_file, $file, LOCK_EX);
	return $file;
}

function getGoogleDoc($id)
{
	$content = getUrl("https://docs.google.com/document/pub?id=".$id);

	$start = strpos($content,'<div id="contents">');
	$end = strpos($content,'<div id="footer">');

	$content = substr($content, $start, ($end-$start));

	// Fix all embeded image references
	$content = str_replace('src="', 'src="https://docs.google.com/document/', $content);

	return $content;
}
?>
