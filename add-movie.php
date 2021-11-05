<?php

/** @var array $genres */
require_once "./data/movies-db.php";
require_once "./lib/template-functions.php";
require_once "./lib/helper-functions.php";

/** @var array $config */
require_once "./config/app.php";

$page = renderTemplate("./resources/pages/add-movie.php");

renderLayout($page, [
	'genres' => $genres,
	'config' => $config,
	'currentPage' => getFileName(__FILE__)
]);