<?php

namespace bitflix\core;

class ServiceContainer
{
	private array $serviceStorage = [];

	/**
	 * @throws \Exception
	 */
	public function get(string $name)
	{
		if(!isset($this->serviceStorage[$name]))
		{
			throw new \Exception("No service found");
		}
		return $this->serviceStorage[$name];
	}

	/**
	 * @throws \Exception
	 */
	public function add(string $name, string $class, array $params)
	{
		if(isset($this->serviceStorage[$name]))
		{
			throw new \Exception("Service with name $name already exists");
		}

		$this->serviceStorage[$name] = new $class(...$params);
	}
}