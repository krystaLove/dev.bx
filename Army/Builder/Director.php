<?php

namespace Army\Builder;

use Army\WarriorTemplate;
use Army\Weapon\WeaponFactory;

class Director
{
	public static function build(WarriorBuilder $warriorBuilder, ?WeaponFactory $weaponFactory = null): WarriorTemplate
	{
		$warriorBuilder
			->createWarriorTemplate()
			->addLeftHandArmor()
			->addLeftHandWeapon()
			->addRightHandWeapon()
		;
		if (isset($weaponFactory))
		{
			$warriorBuilder->addRightHandWeapon($weaponFactory->createWeapon());
		}

		return $warriorBuilder->getWarrior();
	}
}