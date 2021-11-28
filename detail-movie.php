<?php

require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";

require_once "./lib/helper-functions.php";
require_once "./lib/db-functions.php";

/** @var array $config */
require_once "./config/app.php";

$moviesDb = createDbConnection($config['db']);

$genres = getGenres($moviesDb);

$movie = null;
if(isset($_GET['movie-id']))
{
	$movie = getMovieById($moviesDb, (int) $_GET['movie-id']);
}

$page = renderTemplate("./resources/pages/detail-movie.php", [
	'movie' => $movie
]);

renderLayout($page, [
	'config' => $config,
	'genres' => $genres,
	'content' => $page,
	'currentPage' => getFileName(__FILE__)
]);
