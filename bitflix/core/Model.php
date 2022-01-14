<?php

namespace bitflix\core;

use bitflix\database\Database;

abstract class Model
{
	protected Database $db;

	public function __construct()
	{
		$this->db = new Application::$app->db;
	}
}