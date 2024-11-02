<!doctype html>
<html lang="ru">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
	if ($url->description != '') {
		echo "<meta name='description' content='$url->description' />";
	}

	if ($url->title != '') {
		$title = $url->title;
	} else {
		$title = 'Архив книг';
	}
	echo "<title>$title</title>";
?>

<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

<link rel="icon" href="/favicon.svg" sizes="any" type="image/svg+xml">

<link href="/css/all.min.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">


<style>
.w-100 {
	color: #441b1b;
}
</style>

</head>
<body style='background-color: #343a40;'>

<div class="container whb">
<nav class="navbar navbar-expand-lg navbar-dark rounded-bottom shadow" style="background-color: #09aa28;">
<div class="container-fluid">
  <a class="navbar-brand" href="/" title="Архив книг">
   &nbsp;Архив книг
  </a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a title="" class="nav-link" href="/">Книги</a></li>
		</ul>

</div>
</nav>
</div>
<div class="container whb">
<br />
<?php
if (file_exists($url->module)) {
	include($url->module);
} else {
	echo 'Раздел не найден', 'Вы ввели неверный адрес, либо раздел находится в разработке.';
	header("HTTP/1.0 404 Not Found");
}
?>
<div>&nbsp;</div>
</div>



<div class="container whb rounded-bottom mb-3">
	<nav class="navbar navbar-expand-lg rounded-top shadow navbar-dark bg-dark" style="background-color: #768fa8;">
		<ul class="navbar-nav mr-auto">
		</ul>
	</nav>
</div>




</body>
</html>

