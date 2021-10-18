<?php

function formatMovieInfo($movie): string
{
	return "{$movie["title"]} ({$movie["release_year"]}), {$movie["age_restriction"]}+. Rating - {$movie["rating"]}";
}

function printMoviesInfo(array $movies): void
{
	$i = 0;
	foreach ($movies as $movie)
	{
		printMessage(++$i . ". " . formatMovieInfo($movie));
	}
}

function filterPermittedMoviesAccordingToAge(array $movies, int $age): array
{
	$filter = function($movie) use ($age): bool {
		return $movie["age_restriction"] <= $age;
	};

	return array_filter($movies, $filter);
}