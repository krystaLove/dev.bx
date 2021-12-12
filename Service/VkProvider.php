<?php

namespace Service;

use Adapter\VkAdvertisementProviderAdapter;
use Entity\IAdvertisement;
use Entity\AdvertisementResponse;

class VkProvider extends AbstractAdvertisementProvider
{

	public function publicate(IAdvertisement $advertisement): AdvertisementResponse
	{
		$advertisement->setBody($this->formatter->format($advertisement->getBody()));
		echo $advertisement->getBody();
		return (new VkAdvertisementProviderAdapter())->publicate($advertisement);
	}

	public function prepare(IAdvertisement $advertisement)
	{
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("hello");
		}
	}

	public function check(IAdvertisement $advertisement)
	{
		// TODO: Implement check() method.
	}

	public function calculateDuration(IAdvertisement $advertisement)
	{
	}
}