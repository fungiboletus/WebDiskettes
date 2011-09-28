<?php
$version = isset($_REQUEST['version']) ? ((int) $_REQUEST['version']) : 2;
$data = file_get_contents("$version.html");
//ini_set('pcre.backtrack_limit', strlen($data)+10000);

// Delete scripts
$data = preg_replace('/<\s*script[^>]+\/>/Uis', '', $data);
$data = preg_replace('/<\s*script.+<\s*\/\s*script.*>/iUs', '', $data);

// Deletes onclick onmousemoveand…
$data = preg_replace_callback('/<(\s*)(\w+)(\s)(.+)>/sU', function ($m) {

		$b = strtolower($m[2]);
		$r = $m[4];
		//echo $b, ' --- ', $r,'<br/>';

		$r = preg_replace('/on\w+\s*=\s*((".*")|(\S+(\s|$)))/isU', '', $r);

		/*
			Cette expression est un peu compliquée.
			Il y a deux cas à gérer, si la cible du lien est bien entre quotes, ou
			qu'elle ne l'est pas. Si elle ne l'est pas, il y a si élements dans $mm, au lieu de 4.
		 */
		$r = preg_replace_callback('/(href|src)\s*=\s*(("(.*)")|((\S+)(\s|$)))/isU', function ($mm) use($b) {

			if (count($mm) === 8) {
				$href = $mm[6];
			} else {
				$href = $mm[4];
			}

			/*echo '<pre>';
			print_r($mm);
			var_dump($href);
			echo '</pre>';*/

			if ($b === 'base') {
				echo "waw une nouvelle base<br/>";
			}
			$url = htmlspecialchars($href);//'about:blank';
			return "{$mm[1]}=\"$url\"";//$mm[1];
		
		}, $r);

		//echo "-------------<br/>";
		return "<{$m[1]}{$m[2]}{$m[3]}$r>";

	}, $data);

//echo '<pre>',htmlspecialchars($data), '</pre>';


echo '<pre>',htmlspecialchars($data), '</pre>', $data;

?>
