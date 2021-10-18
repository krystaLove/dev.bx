<?php

/** @var array $movies */
/** @var string $greeting */
require "movies/movies.php";
require "movies/movies-functions.php";
require "functions.php";

printMessage($greeting);

$age = readline();
if(!is_numeric($age) || $age < 0)
{
	printMessage("Incorrect age!");
	return;
}

$permittedMovies = filterPermittedMoviesAccordingToAge($movies, $age);
printMoviesInfo($permittedMovies);