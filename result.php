<?php

require_once('simple_html_dom.php');
//$html = file_get_html('https://www.google.com/search?q=allintitle:Dimitri+Payet+faces+battle+to+earn+Euro+2016+spot+for+France&filter=0');
$html = file_get_html('https://www.google.com/search?client=firefox-b-ab&biw=1366&bih=696&noj=1&q=ljhh&oq=ljhh&gs_l=serp.3..0j0i10k1l2j0i10i46k1j46i10k1l2j0i10k1l4.2698592.2699003.0.2699788.4.4.0.0.0.0.336.336.3-1.1.0....0...1c.1.64.serp..3.1.335.AWA9Xfm5Og8');

// Find all images
$result = $html->find('div[id="resultStats"]',0);
$res = intval(filter_var($result->innertext,FILTER_SANITIZE_NUMBER_INT));
var_dump($res);


?>
