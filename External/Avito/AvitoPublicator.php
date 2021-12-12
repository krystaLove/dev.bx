<?php

use External\AvitoAdvertisementResult;

class AvitoPublicator
{
	public function publicate(AvitoAdvertisement $advertisement): AvitoAdvertisementResult
	{
		return (new AvitoAdvertisementResult())->setTargetingName("Avito targeting");
	}
}