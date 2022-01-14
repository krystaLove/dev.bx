<?php

namespace bitflix\models\repositories;

interface MovieRepositoryInterface
{
	public function getAll(array $genres, string $genreCode = null): array;
	public function getById(int $id): array;
	public function getAllGenres(): array;
	public function getAllByName(array $genres, string $name): array;
}