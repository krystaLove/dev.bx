<?php

namespace Army\Weapon;

class BowFactory extends WeaponFactory
{

	public function createWeapon(): Weapon
	{
		return new Bow();
	}
}