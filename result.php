<?php

require_once('simple_html_dom.php');
function resultGoogle($url){

$url_en = str_replace(' ','+',$url);

$html = file_get_html('https://www.google.com/search?q=allintitle:'.$url_en.'&filter=0');


// Find all images
$result = $html->find('div[id="resultStats"]',0);
$res = intval(filter_var($result->innertext,FILTER_SANITIZE_NUMBER_INT));
if($res>=3)
	return True;
else
	return False;
}


?>
