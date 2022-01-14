<?php

namespace bitflix\models\entities;

use bitflix\core\Application;

class Movie
{
	private int $id;

	private string $title;
	private string $originalTitle;
	private string $description;

	private array $genres;
	private int $duration;

	private array $actors;
	private string $director;
	private float $rating;
	private string $releaseDate;
	private int $ageRestriction;

	/**
	 * @return array
	 */
	public function getActors(): array
	{
		return $this->actors;
	}

	/**
	 * @param array $actors
	 *
	 * @return Movie
	 */
	public function setActors(array $actors): self
	{
		$this->actors = $actors;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDirector(): string
	{
		return $this->director;
	}

	/**
	 * @param string $director
	 *
	 * @return Movie
	 */
	public function setDirector(string $director): self
	{
		$this->director = $director;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getRating(): float
	{
		return $this->rating;
	}

	/**
	 * @param float $rating
	 *
	 * @return Movie
	 */
	public function setRating(float $rating): self
	{
		$this->rating = $rating;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getReleaseDate(): string
	{
		return $this->releaseDate;
	}

	/**
	 * @param string $releaseDate
	 *
	 * @return Movie
	 */
	public function setReleaseDate(string $releaseDate): self
	{
		$this->releaseDate = $releaseDate;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return Movie
	 */
	public function setId(int $id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Movie
	 */
	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOriginalTitle(): string
	{
		return $this->originalTitle;
	}

	/**
	 * @param string $originalTitle
	 *
	 * @return Movie
	 */
	public function setOriginalTitle(string $originalTitle): self
	{
		$this->originalTitle = $originalTitle;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	public function getShortenDescription(): string
	{
		$maxLength = Application::$app->config->get('app')['card-description-length'];
		return strlen($this->description) > $maxLength ?
			mb_substr($this->description,0,$maxLength) . "..." : $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return Movie
	 */
	public function setDescription(string $description): self
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getGenres(): array
	{
		return $this->genres;
	}

	/**
	 * @param array $genres
	 *
	 * @return Movie
	 */
	public function setGenres(array $genres): self
	{
		$this->genres = $genres;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @param int $duration
	 *
	 * @return Movie
	 */
	public function setDuration(int $duration): self
	{
		$this->duration = $duration;
		return $this;
	}

	public function getImagePath(): string
	{
		return "public/data/images/$this->id.jpg";
	}

	public function getDurationInHours(): string
	{
		$hours = floor($this->duration / 60);
		$minutes = $this->duration % 60;

		$result = '';

		if($hours < 10)
		{
			$result .= '0';
		}

		$result .= $hours . ':';

		if($minutes < 10)
		{
			$result .= '0';
		}

		$result .= $minutes;

		return $result;
	}

	/**
	 * @return int
	 */
	public function getAgeRestriction(): int
	{
		return $this->ageRestriction;
	}

	/**
	 * @param int $ageRestriction
	 *
	 * @return Movie
	 */
	public function setAgeRestriction(int $ageRestriction): self
	{
		$this->ageRestriction = $ageRestriction;
		return $this;
	}

}