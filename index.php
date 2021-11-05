<?php

/** @var array $genres */
/** @var array $movies */
require_once "./data/movies-db.php";
/** @var array $config */
require_once "./config/app.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
require_once "./lib/validate-functions.php";

$genreFilter = '';
$searchFilter = [];
$currentPage = getFileName(__FILE__);

if($_SERVER['REQUEST_METHOD'] === 'GET')
{
	if (isset($_GET['search']))
	{
		$validatedSearch = validateSearch(escape($_GET['search']));
		if(empty($validatedSearch['errors']))
		{
			$movies = getMoviesBySubstr($movies, $validatedSearch['value']);
		}

	}

	if(isset($_GET['genre']))
	{
		$genreFilter = $_GET['genre'];
		$movies = getMoviesByGenre($movies, $genres[$_GET['genre']]);
		$currentPage .= ($genreFilter !== '' ? '?' . $genreFilter : '');
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