<?php

namespace Army\Weapon;

abstract class WeaponFactory
{
	abstract public function createWeapon() : Weapon;
}