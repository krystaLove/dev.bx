<?php

namespace bitflix\database;

use mysqli;
use mysqli_result;

/**
 *	Class to work with database
 */
class Database
{
	private mysqli $db;

	public function __construct()
	{
		$this->db = mysqli_init();
	}

	/**
	 * @param array $dbConfig
	 *
	 * @return void
	 */
	public function connect(array $dbConfig = []): void
	{
		$connectionResult = mysqli_real_connect(
			$this->db,
			$dbConfig['host'],
			$dbConfig['user'],
			$dbConfig['password'],
			$dbConfig['db-name'],
		);

		if(!$connectionResult)
		{
			$error = sprintf("%s: %s", mysqli_connect_errno($this->db), mysqli_connect_error($this->db));
			trigger_error($error, E_USER_ERROR);
		}

		$result = mysqli_set_charset($this->db, 'utf8');

		if(!$result)
		{
			trigger_error(mysqli_error($this->db), E_USER_ERROR);
		}
	}

	/**
	 * @param string $query
	 *
	 * @return mysqli_result
	 */
	public function query(string $query): mysqli_result
	{
		$result = mysqli_query($this->db, $query);
		if(!$result)
		{
			trigger_error(mysqli_error($this->db), E_USER_ERROR);
		}

		return $result;
	}

	/**
	 * @param string $var
	 *
	 * @return string
	 */
	public function escape(string $var): string
	{
		return $this->db->real_escape_string($var);
	}
}