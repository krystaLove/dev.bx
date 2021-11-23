<?php

function getGenres(mysqli $db) : array
{
	$query = "SELECT CODE, NAME FROM genre";
	$result = mysqli_query($db, $query);

	$genres = [];

	$i = 1;
	while($row = mysqli_fetch_assoc($result))
	{
		$genres["$i"] = $row;
		$i++;
	}

	print_r($genres);

	return $genres;
}

function getMoviesByGenre(array $movies, string $genre) : array
{
	return array_filter($movies, static function($movie) use ($genre) {
		return in_array($genre, $movie['genres'], true);
	});
}

function getMoviesBySubstr(array $movies, string $searchStr) : array
{
	return array_filter($movies, static function($movie) use ($searchStr) {
		return stripos($movie['title'] . $movie['original-title'], $searchStr) !== false;
	});
}

function getMovieImagePath(array $movie) : string
{
	return "./data/images/" . $movie['id'] . '.jpg';
}

function getMovieById(array $movies, int $id) : ?array
{
	foreach ($movies as $movie)
	{
		if ($movie['id'] === $id)
		{
			return $movie;
		}
	}

	return null;
}

function formatMovieDurationInHours(array $movie) : string
{
	if($movie == null || !isset($movie['duration']))
	{
		return '';
	}

	$duration = $movie['duration'];

	$hours = floor($duration / 60);
	$minutes = $duration % 60;

	$result = '';

	if($hours < 10)
	{
		$result .= '0';
	}

	$result .= "{$hours}" . ':';

	if($minutes < 10)
	{
		$result .= '0';
	}

	$result .= $minutes;

	return $result;
}