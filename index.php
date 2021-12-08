<?php

use Army\Builder\ArcherBuilder;
use Army\Builder\Director;
use Army\Builder\HorsemanBuilder;
use Army\Weapon\BowFactory;
use Army\Weapon\SpearFactory;

spl_autoload_register(function ($class)
{
	include __DIR__ . '/' . str_replace("\\", "/", $class) . '.php';
});

// Archer
$archerBuilder = new ArcherBuilder();
$bowFactory = new BowFactory();

$archer = Director::build($archerBuilder, $bowFactory);
var_dump($archer);
echo $archer->get('rightHandWeapon')->getDescription() . PHP_EOL;

// Horseman
$horsemanBuilder = new HorsemanBuilder();
$spearFactory = new SpearFactory();

$horseman = Director::build($horsemanBuilder, $spearFactory);
var_dump($horseman);
echo $horseman->get('rightHandWeapon')->getDescription();