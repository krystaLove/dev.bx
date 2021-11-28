<?php

require_once "./lib/template-functions.php";
require_once "./lib/helper-functions.php";
require_once "./lib/db-functions.php";
require_once "./lib/movies-functions.php";

/** @var array $config */
require_once "./config/app.php";

$moviesDb = createDbConnection($config['db']);
$genres = getGenres($moviesDb);

$page = renderTemplate("./resources/pages/add-movie.php");

renderLayout($page, [
	'genres' => $genres,
	'config' => $config,
	'currentPage' => getFileName(__FILE__)
]);