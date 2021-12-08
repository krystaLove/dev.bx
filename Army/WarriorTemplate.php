<?php

namespace Army;

class WarriorTemplate
{
	private $params = [
		'rightHandWeapon' => null,
		'leftHandWeapon' => null,
		'rightHandArmor' => null,
		'leftHandArmor' => null,
		'headArmor' => null,
	];

	public function get($param) : ?object
	{
		return $this->params[$param] ?? null;
	}

	public function set($param, $value)
	{
		$this->params[$param] = $value;
	}
}