<?php
require_once "helper-functions.php";

function validateSearch(string $searchStr): array
{
	$errors = [];

	if(empty($searchStr))
	{
		$errors[] = "Была введена пустая строка!";
	}

	$searchStr = escape($searchStr);
	$searchStr = trim($searchStr);

	// Delete all multiple spaces
	$searchStr = preg_replace('/\s+/', ' ', $searchStr);

	if (strlen($searchStr) < 3)
	{
		$errors[] = "Длина строки должна быть больше 2!";
	}

	return ['errors' => $errors, 'value' => $searchStr];
}