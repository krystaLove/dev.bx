<?php

namespace Strategy;

use Entity\Service;
use Event\EventBus;

class PurchasePremiumGoldStrategy implements PurchaseStrategy
{

	public function purchase(): Service
	{
		$service = new Service();

		$service->setIsGold(true);
		$service->setActivatedUntil((new \DateTime())->modify("+ 720 days"));
		$service->setActivatedAt(new \DateTime("now"));
		$service->setType(Service::TYPES['premium_gold']);

		EventBus::getInstance()->publish("onPurchasedGold", var_export($service, true));

		return $service;
	}
}