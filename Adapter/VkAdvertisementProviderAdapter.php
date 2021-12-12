<?php

namespace Adapter;

use Entity\IAdvertisement;
use Entity\AdvertisementResponse;
use External\VkAdvertisement;
use External\VkPublicator;
use Service\AdvertisementProviderInterface;

class VkAdvertisementProviderAdapter implements AdvertisementProviderInterface
{

	public function publicate(IAdvertisement $advertisement): AdvertisementResponse
	{
		$vkAdvertisement = new VkAdvertisement();

		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("default");
		}
		$vkAdvertisement
			->setTitle($advertisement->getTitle())
			->setMessageBody($advertisement->getBody());

		$result = (new VkPublicator())->publicate($vkAdvertisement);

		return (new AdvertisementResponse())->setTargeting($result->getTargetingName());
	}
}