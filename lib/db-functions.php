<?php

function createDbConnection(array $config) : mysqli
{
	$db = mysqli_init();

	$connectionResult = mysqli_real_connect(
		$db,
		$config['host'],
		$config['user'],
		$config['password'],
		$config['db-name'],
	);

	if(!$connectionResult)
	{
		$error = mysqli_connect_errno($db) . ": " . mysqli_connect_error($db);
		trigger_error($error, E_USER_ERROR);
	}

	$result = mysqli_set_charset($db, 'utf8');

	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	return $db;
}

function sqlQuery(mysqli $db, $query) : mysqli_result
{
	$result = mysqli_query($db, $query);
	if(!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	return $result;
}