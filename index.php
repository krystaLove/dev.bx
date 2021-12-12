<?php

spl_autoload_register(static function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});

$advertisement = (new \Entity\Advertisement())
	->setBody("Some body text")
	->setTitle("Some title text")
	->setDuration(10);

$advertisement = (new \Decorator\FooterAdvertisementDecorator($advertisement))
	->addBodyData("Footer");

$advertisement = (new \Decorator\HeaderAdvertisementDecorator($advertisement))
	->addBodyData("Header");

var_dump($advertisement);