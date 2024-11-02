<?php
define('ROOT_PATH', '/application/');
define('RECORDS_PAGE', 10);
define('BOOKS_PAGE', 10);
define('AUTHORS_PAGE', 50);
define('SERIES_PAGE', 50);
include(ROOT_PATH . 'functions.php');


session_set_cookie_params(3600 * 24 * 31 * 12,"/");

error_reporting(E_ALL);

$cdt = date('Y-m-d H:i:s');

