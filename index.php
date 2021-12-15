<?php

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});

\Event\EventBus::getInstance()->subscribe("onPurchasedGold", "\Helper\Logger::addMessageToLog");

\Strategy\PurchaseServiceContext::purchase(new \Strategy\PurchasePremiumGoldStrategy());

\Helper\Logger::writeToFile();