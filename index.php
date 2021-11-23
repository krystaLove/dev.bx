<?php

require_once "./data/movies-db.php";
/** @var array $config */
require_once "./config/app.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
require_once "./lib/validate-functions.php";
require_once "./lib/db-functions.php";

$genreFilter = '';
$searchFilter = [];
$currentPage = getFileName(__FILE__);
$validatedSearch = [
	'errors' => [],
	'value' => ''
];

$moviesDb = createDbConnection($config['db']);

$genres = getGenres($moviesDb);
$movies = [];

if(isset($_GET['genre']))
{
	$genreFilter = $_GET['genre'];
	$currentPage .= ($genreFilter !== '' ? '?' . $genreFilter : '');
	$movies = getMovies($moviesDb, $genres, $genreFilter);
}
else
{
	$movies = getMovies($moviesDb, $genres);
}

if (isset($_GET['search']))
{
	$validatedSearch = validateSearch(escape($_GET['search']));
	if(empty($validatedSearch['errors']))
	{
		$movies = getMoviesBySubstr($moviesDb, $genres, $validatedSearch['value']);
	}
}

$page = renderTemplate("./resources/pages/movies-list.php", [
	'movies' => $movies,
	'errors' => $validatedSearch['errors'],
	'config' => $config
]);

renderLayout($page, [
	'genres' => $genres,
	'lastSearch' => $validatedSearch['value'],
	'config' => $config,
	'currentPage' => $currentPage
]);