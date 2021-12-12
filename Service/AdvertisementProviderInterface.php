<?php

namespace Service;

use Entity\IAdvertisement;
use Entity\AdvertisementResponse;

interface AdvertisementProviderInterface
{
	public function publicate(IAdvertisement $advertisement): AdvertisementResponse;
	public function prepare(IAdvertisement $advertisement);
	public function check(IAdvertisement $advertisement);
	public function calculateDuration(IAdvertisement $advertisement);
}