<!DOCTYPE html>
<html>
<head>
	<title><?php echo htmlspecialchars(CNavigation::getTitle()); ?> - WebDiskettes</title>
<?php foreach (CHead::$css as $css)
{
	echo "\t<link href=\"$ROOT_PATH/Css/$css.css\" media=\"screen\" rel=\"Stylesheet\" type=\"text/css\" />\n";
}
foreach (CHead::$js as $js)
{
	echo "\t<script type=\"text/javascript\" src=\"$ROOT_PATH/Js/$js.js\"></script>\n";
}
?>
</head>
<body>
<?php

if (!defined('NO_HEADER_BAR')) {

	/*$url_redaction = CNavigation::generateUrlToApp('Redaction',null,null);
	$url_logout = CNavigation::generateUrlToApp('Session','logout',null);*/

	$title = htmlspecialchars(CNavigation::getBodyTitle());

	$url_root = CNavigation::generateUrlToApp(null);
	echo <<<END
<div class="topbar">
	<div class="fill">
		<nav class="container">
			<h3><a href="$url_root">WebDiskettes</a></h3>
			<ul>
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
			</ul>
			<form action="">
				<input type="text" placeholder="Search">
			</form>
		</nav>
	</div>
</div>
END;
}

if (DEBUG) {
	showGroaw();
}
?>
<div class="container">
<?php
echo $PAGE_CONTENT;
?>
</div>
</body>
</html>
