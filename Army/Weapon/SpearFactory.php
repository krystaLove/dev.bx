<?php

namespace Army\Weapon;

class SpearFactory extends WeaponFactory
{

	public function createWeapon(): Weapon
	{
		return new Spear();
	}
}