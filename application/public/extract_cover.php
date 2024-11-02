<?php
header('Content-Type: image/jpeg');

if (isset($_GET['file'])) {
	$s = $_GET['file'];
	$ext = pathinfo(strtolower($s), PATHINFO_EXTENSION);
	$hash = md5($s);
//	if (file_exists("/cache/$hash.jpg")) {
//		unlink("/cache/$hash.jpg");
//	}
	if (file_exists("/cache/$hash.jpg")) {
		echo file_get_contents("/cache/$hash.jpg");
	} else {
		try {
			if ( ($ext == 'avi') || ($ext == 'mpg') || ($ext == 'mp4') || ($ext == 'mkv') || ($ext == 'mov') ) {
				echo shell_exec("ffmpeg -y -i '$s' -ss 00:00:05.000 -vframes 1 /cache/$hash.jpg");
				echo file_get_contents("/cache/$hash.jpg");
				die();
			}
			if ( ($ext == 'tif') || ($ext == 'jpg') || ($ext == 'png') || ($ext == 'jpeg') || ($ext == 'gif') ) {
				$im = new Imagick($s);
				$im->setImageAlphaChannel(Imagick::VIRTUALPIXELMETHOD_WHITE);
				$im->setimageformat("jpeg");
				$im->thumbnailimage(250, 400, true);
				echo $im;
				file_put_contents("/cache/$hash.jpg", $im);
				$im->clear();
				$im->destroy();
				die();
			}
			if ($ext == 'pdf') {
				$im = new Imagick($s."[0]"); // 0-first page, 1-second page
				$im->setImageAlphaChannel(Imagick::VIRTUALPIXELMETHOD_WHITE);
				$im->setimageformat("jpeg");
				$im->thumbnailimage(250, 400, true);
				echo $im;
				file_put_contents("/cache/$hash.jpg", $im);
				$im->clear();
				$im->destroy();
				die();
			}
			if ($ext == 'djvu') {
				include('/application/djvu.php');
				$d = new Djvu($s);
				$d->Load($s);
				$i = $d->getPageThumbnail(1);
				file_put_contents("/cache/$hash.jpg", $i);
				$im = new Imagick("/cache/$hash.jpg");
				$im->thumbnailimage(250, 400, true);
				file_put_contents("/cache/$hash.jpg", $im);
				echo $im;
				$im->clear();
				$im->destroy();
				die();
			}
			if ($ext == 'epub') {
				include('/application/epub.php');
				$d = new EPub($s);
				$im = $d->Cover();
				if ($im['found'] != '') {
					$i = $im['data'];
					file_put_contents("/cache/$hash.jpg", $i);
					$im = new Imagick("/cache/$hash.jpg");
					$im->thumbnailimage(250, 400, true);
					file_put_contents("/cache/$hash.jpg", $im);
					echo $im;
					$im->clear();
					$im->destroy();
				} else {
					echo file_get_contents('none.jpg');
				}
				die();
			}
			if ($ext == 'fb2') {
				$fb2 = simplexml_load_file($s);
				$images = array();
				if (isset($fb2->binary)) {
					foreach ($fb2->binary as $binary) {
						$id = $binary->attributes()['id'];		
						if (
							(strpos($id, "cover") !==  false) ||
							(strpos($id, "jpg") !==  false) ||
							(strpos($id, "obloj") !==  false)
						) {
							$cover = base64_decode($binary);
					}
					$images["$id"] = $binary;
					}
				}
				if (isset($cover)) {
					file_put_contents("/cache/$hash.jpg", $cover);
					$im = new Imagick("/cache/$hash.jpg");
					$im->thumbnailimage(250, 400, true);
					file_put_contents("/cache/$hash.jpg", $im);
					echo $im;
					$im->clear();
					$im->destroy();
				} else {
					echo file_get_contents($s);
					die();
				}
				echo file_get_contents($s);
				die();
			}
	
			echo file_get_contents('none.jpg');
			die();
		} catch (ImagickException $e) {
			echo file_get_contents('none.jpg');
			die();
		}
	}
} else {
	echo file_get_contents('none.jpg');
}


