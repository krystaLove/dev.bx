<?php

namespace Service;

use Adapter\AvitoAdvertisementProviderAdapter;
use Entity\IAdvertisement;
use Entity\AdvertisementResponse;

class AvitoProvider extends AbstractAdvertisementProvider
{

	public function publicate(IAdvertisement $advertisement): AdvertisementResponse
	{
		$advertisement->setBody($this->formatter->format($advertisement->getBody()));
		echo $advertisement->getBody();
		return (new AvitoAdvertisementProviderAdapter())->publicate($advertisement);
	}

	public function prepare(IAdvertisement $advertisement)
	{
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("hello");
		}
		$advertisement->setTitle($advertisement->getTitle() . "Avito");
	}

	public function check(IAdvertisement $advertisement)
	{

	}

	public function calculateDuration(IAdvertisement $advertisement)
	{

	}
}