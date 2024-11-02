<?php
include("../init.php");
session_start();
decode_gurl();


if (isset($_GET['page'])) {
	$page = intval($_GET['page']);
} else {
	$page = 0;
}

if (isset($_GET['path'])) {
	$path = $_GET['path'];
} else {
	$path = '/storage/';
}

if (isset($_GET['file'])) {
	$full_path = $_GET['file'];
} else {
	$full_path = '';
}

$start = $page * RECORDS_PAGE;

include(ROOT_PATH . "renderer.php");

