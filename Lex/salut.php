<?php
$version = isset($_REQUEST['version']) ? ((int) $_REQUEST['version']) : 2;
$data = file_get_contents("$version.html");
//ini_set('pcre.backtrack_limit', strlen($data)+10000);

// Delete scripts
$data = preg_replace('/<script[^>]+\/>/Uis', '', $data);
$data = preg_replace('/<script.+<\/script.*>/iUs', '', $data);

// Deletes onclick onmousemoveand…
$data = preg_replace_callback('/<(.+)>/sU', function ($m) {

		$r = $m[1];

		$r = preg_replace('/on\w+\s*=\s*".*"/isU', '', $r);
		$r = preg_replace('/on\w+\s*=\s*.*(\s|$)/isU', '', $r);

		$r = preg_replace_callback('/href\s*=\s*"(.*)"/isU', function ($mm) {

			return "href=\"\"";//$mm[1];
			}, $r);
		return "<$r>";
		}, $data);

//echo '<pre>',htmlspecialchars($data), '</pre>';


echo '<pre>',htmlspecialchars($data), '</pre>';//, $data;

?>
