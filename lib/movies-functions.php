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

	return $genres;
}

function getActorsByIds(mysqli $db, string $ids) : array
{
	$query = "
		SELECT ID, NAME FROM actor
		WHERE ID in (${ids})
	";

	$result = mysqli_query($db, $query);
	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$actors = [];
	while($row = mysqli_fetch_assoc($result))
	{
		$actors[$row['ID']] = ['NAME' => $row['NAME']];
	}

	return $actors;
}

function getMovies(mysqli $db, array $genres, string $genreCode = null) : array
{
	$query = getMoviesSelectQuery();

	if(!empty($genreCode))
	{
		$genreCode = $db->real_escape_string($genreCode);
		$query .= "
			INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
			INNER JOIN genre g on mg.GENRE_ID = g.ID
			WHERE g.CODE = '${genreCode}'
		";
	}

	$result = mysqli_query($db, $query);

	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$movies = joinMovieDataNames($movies, 'GENRES', $genres);

	return array_change_key_case($movies, CASE_LOWER);
}

function getMovieById(mysqli $db, int $id) : array
{
	$query = getMoviesSelectQuery() .
		"WHERE m.ID = '${id}'";

	$result = mysqli_query($db, $query);
	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$actors = getActorsByIds($db, $movies[0]['ACTORS']);
	$movies = joinMovieDataNames($movies, 'ACTORS', $actors);

	return $movies[0];
}

function getMoviesBySubstr(mysqli $db, array $genres, string $searchStr) : array
{
	$searchStr = $db->real_escape_string($searchStr);

	$query = getMoviesSelectQuery() .
		"WHERE m.TITLE LIKE '%${searchStr}%' OR m.ORIGINAL_TITLE LIKE '%${searchStr}%'";

	$result = mysqli_query($db, $query);
	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$movies = joinMovieDataNames($movies, 'GENRES', $genres);

	return $movies;
}

function getMoviesSelectQuery() : string
{
	return "
		SELECT m.ID, m.TITLE, m.ORIGINAL_TITLE, m.DESCRIPTION, m.DURATION, m.AGE_RESTRICTION, m.RELEASE_DATE, m.RATING,
        d.NAME as DIRECTOR,
		(
			SELECT GROUP_CONCAT(GENRE_ID) FROM movie_genre mg
			WHERE mg.MOVIE_ID = m.ID
		) as GENRES,
		(
			SELECT GROUP_CONCAT(ACTOR_ID) FROM movie_actor ma
			WHERE ma.MOVIE_ID = m.ID
		) as ACTORS
		FROM movie m
		INNER JOIN director d on m.DIRECTOR_ID = d.ID
	";
}

function joinMovieDataNames(array $movies, string $key, array $data) : array
{
	foreach ($movies as $i => $movie)
	{
		$dataNames = [];
		foreach(explode(',', $movie[$key]) as $dataID)
		{
			$dataNames[] = $data[$dataID]['NAME'];
		}

		$movies[$i][$key] = $dataNames;
		$movies[$i] = array_change_key_case($movies[$i], CASE_LOWER);
	}

	return $movies;
}

function getMovieImagePath(array $movie) : string
{
	return "./data/images/" . $movie['id'] . '.jpg';
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