<?php

function getMoviesByGenre(array $movies, string $genre) : array
{
	return array_filter($movies, function($movie) use ($genre) {
		return in_array($genre, $movie['genres']);
	});
}

function getMoviesBySubstr(array $movies, string $searchStr) : array
{
	return array_filter($movies, function($movie) use ($searchStr) {
		return strpos(mb_strtolower($movie['title'].$movie['original-title']), mb_strtolower($searchStr)) !== false;
	});
}

function getMovieImagePath(array $movie) : string
{
	return "./data/images/" . $movie['id'] . '.jpg';
}

function getMovieById(array $movies, int $id) : array
{
	return $movies[$id - 1];
}

function formDurationInHoursOfMovie(array $movie) : string
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

function formAttrOfMovie(array $movie, string $attr) : string
{

	if($movie == null || !isset($movie[$attr]) || empty($movie[$attr]))
	{
		return '';
	}

	$result = '';
	foreach($movie[$attr] as $attrValue)
	{
		$result .= $attrValue . ', ';
	}

	return substr_replace($result ,"",-2);
}

