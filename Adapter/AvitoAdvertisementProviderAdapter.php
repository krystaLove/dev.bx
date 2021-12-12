<?php

namespace Adapter;

use Entity\IAdvertisement;
use Entity\AdvertisementResponse;
use Service\AdvertisementProviderInterface;

class AvitoAdvertisementProviderAdapter implements AdvertisementProviderInterface
{

	public function publicate(IAdvertisement $advertisement): AdvertisementResponse
	{
		$avitoAdvertisement = new \AvitoAdvertisement();

		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("Avito Title");
		}
		$avitoAdvertisement
			->setTitle($advertisement->getTitle())
			->setBody($advertisement->getBody());

		$result = (new \AvitoPublicator())->publicate($avitoAdvertisement);

		return (new AdvertisementResponse())->setTargeting($result->getTargetingName());
	}

	public function prepare(IAdvertisement $advertisement)
	{

	}

	public function check(IAdvertisement $advertisement)
	{

	}

	public function calculateDuration(IAdvertisement $advertisement)
	{

	}
}