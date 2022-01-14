<?php
namespace bitflix\models\repositories;

use bitflix\core\Application;
use bitflix\database\Database;

class MysqlMovieRepository implements MovieRepositoryInterface
{
	private Database $db;

	public function __construct()
	{
		$this->db = Application::$app->db;
	}

	public function getAll(array $genres = [], string $genreCode = null): array
	{
		$query = $this->getMoviesSelectQuery();

		if(!empty($genreCode))
		{
			$genreCode = $this->db->escape($genreCode);
			$query .= "
				INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
				INNER JOIN genre g on mg.GENRE_ID = g.ID
				WHERE g.CODE = '$genreCode'
			";
		}

		$result = $this->db->query($query);

		$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

		return $this->joinMovieDataNames($movies, 'GENRES', $genres);
	}

	public function getById(int $id): array
	{
		$query = $this->getMoviesSelectQuery() .
			"WHERE m.ID = '${id}'";

		$result = $this->db->query($query);

		$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

		if(!isset($movies[0]))
		{
			return [];
		}

		$actors = $this->getActorsByIds($movies[0]['ACTORS']);
		$movies = $this->joinMovieDataNames($movies, 'ACTORS', $actors);

		return $movies[0];
	}

	public function getAllGenres(): array
	{
		$query = "SELECT CODE, NAME FROM genre";
		$result = $this->db->query($query);

		$genres = [];

		$i = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			$genres[(string)$i] = $row;
			$i++;
		}

		return $genres;
	}

	public function getAllByName(array $genres, string $name): array
	{
		$name = $this->db->escape($name);

		$query = $this->getMoviesSelectQuery() .
			"WHERE m.TITLE LIKE '%${name}%' OR m.ORIGINAL_TITLE LIKE '%${name}%'";

		$result = $this->db->query($query);

		$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);

		return $this->joinMovieDataNames($movies, 'GENRES', $genres);
	}

	private function joinMovieDataNames(array $movies, string $key, array $data) : array
	{
		foreach ($movies as $i => $movie)
		{
			$dataNames = [];
			foreach(explode(',', $movie[$key]) as $dataID)
			{
				$dataNames[] = $data[$dataID]['NAME'];
			}

			$movies[$i][$key] = $dataNames;
		}

		return $movies;
	}

	private function getActorsByIds(string $ids) : array
	{
		$query = "
			SELECT ID, NAME FROM actor
			WHERE ID in (${ids})
		";

		$result = $this->db->query($query);

		$actors = [];
		while($row = mysqli_fetch_assoc($result))
		{
			$actors[$row['ID']] = ['NAME' => $row['NAME']];
		}

		return $actors;
	}

	private function getMoviesSelectQuery(): string
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
}