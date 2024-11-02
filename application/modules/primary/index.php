<?php

if (isset($_GET['delete'])) {
	$fn = urldecode($_GET['delete']);
	unlink($fn);
}


echo '<nav aria-label="breadcrumb">  <ol class="breadcrumb">';

$c = '/?path=';
$bb = explode('/', $path);
echo "<li class='breadcrumb-item'><a href='/'>Архив</a></li>";
foreach ($bb as $b) {
	$c .= $b . '/';
	if (($b != '') && ($b != 'storage')) {
		echo "<li class='breadcrumb-item'><a href='$c'>$b</a></li>";
	}
}

echo '</ol></nav>';

echo '<div class="row">';
foreach(glob("$path*", GLOB_ONLYDIR) as $dir) {
	show_folder("$dir/");
}

echo '</div>';

echo '<div class="row">';
$fs = array_slice(scandir("$path"), 2);
foreach ($fs as $f) {
	if ('.' !== $f && '..' !== $f) {
		if (is_file("$path/$f")) {
			show_book("$path/$f", $f);
		}
	}
}

echo '</div>';

