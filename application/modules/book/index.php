<?php
$ext = pathinfo(strtolower($full_path), PATHINFO_EXTENSION);
echo "<script>var url = 'http://books.home/$full_path';</script>";


function nl2p($string) {
    $paragraphs = '';

    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }

    return $paragraphs;
}


function str_replace_first($from, $to, $content) { 
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $content, 1);
}

echo "<div class='card'><div class='card-body'><div class='row'>";

echo "<div class='col-sm-2'><img class='w-100 card-image rounded-top mb-1' src='/extract_cover.php?file=$full_path' />";
echo "<br><a class='btn btn-primary w-100' style='color: #fff;'  href='$full_path'>Скачать</a></div>";
echo "<div class='col-sm-10'>";


if ($ext == 'pdf') {
	include('/application/PDFInfo.php');
	$pdf = new PDFInfo($full_path);

	echo "<h1>$pdf->title</h1>";
	echo "<b>$pdf->author</b><br>";
	echo "<b>$pdf->creator</b><br>";
	echo "<b>$pdf->producer</b><br>";

}

if ($ext == 'epub') {
	include('/application/epub.php');
	$e = new EPub($full_path);
	echo "<h1>" . $e->Title() . "</h1>";
	$a = implode(', ', $e->Authors());
	echo "<b>$a</b><br>";
	echo "ISBN: " . $e->ISBN() . "<br>";
	echo "<p>" . $e->Description() . "</p>";
	$s = implode(', ', $e->Subjects());
	echo "<i>$s</i>";
}


echo '</div></div></div></div>';


echo "<div id='reader' class='reader'>";

if ($ext == 'fb2') {
	include('fb.php');
}

if ($ext == 'txt') {
	include('txt.php');
}

if ($ext == 'epub') {
	include('epub.php');
}

if ($ext == 'pdf') {
	include('pdf.php');
}

if ($ext == 'mobi') {
	include('mobi.php');
}

if (($ext == 'djvu') || ($ext == 'djv')) {
	include('djvu.php');
}

if ($ext == 'rtf') {
	include('rtf.php');
}

if ($ext == 'docx') {
	include('docx.php');
}

if (($ext == 'html') || ($ext == 'htm')) {
	include('html.php');
}

if ($ext == 'jpg') {
	echo "<img style='width:100%;' src='$full_path' />";
}
if ($ext == 'jpeg') {
	echo "<img style='width:100%;' src='$full_path' />";
}
if ($ext == 'gif') {
	echo "<img style='width:100%;' src='$full_path' />";
}
if ($ext == 'png') {
	echo "<img style='width:100%;' src='$full_path' />";
}




if ($ext == 'avi') {
	echo "<video style='width:100%;' src='$full_path' />";
}

?>
</div>
