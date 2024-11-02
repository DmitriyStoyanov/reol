<?php
$content = '';
$fb2 = simplexml_load_file($full_path);
echo ($fb2 ? '' : 'FB2 Parse Error'), PHP_EOL;

$images = array();
foreach ($fb2->binary as $binary) {
	$id = $binary->attributes()['id'];
	$images["$id"] = $binary;
}

if (isset($fb2->body->section)) {
	foreach ($fb2->body->section as $section) {
		$s = $section->asXML();
		$s = str_replace("<title>", "<subtitle>", $s);
		$s = str_replace("</title>", "</subtitle>", $s);
		$s = str_replace('<image l:href="#', '<img src="', $s);
		foreach (array_keys($images) as $i) {
			$s = str_replace($i, "data:image/jpeg;base64," . $images[$i], $s);
		}
		$content .= $s;
	}
} else {
	$s = $fb2->body->asXML();
	$s = str_replace("<title>", "<subtitle>", $s);
	$s = str_replace("</title>", "</subtitle>", $s);
	$s = str_replace('<image l:href="#', '<img src="', $s);
	foreach (array_keys($images) as $i) {
		$s = str_replace($i, "data:image/jpeg;base64," . $images[$i], $s);
	}
	$content .= $s;
}
echo str_replace("<p>***</p>",  '<div class="divider div-transparent div-dot"></div>', str_replace("section>>", "section>", $content));

