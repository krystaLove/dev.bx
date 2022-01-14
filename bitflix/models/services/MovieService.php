<?php
namespace bitflix\models\services;

use bitflix\models\entities\Movie;
use bitflix\models\repositories\MovieRepositoryInterface;

class MovieService
{
	private MovieRepositoryInterface $movieRepository;

	public function __construct(MovieRepositoryInterface $movieRepository)
	{
		$this->movieRepository = $movieRepository;
	}

	public function getAllGenres(): array
	{
		/*foreach ($genres as $code => $value)
		{
			$genres[$code] = new Genre($value['CODE'], $value['NAME']);
		}*/

		return $this->movieRepository->getAllGenres();
	}

	public function getAll(array $genres = [],string $genreCode = null): array
	{
		$movies = $this->movieRepository->getAll($genres, $genreCode);

		foreach ($movies as $id => $value)
		{
			$movie = $this->createMovieFromData($value);
			$movies[$id] = $movie;
		}

		return $movies;
	}

	public function getById(int $id): ?Movie
	{
		$movie = $this->movieRepository->getById($id);

		return $this->createMovieFromData($movie);
	}

	public function getMoviesBySubstr(array $genres, string $searchStr) : array
	{
		$movies = $this->movieRepository->getAllByName($genres, $searchStr);

		foreach ($movies as $id => $value)
		{
			$movie = $this->createMovieFromData($value);
			$movies[$id] = $movie;
		}

		return $movies;
	}

	private function createMovieFromData(array $data): ?Movie
	{
		$movie = new Movie();

		if(empty($data))
		{
			return null;
		}

		if(is_string($data['ACTORS']))
		{
			$data['ACTORS'] = [$data['ACTORS']];
		}
		if(is_string($data['GENRES']))
		{
			$data['GENRES'] = [$data['GENRES']];
		}

		$movie->setDescription($data['DESCRIPTION'])
			  ->setDuration($data['DURATION'])
			  ->setOriginalTitle($data['ORIGINAL_TITLE'])
			  ->setTitle($data['TITLE'])
			  ->setGenres($data['GENRES'])
			  ->setId($data['ID'])
			  ->setAgeRestriction($data['AGE_RESTRICTION'])
			  ->setRating($data['RATING'])
			  ->setDirector($data['DIRECTOR'])
			  ->setActors($data['ACTORS'])
			  ->setGenres($data['GENRES'])
			  ->setReleaseDate($data['RELEASE_DATE']);

		return $movie;
	}
}