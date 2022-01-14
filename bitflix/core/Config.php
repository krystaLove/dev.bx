<?php

namespace bitflix\core;

class Config
{
	public const CONFIG_EXT = ".php";

	protected array $configMap = array();

	public function __construct($configFolderPath)
	{
		foreach (glob("$configFolderPath/*" . self::CONFIG_EXT) as $filename)
		{
			$this->configMap[basename($filename, self::CONFIG_EXT)] = include $filename;
		}
	}

	public function get(string $key)
	{
		return $this->configMap[$key] ?? null;
	}
}