<?php

namespace Service;

use Entity\IAdvertisement;

class Helper
{
	public static function runVkAdvertisement(IAdvertisement $advertisement)
	{
		$vkProvider = new VkProvider((new \Service\Formatting\PlainTextFormatter()));
		$vkProvider->check($advertisement);
		$vkProvider->calculateDuration($advertisement);
		$vkProvider->prepare($advertisement);
		$vkProvider->publicate($advertisement);
	}

	public static function runAvitoAdvertisement(IAdvertisement $advertisement)
	{
		$avitoProvider = new AvitoProvider((new \Service\Formatting\PlainTextFormatter()));
		$avitoProvider->check($advertisement);
		$avitoProvider->calculateDuration($advertisement);
		$avitoProvider->prepare($advertisement);
		$avitoProvider->publicate($advertisement);
	}
}